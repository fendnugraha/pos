<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('home_model');
    }

    public function index()
    {
        $this->form_validation->set_rules('uname', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM Member Login';
            $this->load->view('auth/login', $data);
        } else {
            //validation success
            $this->_login();
        }

        // $this->session->set_flashdata('message', '<span>Welcome back, How is it going ?!</span>');
    }

    private function _login()
    {
        $uname = $this->input->post('uname');
        $password = $this->input->post('password');
        $waktu = time();

        $user = $this->db->get_where('user', ['uname' => $uname, 'is_active' => 1])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sql = "SELECT * FROM user WHERE uname ='$uname'";

                $user = $this->db->query($sql)->row_array();

                $data = [
                    'user_id' => $user['id'],
                    'uname' => $user['uname'],
                    'role_id' => $user['role_id'],
                    'namauser' => $user['name'],
                    'usr_img' => $user['image']
                ];
                $this->session->set_userdata($data);
                $this->db->where('uname', $uname)->update('user', ['last_login' => $waktu]);
                redirect('home');
            } else {
                $this->session->set_flashdata('message', '<span class="text-danger">Password is incorrect !</span>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<span class="text-danger">Username or Password is incorrect !</span>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $uname = $this->session->userdata('uname');
        $sisasaldo = $this->home_model->saldoAkhir();
        $kasakhir = $this->home_model->kasAkhir();
        $this->db->where('uname', $uname)->update(
            'user',
            [
                'last_logout' => time(),
                'sisasaldo' => $sisasaldo,
                'kasakhir' => $kasakhir
            ]
        );
        $this->session->unset_userdata('uname');
        $this->session->unset_userdata('role_id');
        // $this->session->set_flashdata('message', '<span class="text-success">See ya !</span>');
        redirect('auth');
    }

    public function register()
    {
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|max_length[50]');
        $this->form_validation->set_rules('uname', 'Username', 'required|trim|is_unique[user.uname]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('cpassword', 'Confim Password', 'required|trim|matches[password]');

        $data = [
            'id' => null,
            'name' => $this->input->post('name'),
            'uname' => $this->input->post('uname'),
            'image' => 'default.jpg',
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 1,
            'date_created' => time(),
            'last_login' => 0,
            'last_logout' => 0,
            'sisasaldo' => 0,
            'kasakhir' => 0
        ];

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM Member Registrasi';
            $this->load->view('auth/register', $data);
        } else {
            //validation success
            if ($this->db->insert('user', $data)) {
                $this->session->set_flashdata('message', '<span class="text-success">Pendaftaran berhasil. Silahkan kembali ke halaman <a href="' . base_url('auth') . '">Login</a></span>');
                redirect('auth/register');
            } else {
                $this->session->set_flashdata('message', '<span class="text-danger">Pendaftaran GAGAL, Silahkan dicoba kembali atau hubungi administrator!</span>');
                redirect('auth/register');
            }
        }


        // $this->session->set_flashdata('message', '<span>Welcome back, How is it going ?!</span>');
    }
}
