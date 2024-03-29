<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transact extends CI_Controller
{
    protected $uname;

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('home_model');
        $this->load->model('transact_model');

        $this->uname = $this->session->userdata('uname');
    }

    public function index()
    {

        $sql = "SELECT * FROM user WHERE uname ='$this->uname'";
        // $data['tanggal'] = date('Y-m-d');
        $data['setting'] = $this->db->get('setting')->row_array();

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();

        $data['lastRec'] = $this->home_model->depositLastByUser($this->uname);
        $data['recentdep'] = $this->db->limit(10)->order_by('id', 'desc')->get('deposit')->result_array();

        $this->form_validation->set_rules('idagen', 'ID Agen', 'max_length[5]|trim');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'POS - Transaction';
            $this->load->view('include/header', $data);
            $this->load->view('transact/transact', $data);
            $this->load->view('include/footer');
        } else {
            $this->_inputDeposit();
        }
    }

    public function trxpulsa()
    {
        $sql = "SELECT * FROM user WHERE uname ='$this->uname'";
        // $data['tanggal'] = date('Y-m-d');
        $data['setting'] = $this->db->get('setting')->row_array();

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();

        $data['lastRec'] = $this->home_model->depositLastByUser($this->uname);
        $data['recentpulsa'] = $this->db->limit(5)->order_by('id', 'desc')->get_where('deposit', ['idagen' => 'CUSTOMER'])->result_array();

        $this->form_validation->set_rules('produk', 'Kode Produk', 'min_length[2]|trim');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required|alpha_numeric');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM - Transaction';
            $this->load->view('include/header', $data);
            $this->load->view('transact/trxpulsa', $data);
            $this->load->view('include/footer');
        } else {
            $this->_transpulsa();
        }
    }

    private function _inputDeposit()
    {
        $kasir = $this->session->userdata('uname');
        if ($this->input->post('jalur') == "IRS") {
            $awalan = "ID";
        } else {
            $awalan = "OX";
        }
        $idagen = $awalan . $this->input->post('idagen');
        $cekid = $this->db->get_where('contact', ['idagen' => $idagen])->row_array();

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
            'produk' => "Isi Saldo Deposit",
            'tujuan' => "--",
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

    private function _transpulsa()
    {
        $kasir = $this->session->userdata('uname');
        if (null !== $this->input->post('cash')) {
            $metode = 0;
        } else {
            $metode = 3;
        }

        $data = [
            'id' => null,
            'idagen' => "CUSTOMER",
            'jumlah' => $this->input->post('jumlah'),
            'metode' => $metode,
            'status' => 'Out',
            'produk' => strtoupper($this->input->post('produk')),
            'tujuan' => $this->input->post('tujuan'),
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
        redirect('transact/trxpulsa');
    }

    private function _kasmasuk()
    {
        $kasir = $this->session->userdata('uname');

        if ($this->input->post('metodem') == 0) {
            $jalur = $this->input->post('jalur');
        } elseif ($this->input->post('metodem') == 1) {
            $jalur = "KAS";
        }

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
            'jalur' => $jalur
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
        if ($this->input->post('metodek') == 0) {
            $jalur = $this->input->post('jalur');
        } elseif ($this->input->post('metodek') == 1) {
            $jalur = "KAS";
        }

        if ($this->input->post('penerima') == "") {
            $penerima = "---";
        } else {
            $penerima = $this->input->post('penerima');
        }

        $data = [
            'id' => null,
            'idagen' => $penerima,
            'jumlah' => $this->input->post('jumlah'),
            'metode' => $this->input->post('metodek'),
            'status' => 'Out',
            'produk' => '---',
            'tujuan' => $this->input->post('nobukti'),
            'kasir' => $kasir,
            'waktu' => date('Y-m-d H:i:s'),
            'keterangan' => $this->input->post('keterangan'),
            'jalur' => $jalur
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
        $sql = "SELECT * FROM user WHERE uname ='$this->uname'";
        // $data['tanggal'] = date('Y-m-d');
        $data['setting'] = $this->db->get('setting')->row_array();

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();

        $data['nobukti'] = $this->home_model->nomorbukti();

        $data['lastRec'] = $this->home_model->kasOutLastByUser($this->uname);
        $data['recentdep'] = $this->db->limit(5)->order_by('id', 'desc')->get_where('deposit', ['jalur' => 'KAS'])->result_array();

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
        $sql = "SELECT * FROM user WHERE uname ='$this->uname'";
        // $data['tanggal'] = date('Y-m-d');
        $data['setting'] = $this->db->get('setting')->row_array();

        if (null !== $this->input->post('tanggal')) {
            $data['tanggal'] = $this->input->post('tanggal');
        } else {
            $data['tanggal'] = date('Y-m-d');
        };
        $data['user'] = $this->db->query($sql)->row_array();

        $data['nobukti'] = $this->home_model->nomorbukti();

        $data['lastRec'] = $this->home_model->kasOutLastByUser($this->uname);
        $data['recentdep'] = $this->db->limit(5)->order_by('id', 'desc')->get_where('deposit', ['jalur' => 'KAS'])->result_array();

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|alpha_numeric_spaces|trim|min_length[5]');
        $this->form_validation->set_rules('nobukti', 'Nomor Bukti', 'required|trim');
        $this->form_validation->set_rules('penerima', 'Penerima', 'alpha_numeric_spaces|trim');
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

    public function cariAgen()
    {
        // $idagen = $this->input->get('term');
        if (isset($_GET['term'])) {
            $idagen = $_GET['term'];
            $data = $this->db->query("SELECT * FROM contact WHERE idagen like '%$idagen%'");
            if ($data) {
                foreach ($data->result() as $d) {
                    $agen[] = [
                        'idagen' => $d->idagen,
                        'name' => $d->name
                    ];
                }
                echo json_encode($agen);
            }
        }
    }
}
