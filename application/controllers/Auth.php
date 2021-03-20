<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
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

        $this->session->set_flashdata('message', '<span>Welcome back, How is it going ?!</span>');
    }

    private function _login()
    {
        $uname = $this->input->post('uname');
        $password = $this->input->post('password');
        $waktu = time();

        $user = $this->db->get_where('user', ['uname' => $uname, 'is_active' => 1])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $sql = "SELECT a.*,b.location_id,c.prefix_code,c.name as loc_name,c.cash_account,d.name as namauser FROM user a
                        JOIN location_access b ON b.user_id = a.id
                        JOIN inv_location c ON c.id = b.location_id
                        JOIN contact d ON d.id = a.name
                        WHERE a.uname='$uname'";

                $user = $this->db->query($sql)->row_array();

                $data = [
                    'user_id' => $user['id'],
                    'uname' => $user['uname'],
                    'role_id' => $user['role_id'],
                    'location_id' => $user['location_id'],
                    'prefix_code' => $user['prefix_code'],
                    'cash_account' => $user['cash_account'],
                    'loc_name' => $user['loc_name'],
                    'namauser' => $user['namauser'],
                    'contact_id' => $user['name'],
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
        $this->session->unset_userdata('uname');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<span class="text-success">See ya !</span>');
        redirect('auth');
    }

    public function register()
    {
        $this->form_validation->set_rules('uname', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'GSM Member Login';
            $this->load->view('auth/register', $data);
        } else {
            //validation success
            $this->_login();
        }

        $this->session->set_flashdata('message', '<span>Welcome back, How is it going ?!</span>');
    }
}
