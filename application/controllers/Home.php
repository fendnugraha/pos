<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('home_model');
    }

    public function index()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";
        // $data['tanggal'] = date('Y-m-d');

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();

        $data['dep_recapirs'] = $this->home_model->depositRecap($data['tanggal'], "IRS");
        $data['dep_recapoto'] = $this->home_model->depositRecap($data['tanggal'], "OKELINK");
        $data['dep_recapkas'] = $this->home_model->recapKasTunai($data['tanggal']);
        $data['kontak'] = $this->db->get('contact')->result_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['title'] = 'GSM - Home';
        $this->load->view('include/header', $data);
        $this->load->view('home/home', $data);
        $this->load->view('include/footer');
    }

    public function okelink()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";
        // $data['tanggal'] = date('Y-m-d');

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();
        $data['dep_recapirs'] = $this->home_model->depositRecap($data['tanggal'], "OKELINK");
        $data['kontak'] = $this->db->get('contact')->result_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['title'] = 'GSM - Home';
        $this->load->view('include/header', $data);
        $this->load->view('home/okelink', $data);
        $this->load->view('include/footer');
    }

    public function kastunai()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";
        // $data['tanggal'] = date('Y-m-d');

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();
        $data['dep_recapirs'] = $this->home_model->recapKasTunai($data['tanggal']);
        $data['kontak'] = $this->db->get('contact')->result_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['title'] = 'GSM - Home';
        $this->load->view('include/header', $data);
        $this->load->view('home/kastunai', $data);
        $this->load->view('include/footer');
    }

    public function hapus_record()
    {
        $id = $this->input->post('transferId');

        $this->db->delete('deposit', ['id' => $id]);
    }

    public function update_setting()
    {
        $data = [
            'namakonter' => $this->input->post('namakonter'),
            'prefik' => $this->input->post('prefik'),
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'saldoawal' => $this->input->post('saldoawal'),
            'saldoawalok' => $this->input->post('saldoawalok'),
            'kasawal' => $this->input->post('kasawal'),
            'akhirkata' => $this->input->post('akhirkata'),
            'manager' => $this->input->post('manager')
        ];

        $this->db->set($data);
        $this->db->where('id', 1);
        $this->db->update('setting');
        redirect('home/setting');
    }

    // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
    private function buatBaris2Kolom($kolom1, $kolom4)
    {
        // Mengatur lebar setiap kolom (dalam satuan karakter)
        $lebar_kolom_1 = 25;
        // $lebar_kolom_2 = 5;
        // $lebar_kolom_3 = 9;
        $lebar_kolom_4 = 12;

        // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
        $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
        // $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
        // $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
        $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

        // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
        $kolom1Array = explode("\n", $kolom1);
        // $kolom2Array = explode("\n", $kolom2);
        // $kolom3Array = explode("\n", $kolom3);
        $kolom4Array = explode("\n", $kolom4);

        // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
        // $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
        $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom4Array));

        // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
        $hasilBaris = array();

        // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
        for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

            // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
            $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
            // $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

            // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
            // $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
            $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

            // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
            $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom4;
            // $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
        }

        // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
        return implode($hasilBaris, "\n") . "\n";
    }

    private function buatBaris3Kolom($kolom1, $kolom2, $kolom3)
    {
        // Mengatur lebar setiap kolom (dalam satuan karakter)
        $lebar_kolom_1 = 12;
        $lebar_kolom_2 = 13;
        $lebar_kolom_3 = 12;
        // $lebar_kolom_4 = 12;

        // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
        $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
        $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
        $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
        // $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

        // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
        $kolom1Array = explode("\n", $kolom1);
        $kolom2Array = explode("\n", $kolom2);
        $kolom3Array = explode("\n", $kolom3);
        // $kolom4Array = explode("\n", $kolom4);

        // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
        // $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));
        $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array));

        // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
        $hasilBaris = array();

        // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
        for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

            // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
            $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ", STR_PAD_BOTH);
            $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ", STR_PAD_BOTH);

            // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
            $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_BOTH);
            // $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

            // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
            $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3;
            // $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
        }

        // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
        return implode($hasilBaris, "\n") . "\n";
    }

    public function faktur_print()
    {
        $id = $this->input->post('transferId');

        $deprecap = $this->home_model->depositRecapByID($id);
        $kasir = $this->db->get_where('user', ['uname' => $deprecap['kasir']])->row_array();
        $kasir = $kasir['name'];
        $set_struk = $this->db->get_where('setting', ['id' => 1])->row_array();

        //membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("tm_u220");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);

        // Membuat judul
        $printer->initialize();
        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text($set_struk['namakonter'] . "\n");

        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text($set_struk['alamat'] . "\n");
        // $printer->text(date('dmY H:i:s', $deprecap['waktu']) . "\n");
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text($set_struk['telepon'] . "\n");

        // Data transaksi
        $printer->initialize();
        $printer->text("#" .  $deprecap['id'] . "\n");
        $printer->text($this->buatBaris2Kolom($deprecap['waktu'], "No." . $deprecap['id']));
        // $printer->text("Waktu : " . $deprecap['date'] . "\n");

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris2Kolom("Barang", "Subtotal"));
        $printer->text("----------------------------------------\n");
        $printer->text(strtoupper($deprecap['produk']) . " " . $deprecap['tujuan'] . "\n");
        $printer->text($this->buatBaris2Kolom($deprecap['idagen'], number_format($deprecap['jumlah'])));

        $printer->text("Note : " . $deprecap['keterangan'] . "\n");
        $printer->text("----------------------------------------\n");
        // $printer->text($this->buatBaris2Kolom('', "Total", number_format($deprecap['jumlah'])));
        $printer->text("Kasir : " . $kasir . "\n");
        $printer->text("\n");

        // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text($set_struk['akhirkata'] . "\n");
        // $printer->text("http://www.gsm-tronik.com\n");

        // $printer->feed(2); // mencetak 5 baris kosong, agar kertas terangkat ke atas

        $printer->cut();
        $printer->close();

        redirect('home');
    }

    public function kas_keluar_cetak()
    {
        $id = $this->input->post('transferId');

        $deprecap = $this->home_model->depositRecapByID($id);
        $kasir = $this->db->get_where('user', ['uname' => $deprecap['kasir']])->row_array();
        $kasir = $kasir['name'];
        $set_struk = $this->db->get_where('setting', ['id' => 1])->row_array();

        //membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("tm_u220");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);

        // Membuat judul
        $printer->initialize();
        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text($set_struk['namakonter'] . "\n");

        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text($set_struk['alamat'] . "\n");
        // $printer->text(date('dmY H:i:s', $deprecap['waktu']) . "\n");
        $printer->text($set_struk['telepon'] . "\n");

        // Data transaksi
        $printer->initialize();
        $printer->text("#" .  $deprecap['id'] . "\n");
        $printer->text($this->buatBaris2Kolom($deprecap['waktu'], "No." . $deprecap['id']));
        // $printer->text("Waktu : " . $deprecap['date'] . "\n");

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text($deprecap['tujuan'] . "\n");
        $printer->text("----------------------------------------\n");
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("BUKTI PENGELUARAN KAS\n");
        $printer->text("----------------------------------------\n");
        $printer->initialize();
        $printer->text(strtoupper($deprecap['keterangan']) . "\n");
        $printer->text($this->buatBaris2Kolom(strtoupper($deprecap['idagen']), number_format($deprecap['jumlah'])));

        // $printer->text("Note : " . $deprecap['keterangan'] . "\n");
        $printer->text("----------------------------------------\n");
        // $printer->text($this->buatBaris2Kolom('', "Total", number_format($deprecap['jumlah'])));
        $printer->text("Kasir : " . $kasir . "\n");
        $printer->text("\n");

        //Sesi tanda tangan
        $printer->initialize();
        $printer->text($this->buatBaris3Kolom("", "Mengetahui,", ""));
        $printer->text("\n");
        $printer->text("\n");
        $printer->text($this->buatBaris3Kolom("Iyan AM", "Dwi", $set_struk['manager']));
        $printer->text("\n");
        $printer->text($this->buatBaris3Kolom("Penerima", "", "Kasir"));
        $printer->text("\n");
        $printer->text("\n");
        $printer->text($this->buatBaris3Kolom(ucwords($deprecap['idagen']), "", $kasir));
        $printer->text("\n");
        // $printer->text("http://www.gsm-tronik.com\n");

        // Pesan penutup
        // $printer->initialize();
        // $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        // $printer->text($set_struk['akhirkata'] . "\n");
        // $printer->text("http://www.gsm-tronik.com\n");

        // $printer->feed(2); // mencetak 5 baris kosong, agar kertas terangkat ke atas

        $printer->cut();
        $printer->close();

        redirect('home');
    }

    public function sendMessage($chatID, $messaggio, $token)
    {
        echo "sending message to " . $chatID . "\n";

        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chatID;
        $url = $url . "&text=" . urlencode($messaggio);
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function setting()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";

        if (null !== $this->input->post('tanggal')) {
            $tanggal = $this->input->post('tanggal');
        } else {
            $tanggal = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();

        $data['title'] = 'GSM - Setting';
        $this->load->view('include/header', $data);
        $this->load->view('home/setting', $data);
        $this->load->view('include/footer');
    }

    public function tambahagen()
    {
        $data = [
            'id' => null,
            'idagen' => $this->input->post('idagen'),
            'name' => $this->input->post('namaagen')
        ];
        $this->db->insert('contact', $data);
        redirect('home/setting');
    }

    public function report()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";

        if (null !== $this->input->post('tanggal')) {
            $tanggal = $this->input->post('tanggal');
        } else {
            $tanggal = date('Y-m-d');
        };
        $data['tanggal'] = $tanggal;
        $data['user'] = $this->db->query($sql)->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();
        $data['nonDepIn'] = $this->home_model->recapNonDeposit($tanggal, 'In');
        $data['nonDepOut'] = $this->home_model->recapNonDeposit($tanggal, 'Out');
        $data['nonDepBon'] = $this->db->get_where('deposit', ['date(waktu)' => $tanggal, 'metode' => 3])->result_array();
        $data['userlogin'] = $this->db->get('user')->result_array();
        $data['title'] = 'GSM - Report';
        $this->load->view('include/header', $data);
        $this->load->view('home/report', $data);
        $this->load->view('include/footer');
    }

    public function thr()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";

        if (null !== $this->input->post('tanggal')) {
            $tanggal = $this->input->post('tanggal');
        } else {
            $tanggal = date('Y-m-d');
        };
        $data['tanggal'] = $tanggal;
        $data['user'] = $this->db->query($sql)->row_array();
        $data['setting'] = $this->db->get('setting')->row_array();
        $data['tb_thr'] = $this->db->get('tb_thr')->result_array();
        $data['title'] = 'GSM - Report';
        $this->load->view('include/header', $data);
        $this->load->view('home/thragen', $data);
        $this->load->view('include/footer');
    }

    public function dailyReport()
    {
        if (null !== $this->input->post('tanggal')) {
            $tanggal = $this->input->post('tanggal');
        } else {
            $tanggal = date('Y-m-d');
        };
        $kasir = $this->session->userdata('uname');

        //Kas
        $totalKasAwal = $this->home_model->kasAwal($tanggal);
        $totalKasMasuk = $this->home_model->kasMasuk($tanggal);
        $totalKasKeluar = $this->home_model->kasKeluar($tanggal);
        $totalKasAkhir = $this->home_model->kasAkhir($tanggal);

        //saldo irs
        $totalsaldoAwal = $this->home_model->saldoAwal($tanggal, "IRS");
        $totalsaldoMasuk = $this->home_model->saldoMasuk($tanggal, "IRS");
        $totalsaldoKeluar = $this->home_model->saldoKeluar($tanggal, "IRS");
        $totalsaldoAkhir = $this->home_model->saldoAkhir($tanggal, "IRS");

        //NonDeposit
        $nonDepIn = $this->home_model->recapNonDeposit($tanggal, 'In');
        $nonDepOut = $this->home_model->recapNonDeposit($tanggal, 'Out');
        $nonDepBon = $this->db->get_where('deposit', ['date(waktu)' => $tanggal, 'metode' => 3])->result_array();

        $set_struk = $this->db->get_where('setting', ['id' => 1])->row_array();

        //membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("tm_u220");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);

        // Membuat judul
        $printer->initialize();
        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text($set_struk['namakonter'] . "\n");

        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text($set_struk['alamat'] . "\n");
        // $printer->text(date('dmY H:i:s', $deprecap['waktu']) . "\n");
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text($set_struk['telepon'] . "\n");

        // Data Kas
        $printer->initialize();
        $printer->text("Kas\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris2Kolom("Kas Awal", number_format($totalKasAwal)));
        $printer->text($this->buatBaris2Kolom("Pendapatan", number_format($totalKasMasuk)));
        $printer->text($this->buatBaris2Kolom("Biaya", number_format($totalKasKeluar)));
        $printer->text($this->buatBaris2Kolom("Kas Akhir", number_format($totalKasAkhir)));
        $printer->text("----------------------------------------\n");
        $printer->text("\n");
        // $printer->text("Waktu : " . $deprecap['date'] . "\n");

        // Data Saldo
        $printer->initialize();
        $printer->text("Saldo\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris2Kolom("Saldo Awal", number_format($totalsaldoAwal)));
        $printer->text($this->buatBaris2Kolom("Penambahan", number_format($totalsaldoMasuk)));
        $printer->text($this->buatBaris2Kolom("Transaksi", number_format($totalsaldoKeluar)));
        $printer->text($this->buatBaris2Kolom("Saldo Akhir", number_format($totalsaldoAkhir)));
        $printer->text("----------------------------------------\n");
        $printer->text("\n");
        // $printer->text("Waktu : " . $deprecap['date'] . "\n");

        // Tabel Non Dep In
        $totDepIn = 0;
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("Kas Masuk (Non Deposit)\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris2Kolom("Keterangan", "Jumlah"));
        $printer->text("----------------------------------------\n");
        foreach ($nonDepIn as $n) {
            $totDepIn += $n['jumlah'];
            $printer->text($this->buatBaris2Kolom($n['keterangan'], number_format($n['jumlah'])));
        }
        $printer->text($this->buatBaris2Kolom("Total", number_format($totDepIn)));
        $printer->text("\n");

        // Tabel Non Dep Out
        $totDepOut = 0;
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("Kas Keluar (Non Deposit)\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris2Kolom("Keterangan", "Jumlah"));
        $printer->text("----------------------------------------\n");
        foreach ($nonDepOut as $n) {
            $totDepOut += $n['jumlah'];
            $printer->text($this->buatBaris2Kolom($n['keterangan'], number_format($n['jumlah'])));
        }
        $printer->text($this->buatBaris2Kolom("Total", number_format($totDepOut)));
        $printer->text("\n");

        // Tabel Non Dep Out
        $totDepBon = 0;
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("Bon Saldo\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris2Kolom("Keterangan", "Jumlah"));
        $printer->text("----------------------------------------\n");
        foreach ($nonDepBon as $n) {
            $totDepBon += $n['jumlah'];
            $printer->text($this->buatBaris2Kolom($n['keterangan'], number_format($n['jumlah'])));
        }
        $printer->text($this->buatBaris2Kolom("Total", number_format($totDepBon)));
        $printer->text("\n");

        // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("----------------------------------------\n");
        $printer->text($kasir . "\n");
        $printer->text("----------------------------------------\n");
        // $printer->text("http://www.gsm-tronik.com\n");

        // $printer->feed(2); // mencetak 5 baris kosong, agar kertas terangkat ke atas

        $printer->cut();
        $printer->close();

        redirect('home/report');
    }
}
