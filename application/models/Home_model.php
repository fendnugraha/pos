<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function depositRecap()
    {
        $hariini = date('Y-m-d');

        return $this->db->query("SELECT * FROM deposit")->result_array();
    }
}
