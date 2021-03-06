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

        $data['dep_recap'] = $this->home_model->depositRecap($data['tanggal']);
        $data['kontak'] = $this->db->get('contact')->result_array();
        $data['setting'] = $this->db->get('setting')->row_array();
        $data['lastRec'] = $this->home_model->depositLastByUser($uname);

        $this->form_validation->set_rules('idagen', 'ID Agen', 'exact_length[6]|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM - Home';
            $this->load->view('include/header', $data);
            $this->load->view('home/home', $data);
            $this->load->view('include/footer');
        } else {
            if ($this->input->post('kasmasuk') == 1) {
                $this->_kasmasuk();
            } elseif ($this->input->post('kaskeluar') == 1) {
                $this->_kaskeluar();
            } else {
                $this->_inputDeposit();
            }
        }
    }

    private function _inputDeposit()
    {
        $kasir = $this->session->userdata('uname');
        if (empty($this->input->post('idagen'))) {
            $idagen = 1;
        } else {
            $idagen = $this->input->post('idagen');
        };
        $cekid = $this->db->get_where('contact', ['idagen' => $idagen])->row_array();

        if (empty($this->input->post('tujuan'))) {
            $tujuan = "-";
        } else {
            $tujuan = $this->input->post('tujuan');
        };

        if (empty($this->input->post('produk'))) {
            $produk = "Isi Saldo Deposit";
        } else {
            $produk = $this->input->post('produk');
        };

        if (null !== $this->input->post('cash')) {
            $metode = 0;
        } else {
            $metode = 3;
        }

        $konsumen = $idagen . "-" . $cekid['name'];

        $data = [
            'id' => null,
            'idagen' => strtoupper($konsumen),
            'jumlah' => $this->input->post('jumlah'),
            'metode' => $metode,
            'status' => 'Out',
            'produk' => $produk,
            'tujuan' => $tujuan,
            'kasir' => $kasir,
            'waktu' => date('Y-m-d H:i:s'),
            'keterangan' => $this->input->post('keterangan')
        ];

        $this->db->insert('deposit', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Deposit sudah terinput.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('home');
    }

    private function _kaskeluar()
    {
        $kasir = $this->session->userdata('uname');

        $data = [
            'id' => null,
            'idagen' => '---',
            'jumlah' => $this->input->post('jumlah'),
            'metode' => $this->input->post('metodek'),
            'status' => 'Out',
            'produk' => '---',
            'tujuan' => '---',
            'kasir' => $kasir,
            'waktu' => date('Y-m-d H:i:s'),
            'keterangan' => $this->input->post('keterangan')
        ];

        $this->db->insert('deposit', $data);
        redirect('home');
    }

    private function _kasmasuk()
    {
        $kasir = $this->session->userdata('uname');

        $data = [
            'id' => null,
            'idagen' => '---',
            'jumlah' => $this->input->post('jumlah'),
            'metode' => $this->input->post('metodem'),
            'status' => 'In',
            'produk' => '---',
            'tujuan' => '---',
            'kasir' => $kasir,
            'waktu' => date('Y-m-d H:i:s'),
            'keterangan' => $this->input->post('keterangan')
        ];

        $this->db->insert('deposit', $data);
        redirect('home');
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
            'alamat' => $this->input->post('alamat'),
            'telepon' => $this->input->post('telepon'),
            'saldoawal' => $this->input->post('saldoawal'),
            'kasawal' => $this->input->post('kasawal'),
            'akhirkata' => $this->input->post('akhirkata')
        ];

        $this->db->set($data);
        $this->db->where('id', 1);
        $this->db->update('setting');
        redirect('home/setting');
    }

    // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
    private function buatBaris4Kolom($kolom1, $kolom4)
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
        $printer->text($this->buatBaris4Kolom($deprecap['waktu'], "No." . $deprecap['id']));
        // $printer->text("Waktu : " . $deprecap['date'] . "\n");

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris4Kolom("Barang", "Subtotal"));
        $printer->text("----------------------------------------\n");
        $printer->text(strtoupper($deprecap['produk']) . " " . $deprecap['tujuan'] . "\n");
        $printer->text($this->buatBaris4Kolom($deprecap['idagen'], number_format($deprecap['jumlah'])));

        $printer->text("Note : " . $deprecap['keterangan'] . "\n");
        $printer->text("----------------------------------------\n");
        // $printer->text($this->buatBaris4Kolom('', "Total", number_format($deprecap['jumlah'])));
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

        //saldo
        $totalsaldoAwal = $this->home_model->saldoAwal($tanggal);
        $totalsaldoMasuk = $this->home_model->saldoMasuk($tanggal);
        $totalsaldoKeluar = $this->home_model->saldoKeluar($tanggal);
        $totalsaldoAkhir = $this->home_model->saldoAkhir($tanggal);

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
        $printer->text($this->buatBaris4Kolom("Kas Awal", number_format($totalKasAwal)));
        $printer->text($this->buatBaris4Kolom("Pendapatan", number_format($totalKasMasuk)));
        $printer->text($this->buatBaris4Kolom("Biaya", number_format($totalKasKeluar)));
        $printer->text($this->buatBaris4Kolom("Kas Akhir", number_format($totalKasAkhir)));
        $printer->text("----------------------------------------\n");
        $printer->text("\n");
        // $printer->text("Waktu : " . $deprecap['date'] . "\n");

        // Data Saldo
        $printer->initialize();
        $printer->text("Saldo\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris4Kolom("Saldo Awal", number_format($totalsaldoAwal)));
        $printer->text($this->buatBaris4Kolom("Penambahan", number_format($totalsaldoMasuk)));
        $printer->text($this->buatBaris4Kolom("Transaksi", number_format($totalsaldoKeluar)));
        $printer->text($this->buatBaris4Kolom("Saldo Akhir", number_format($totalsaldoAkhir)));
        $printer->text("----------------------------------------\n");
        $printer->text("\n");
        // $printer->text("Waktu : " . $deprecap['date'] . "\n");

        // Tabel Non Dep In
        $totDepIn = 0;
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("Kas Masuk (Non Deposit)\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris4Kolom("Keterangan", "Jumlah"));
        $printer->text("----------------------------------------\n");
        foreach ($nonDepIn as $n) {
            $totDepIn += $n['jumlah'];
            $printer->text($this->buatBaris4Kolom($n['keterangan'], number_format($n['jumlah'])));
        }
        $printer->text($this->buatBaris4Kolom("Total", number_format($totDepIn)));
        $printer->text("\n");

        // Tabel Non Dep Out
        $totDepOut = 0;
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("Kas Keluar (Non Deposit)\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris4Kolom("Keterangan", "Jumlah"));
        $printer->text("----------------------------------------\n");
        foreach ($nonDepOut as $n) {
            $totDepOut += $n['jumlah'];
            $printer->text($this->buatBaris4Kolom($n['keterangan'], number_format($n['jumlah'])));
        }
        $printer->text($this->buatBaris4Kolom("Total", number_format($totDepOut)));
        $printer->text("\n");

        // Tabel Non Dep Out
        $totDepBon = 0;
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("Bon Saldo\n");
        $printer->text("----------------------------------------\n");
        $printer->text($this->buatBaris4Kolom("Keterangan", "Jumlah"));
        $printer->text("----------------------------------------\n");
        foreach ($nonDepBon as $n) {
            $totDepBon += $n['jumlah'];
            $printer->text($this->buatBaris4Kolom($n['keterangan'], number_format($n['jumlah'])));
        }
        $printer->text($this->buatBaris4Kolom("Total", number_format($totDepBon)));
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
