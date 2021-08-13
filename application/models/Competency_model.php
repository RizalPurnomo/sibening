<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Competency_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //Competency
    public function getCompetencyByNip($nip)
    {
        $sql = "SELECT * FROM rzl_m_competency
                WHERE nip='$nip'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getCompetencyById($id)
    {
        $sql = "SELECT * FROM rzl_m_competency
                WHERE idcompetency='$id'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }    

    public function deleteCompetency($id, $tabel)
    {
        $this->db->where('idcompetency', $id);
        $this->db->delete($tabel);
    }   
    
    public function updateCompetency($id, $data, $tabel)
    {
        $this->db->where('idcompetency', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }       
    
    public function getAllCompetency()
    {
        $sql = "SELECT * FROM rzl_m_competency a
            INNER JOIN m_pegawai b on a.nip=b.nip";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getSumJplApproved(){
        $sql = "SELECT sum(jplapproved) as jplApproved FROM rzl_m_competency 
            where statuscompetency='approved';";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }    
}
