<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transact extends CI_Controller
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
        $data['setting'] = $this->db->get('setting')->row_array();

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();

        $this->form_validation->set_rules('idagen', 'ID Agen', 'exact_length[4]|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM - Transaction';
            $this->load->view('include/header', $data);
            $this->load->view('transact/transaksi', $data);
            $this->load->view('include/footer');
        } else {
            $this->_inputDeposit();
        }
    }

    private function _inputDeposit()
    {
        $kasir = $this->session->userdata('uname');
        if (empty($this->input->post('idagen'))) {
            $idagen = 1;
        } else {
            $idagen = "ID" . $this->input->post('idagen');
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
            'keterangan' => $this->input->post('keterangan'),
            'jalur' => $this->input->post('jalur')
        ];

        $this->db->insert('deposit', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Deposit sudah terinput.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('transact');
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
            'keterangan' => $this->input->post('keterangan'),
            'jalur' => $this->input->post('jalur')
        ];

        $this->db->insert('deposit', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Deposit sudah terinput.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('transact/kasmasuk');
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
            'keterangan' => $this->input->post('keterangan'),
            'jalur' => $this->input->post('jalur')
        ];

        $this->db->insert('deposit', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Deposit sudah terinput.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect('transact/kaskeluar');
    }

    public function kasmasuk()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";
        // $data['tanggal'] = date('Y-m-d');
        $data['setting'] = $this->db->get('setting')->row_array();

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM - Transaction - Kas Masuk';
            $this->load->view('include/header', $data);
            $this->load->view('transact/kasmasuk', $data);
            $this->load->view('include/footer');
        } else {
            $this->_kasmasuk();
        }
    }

    public function kaskeluar()
    {
        $uname = $this->session->userdata('uname');
        $sql = "SELECT * FROM user WHERE uname ='$uname'";
        // $data['tanggal'] = date('Y-m-d');
        $data['setting'] = $this->db->get('setting')->row_array();

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|alpha_numeric_spaces|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM - Transaction - Kas Keluar';
            $this->load->view('include/header', $data);
            $this->load->view('transact/kaskeluar', $data);
            $this->load->view('include/footer');
        } else {
            $this->_kaskeluar();
        }
    }
}
