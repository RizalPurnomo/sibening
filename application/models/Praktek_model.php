<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Praktek_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

       
    public function getAllPraktek()
    {
        $sql = "SELECT * FROM rzl_praktek a
            INNER JOIN rzl_m_course b ON a.idcourse=b.idcourse
            INNER JOIN rzl_getcourse c ON c.idcourse=a.idcourse
            INNER JOIN m_pegawai d ON d.nip=a.nip";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }
 
}
