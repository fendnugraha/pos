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
        return $this->db->order_by('id', 'DESC')->limit(1)->get_where('deposit', ['kasir' => $user, 'produk' => 'Isi Saldo Deposit'])->row_array();
    }

    public function kasOutLast()
    {
        return $this->db->order_by('id', 'DESC')->limit(1)->get_where('deposit', ['jalur' => "KAS", 'status' => "Out"])->row_array();
    }

    public function kasOutLastByUser($user)
    {
        return $this->db->order_by('id', 'DESC')->limit(1)->get_where('deposit', ['jalur' => "KAS", 'status' => "Out", 'kasir' => $user])->row_array();
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

    public function recapKasTunai($tanggal)
    {
        $data = [
            'date(waktu)' => $tanggal,
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

        if ($jalur == "OKELINK") {
            return $setSaldoAwal['saldoawalok'] + $kasmasuk['sAwal'] - $kaskeluar['sAwal'];
        } elseif ($jalur == "IRS") {
            return $setSaldoAwal['saldoawal'] + $kasmasuk['sAwal'] - $kaskeluar['sAwal'];
        }
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

    public function nomorbukti()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";
        // $data['tanggal'] = date('Y-m-d');
        $setting = $this->db->get('setting')->row_array();
        $user = $this->db->query($sql)->row_array();

        $querycode = "SELECT MAX(RIGHT(tujuan,3)) AS kd_max FROM deposit
                    WHERE kasir = '$uname' and jalur = 'KAS'";
        $q = $this->db->query($querycode);
        if ($q->num_rows() > 0) {
            $k = $q->row_array();
            $tmp = ((int) $k['kd_max']) + 1;
            return str_replace(' ', '.', $setting['prefik']) . ".BK." . date('dmy') . "."  . $user["id"] . "."  . sprintf("%03s", $tmp);
        } else {
            return str_replace(' ', '.', $setting['prefik']) . ".BK." . date('dmy') . "."  . $user["id"] . "."  . "001";
        }
    }
}
