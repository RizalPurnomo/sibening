<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getCourse($idpeserta)
    {
        $sql = "SELECT * FROM getcourse a
                INNER JOIN mcourse b ON a.idcourse=b.idcourse
                WHERE a.idpeserta = '$idpeserta'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function allCourse()
    {
        $sql = "SELECT * FROM mcourse a";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getPreTest($idgetcourse){
        $sql = "SELECT * FROM getcourse a
            INNER JOIN mcourse b ON a.idcourse=b.idcourse
            LEFT JOIN mquestion c ON c.idcourse=b.idcourse
            LEFT JOIN answer d ON d.idquestion=c.idquestion
            WHERE a.idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    ///------------------------

    public function getDataById($idData)
    {
        $query = "SELECT * FROM tblaset WHERE id_aset='$idData'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    public function getAllType()
    {
        $sql = "select * from tbltype_aset";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getAllJenis()
    {
        $sql = "select * from tbljenis_aset";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getAllNama()
    {
        $sql = "select * from tblnama_aset";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function updateData($id, $data, $tabel)
    {
        $this->db->where('id_aset', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('id_aset', $id);
        $this->db->delete($tabel);
    }
}
