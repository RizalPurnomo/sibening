<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diklat_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getDiklatAll()
    {
        $sql = "SELECT * FROM rzl_m_diklat";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }     

    public function getJenisDiklatAll()
    {
        $sql = "SELECT * FROM rzl_m_jenisdiklat";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }  
    
    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }    
    
}
