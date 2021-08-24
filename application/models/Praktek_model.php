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
            INNER JOIN rzl_getcourse b ON a.idcourse=b.idcourse AND a.nip=b.nip            
            INNER JOIN rzl_m_course c ON c.idcourse=a.idcourse
            INNER JOIN m_pegawai d ON d.nip=a.nip
            ORDER BY a.idpraktek DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function cekQuotaPraktek($idCourse,$tglPraktek){
        $sql = "SELECT COUNT(nip) AS terisi FROM rzl_praktek 
            WHERE idcourse='$idCourse' AND tglpraktek='$tglPraktek'";
        $qry = $this->db->query($sql);
        return $qry->result_array();        
    }

    public function getPraktek($nip,$idCourse)
    {
        $sql = "SELECT * FROM rzl_praktek a
                INNER JOIN rzl_m_course b ON a.idcourse=b.idcourse
                WHERE a.idcourse='$idCourse' AND a.nip='$nip'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }   
    
    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }  
    
    public function updateNilai($id, $data, $tabel)
    {
        $this->db->where('idpraktek', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }
 
}
