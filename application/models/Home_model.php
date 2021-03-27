<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function depositRecap()
    {
        $hariini = date('Y-m-d');

        return $this->db->get('deposit')->result_array();
    }

    public function depositRecapByID($id)
    {
        return $this->db->get_where('deposit', ['id' => $id])->row_array();
    }

    public function saldoAwal()
    {
        $hariini = date('Y-m-d');
        $dateAwal = date("Y-m-d", strtotime("-1 day", strtotime($hariini)));
        // $dateAkhir = $this->input->post('dateAkhir');
        $setSaldoAwal = $this->db->get_where('setting', ['id' => 1])->row_array();
        $setSaldoAwal = $setSaldoAwal['saldoawal'];

        $totInputKas = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE date(waktu) BETWEEN '0000-00-00' and '$dateAwal'")->row_array();

        return $setSaldoAwal - $totInputKas['sAwal'];
    }

    public function kasMasuk()
    {
        $hariini = date('Y-m-d');

        $totKasMasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'In' and date(waktu) = '$hariini'")->row_array();

        return $totKasMasuk['sAwal'];
    }

    public function kasKeluar()
    {
        $hariini = date('Y-m-d');

        $totKasMasuk = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE status = 'Out' and date(waktu) = '$hariini'")->row_array();

        return $totKasMasuk['sAwal'];
    }

    public function saldoAkhir()
    {
        $hariini = date('Y-m-d');
        // $dateAkhir = $this->input->post('dateAkhir');
        $setSaldoAwal = $this->db->get_where('setting', ['id' => 1])->row_array();
        $setSaldoAwal = $setSaldoAwal['saldoawal'];

        $totInputKas = $this->db->query("SELECT SUM(jumlah) as sAwal
        FROM deposit
        WHERE date(waktu) BETWEEN '0000-00-00' and '$hariini'")->row_array();

        $kasmasuk = $this->home_model->kasMasuk();
        $kaskeluar = $this->home_model->kasKeluar();

        return $setSaldoAwal + $kasmasuk - $kaskeluar;
    }
}
