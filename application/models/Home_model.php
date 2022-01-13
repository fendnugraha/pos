<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function depositRecap($tanggal, $jalur)
    {
        return $this->db->get_where('deposit', ['date(waktu)' => $tanggal, 'jalur' => $jalur])->result_array();
    }

    public function depositRecapByID($id)
    {
        return $this->db->get_where('deposit', ['id' => $id])->row_array();
    }

    public function depositLastByUser($user)
    {
        return $this->db->order_by('id', 'DESC')->limit(1)->get_where('deposit', ['kasir' => $user])->row_array();
    }

    public function recapNonDeposit($tanggal, $status)
    {
        $data = [
            'date(waktu)' => $tanggal,
            'metode' => 1,
            'status' => $status
        ];
        return $this->db->get_where('deposit', $data)->result_array();
    }

    public function saldoAwal($tanggal, $jalur)
    {
        $dateAwal = date("Y-m-d", strtotime("-1 day", strtotime($tanggal)));
        // $dateAkhir = $this->input->post('dateAkhir');
        $setSaldoAwal = $this->db->get_where('setting', ['id' => 1])->row_array();

        $kasmasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'In' and metode=0 and jalur='$jalur' and date(waktu) BETWEEN '0000-00-00' and '$dateAwal'")->row_array();

        $kaskeluar = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'Out' and (metode=0 or metode=3) and jalur='$jalur' and date(waktu) BETWEEN '0000-00-00' and '$dateAwal'")->row_array();

        if ($jalur = "OKELINK") {
            $sAwal = $setSaldoAwal['saldoawalok'];
        } elseif ($jalur = "IRS") {
            $sAwal = $setSaldoAwal['saldoawal'];
        }
        return $sAwal + $kasmasuk['sAwal'] - $kaskeluar['sAwal'];
    }

    public function saldoMasuk($tanggal, $jalur)
    {
        $totKasMasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'In' and metode=0 and jalur='$jalur' and date(waktu) = '$tanggal'")->row_array();

        return $totKasMasuk['sAwal'];
    }

    public function saldoKeluar($tanggal, $jalur)
    {
        $totKasMasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'Out' and metode=0 and jalur='$jalur' and date(waktu) = '$tanggal' or status = 'Out' and metode=3 and date(waktu) = '$tanggal'")->row_array();

        return $totKasMasuk['sAwal'];
    }

    public function saldoAkhir($tanggal, $jalur)
    {
        $setSaldoAwal = $this->home_model->saldoAwal($tanggal, $jalur);
        $kasmasuk = $this->home_model->saldoMasuk($tanggal, $jalur);
        $kaskeluar = $this->home_model->saldoKeluar($tanggal, $jalur);

        return $setSaldoAwal + $kasmasuk - $kaskeluar;
    }

    public function kasAwal($tanggal)
    {
        $dateAwal = date("Y-m-d", strtotime("-1 day", strtotime($tanggal)));
        // $dateAkhir = $this->input->post('dateAkhir');
        $setKasAwal = $this->db->get_where('setting', ['id' => 1])->row_array();
        $setKasAwal = $setKasAwal['kasawal'];

        $kasmasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'In' and metode=1 and date(waktu) BETWEEN '0000-00-00' and '$dateAwal'")->row_array();

        $kaskeluar = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'Out' and metode=1 and date(waktu) BETWEEN '0000-00-00' and '$dateAwal'")->row_array();

        $totSaldoMasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
                        FROM deposit
                        WHERE status = 'Out' and metode=0 and date(waktu) BETWEEN '0000-00-00' and '$dateAwal'")->row_array();

        return $setKasAwal + $kasmasuk['sAwal'] - $kaskeluar['sAwal'] + $totSaldoMasuk['sAwal'];
    }

    public function kasMasuk($tanggal)
    {
        $totKasMasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'In' and metode=1 and date(waktu) = '$tanggal'")->row_array();

        $totSaldoMasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
                                            FROM deposit
                                            WHERE status = 'Out' and metode=0 and date(waktu) = '$tanggal'")->row_array();

        return $totSaldoMasuk['sAwal'] + $totKasMasuk['sAwal'];
    }

    public function kasKeluar($tanggal)
    {
        $totKasMasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'Out' and metode=1 and date(waktu) = '$tanggal'")->row_array();

        return $totKasMasuk['sAwal'];
    }

    public function kasAkhir($tanggal)
    {
        $setKasAwal = $this->home_model->kasAwal($tanggal);
        $kasmasuk = $this->home_model->kasMasuk($tanggal);
        $kaskeluar = $this->home_model->kasKeluar($tanggal);

        return $setKasAwal + $kasmasuk - $kaskeluar;
    }
}
