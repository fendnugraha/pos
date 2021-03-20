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
        $sql = "SELECT a.*,b.location_id,c.prefix_code,c.name as loc_name,c.cash_account FROM user a
		JOIN location_access b ON b.user_id = a.id
		JOIN inv_location c ON c.id = b.location_id
        WHERE a.uname='$uname'";

        $data['user'] = $this->db->query($sql)->row_array();

        $data['dep_recap'] = $this->home_model->depositRecap();

        $this->form_validation->set_rules('idagen', 'ID Agen', 'required|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM - Home';
            $this->load->view('include/header', $data);
            $this->load->view('home/home', $data);
            $this->load->view('include/footer');
        } else {
            $this->_inputDeposit();
        }
    }

    private function _inputDeposit()
    {
        $kasir = $this->session->userdata('uname');

        $data = [
            'id' => null,
            'idagen' => $this->input->post('idagen'),
            'jumlah' => $this->input->post('jumlah'),
            'kasir' => $kasir,
            'waktu' => time()
        ];

        $this->db->insert('deposit', $data);
        redirect('home');
    }

    public function userProfile()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT a.*,b.location_id,c.prefix_code,c.name as loc_name,c.cash_account,d.name as namauser,d.phone,d.email,d.type FROM user a
        JOIN location_access b ON b.user_id = a.id
        JOIN inv_location c ON c.id = b.location_id
        JOIN contact d ON d.id = a.name
        WHERE a.uname='$uname'";

        $data['logtrack'] = $this->db->get_where('logtrack', ['user' => $this->session->userdata['user_id']])->result_array();

        $data['user'] = $this->db->query($sql)->row_array();


        $oldpassword = $this->input->post('oldpassword');
        $newpassword = $this->input->post('newpassword');
        $cnewpassword = $this->input->post('cnewpassword');

        $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
        $this->form_validation->set_rules('newpassword', 'New Password', 'required|min_length[8]');
        $this->form_validation->set_rules('cnewpassword', 'Confirm New Password', 'required|matches[newpassword]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM - Profile';
            $this->load->view('include/header', $data);
            $this->load->view('content/profile', $data);
            $this->load->view('include/footer');
        } else {
            $user_id = $this->session->userdata['user_id'];
            $datauser = $this->db->get_where('user', ['id' => $user_id])->row_array();

            if (password_verify($oldpassword, $datauser['password'])) {
                $user_id = $this->session->userdata['user_id'];
                $newpassword = $this->input->post('newpassword');
                if ($this->db->where('id', $user_id)->update('user', ['password' => password_hash($newpassword, PASSWORD_DEFAULT)])) {
                    $logtrack = [
                        'id' => null,
                        'invoice' => '----------',
                        'waktu' => time(),
                        'deskripsi' => 'Mengganti password login',
                        'user' => $this->session->userdata('user_id')
                    ];
                    $this->db->insert('logtrack', $logtrack);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>Success!</strong> Password successfully changed.
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <i class="ik ik-x"></i>
                                            </button>
                                        </div>');
                    redirect('home/userprofile');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Failed to change password. Please try again !.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>');
                    redirect('home/userprofile');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Old password is incorrect !.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>');
                redirect('home/userprofile');
            }
        }
    }

    public function editProfile()
    {
        $contact_id = $this->session->userdata('contact_id');
        $data = [
            'name' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone')
        ];

        $this->form_validation->set_rules('nama', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required|numeric');

        if ($this->form_validation->run() == true) {
            $this->db->where('id', $contact_id)->update('contact', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Profile updated !.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>');
        redirect('home/userprofile');
    }

    public function faktur_print()
    {
        $id = $this->input->post('id');
        $this->load->library('escpos');
        $sales = $this->db->get_where('sales', ['id' => $id])->row_array();
        $invoice = $sales['ct_invoice'];

        $salesorder = $this->db->query("SELECT *,b.name as customer,c.name as location_name,c.*,d.*,a.id as salesid,e.name as salesman FROM sales a 
        JOIN contact b on b.id = a.customer_id
        JOIN inv_location c on c.id = a.location_id
        JOIN products d ON d.id = a.product_id
        JOIN contact e ON e.id = a.user_input
        where ct_invoice='$invoice' and status='Completed'")->result_array();

        $subtotal = $this->db->query("SELECT SUM(a.price*a.unit) as subtotal FROM sales a WHERE ct_invoice='$invoice'")->row_array();

        // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
        $connector = new Escpos\PrintConnectors\WindowsPrintConnector("tm_u220");

        // membuat objek $printer agar dapat di lakukan fungsinya
        $printer = new Escpos\Printer($connector);

        // membuat fungsi untuk membuat 1 baris tabel, agar dapat dipanggil berkali-kali dgn mudah
        function buatBaris4Kolom($kolom1, $kolom2, $kolom3, $kolom4)
        {
            // Mengatur lebar setiap kolom (dalam satuan karakter)
            $lebar_kolom_1 = 14;
            $lebar_kolom_2 = 5;
            $lebar_kolom_3 = 9;
            $lebar_kolom_4 = 9;

            // Melakukan wordwrap(), jadi jika karakter teks melebihi lebar kolom, ditambahkan \n 
            $kolom1 = wordwrap($kolom1, $lebar_kolom_1, "\n", true);
            $kolom2 = wordwrap($kolom2, $lebar_kolom_2, "\n", true);
            $kolom3 = wordwrap($kolom3, $lebar_kolom_3, "\n", true);
            $kolom4 = wordwrap($kolom4, $lebar_kolom_4, "\n", true);

            // Merubah hasil wordwrap menjadi array, kolom yang memiliki 2 index array berarti memiliki 2 baris (kena wordwrap)
            $kolom1Array = explode("\n", $kolom1);
            $kolom2Array = explode("\n", $kolom2);
            $kolom3Array = explode("\n", $kolom3);
            $kolom4Array = explode("\n", $kolom4);

            // Mengambil jumlah baris terbanyak dari kolom-kolom untuk dijadikan titik akhir perulangan
            $jmlBarisTerbanyak = max(count($kolom1Array), count($kolom2Array), count($kolom3Array), count($kolom4Array));

            // Mendeklarasikan variabel untuk menampung kolom yang sudah di edit
            $hasilBaris = array();

            // Melakukan perulangan setiap baris (yang dibentuk wordwrap), untuk menggabungkan setiap kolom menjadi 1 baris 
            for ($i = 0; $i < $jmlBarisTerbanyak; $i++) {

                // memberikan spasi di setiap cell berdasarkan lebar kolom yang ditentukan, 
                $hasilKolom1 = str_pad((isset($kolom1Array[$i]) ? $kolom1Array[$i] : ""), $lebar_kolom_1, " ");
                $hasilKolom2 = str_pad((isset($kolom2Array[$i]) ? $kolom2Array[$i] : ""), $lebar_kolom_2, " ");

                // memberikan rata kanan pada kolom 3 dan 4 karena akan kita gunakan untuk harga dan total harga
                $hasilKolom3 = str_pad((isset($kolom3Array[$i]) ? $kolom3Array[$i] : ""), $lebar_kolom_3, " ", STR_PAD_LEFT);
                $hasilKolom4 = str_pad((isset($kolom4Array[$i]) ? $kolom4Array[$i] : ""), $lebar_kolom_4, " ", STR_PAD_LEFT);

                // Menggabungkan kolom tersebut menjadi 1 baris dan ditampung ke variabel hasil (ada 1 spasi disetiap kolom)
                $hasilBaris[] = $hasilKolom1 . " " . $hasilKolom2 . " " . $hasilKolom3 . " " . $hasilKolom4;
            }

            // Hasil yang berupa array, disatukan kembali menjadi string dan tambahkan \n disetiap barisnya.
            return implode($hasilBaris, "\n") . "\n";
        }

        // Membuat judul
        $printer->initialize();
        $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT); // Setting teks menjadi lebih besar
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER); // Setting teks menjadi rata tengah
        $printer->text($salesorder[0]['location_name'] . "\n");
        $printer->text("\n");

        // Data transaksi
        $printer->initialize();
        $printer->text("#" .  $salesorder[0]['invoice'] . "\n");
        $printer->text(buatBaris4Kolom($salesorder[0]['date'], '', '', "ID" . $salesorder[0]['salesid']));
        // $printer->text("Waktu : " . $salesorder[0]['date'] . "\n");

        // Membuat tabel
        $printer->initialize(); // Reset bentuk/jenis teks
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom("Barang", "Qty", "Harga", "Subtotal"));
        $printer->text("----------------------------------------\n");
        foreach ($salesorder as $s) {
            $printer->text(buatBaris4Kolom($s['p_name'], "x" . number_format($s['unit']), number_format($s['price']), number_format($s['price'] * $s['unit'])));
        }
        $printer->text("----------------------------------------\n");
        $printer->text(buatBaris4Kolom('', '', "Total", number_format($subtotal['subtotal'])));
        $printer->text("Kasir : " . $salesorder[0]['salesman'] . "\n");
        $printer->text("\n");

        // Pesan penutup
        $printer->initialize();
        $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        $printer->text("Terima kasih telah berbelanja\n");
        $printer->text("http://www.gsm-tronik.com\n");

        // $printer->feed(2); // mencetak 5 baris kosong, agar kertas terangkat ke atas

        $printer->cut();
        $printer->close();
    }
}
