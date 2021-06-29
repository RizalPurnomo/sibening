<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getDataById($idData)
    {
        $query = "SELECT * FROM tblprofile WHERE id='$idData'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }
}
