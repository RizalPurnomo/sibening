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
        $sql = "SELECT a.idcourse AS idcourses,a.* FROM mcourse a";
        $qry = $this->db->query($sql);
        return $qry->result_array();
        // echo $sql;
    }

    public function getCourseDetailById($idgetcourse){
        $sql = "SELECT * FROM getcourse a
            INNER JOIN mcourse b ON a.idcourse=b.idcourse
            INNER JOIN mpeserta c ON c.idpeserta=a.idpeserta
            WHERE idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getCourseHasilById($idgetcourse){
        $sql = "SELECT * FROM mquestion a
            inner JOIN answer b ON a.idquestion=b.idquestion
            inner JOIN answerpost c ON c.idquestion=a.idquestion
            INNER JOIN getcourse d ON d.idgetcourse=c.idgetcourse
            INNER JOIN mcourse e ON e.idcourse=d.idcourse
            WHERE b.idgetcourse='$idgetcourse' AND c.idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getPreTest($idgetcourse){
        $sql = "SELECT c.idquestion as idsoal,a.*,b.*,c.*,d.* FROM getcourse a
            INNER JOIN mcourse b ON a.idcourse=b.idcourse
            LEFT JOIN mquestion c ON c.idcourse=a.idcourse 
            LEFT JOIN answer d ON d.idquestion=c.idquestion AND d.idgetcourse=a.idgetcourse
            WHERE a.idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getPostTest($idgetcourse){
        $sql = "SELECT c.idquestion AS idsoal,a.*,b.*,c.*,d.* FROM getcourse a
            INNER JOIN mcourse b ON a.idcourse=b.idcourse
            LEFT JOIN mquestion c ON c.idcourse=a.idcourse 
            LEFT JOIN answerpost d ON d.idquestion=c.idquestion AND d.idgetcourse=a.idgetcourse
            WHERE a.idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getSudahDijawab($idgetcourse,$idquestion){
        $sql = "SELECT * FROM answer
            WHERE idgetcourse='$idgetcourse' AND idquestion='$idquestion'";
        $qry = $this->db->query($sql)->result_array();
        if(empty($qry)){
            return "";
        }else{
            return $qry[0]['idanswer'];
        }
    }

    public function getSudahDijawabPost($idgetcourse,$idquestion){
        $sql = "SELECT * FROM answerpost
            WHERE idgetcourse='$idgetcourse' AND idquestion='$idquestion'";
        $qry = $this->db->query($sql)->result_array();
        if(empty($qry)){
            return "";
        }else{
            return $qry[0]['idanswerpost'];
        }
    }

    public function getJawabanBenar($idquestion){
        $sql = "SELECT * FROM mquestion
            WHERE idquestion='$idquestion'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function hasil($idgetcourse){
        $sql = "SELECT * FROM mquestion a
            LEFT JOIN answer b ON a.idquestion=b.idquestion
            LEFT JOIN answerpost c ON a.idquestion=c.idquestion 
            WHERE b.idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function updateData($id, $data, $tabel)
    {
        $this->db->where('idanswer', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function updateDataPost($id, $data, $tabel)
    {
        $this->db->where('idanswerpost', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function updateFlag($id, $data, $tabel)
    {
        $this->db->where('idgetcourse', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('idgetcourse', $id);
        $this->db->delete($tabel);
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


}
