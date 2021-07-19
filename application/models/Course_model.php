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
        $sql = "SELECT a.idcourse AS idcourses,a.*,b.* FROM mcourse a
            INNER JOIN mkategori b ON a.idkategori=b.idkategori 
            ORDER BY idcourse DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
        // echo $sql;
    }

    public function availableCourse($idpeserta)
    {
        $sql = "SELECT d.idcourse AS idcourses,a.*,b.*,c.*,d.* FROM aksescourse a
            INNER JOIN mpeserta b ON a.idbagian=b.bagian_id
            INNER JOIN mkategori c ON c.idkategori=a.idkategori
            INNER JOIN mcourse d ON d.idkategori=a.idkategori
            WHERE idpeserta='$idpeserta'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
        // echo $sql;
    }    

    public function getCourseById($idcourse){
        $sql = "SELECT * FROM mcourse a
            WHERE idcourse='$idcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getCourseDetailById($idgetcourse){
        $sql = "SELECT * FROM getcourse a
            INNER JOIN mcourse b ON a.idcourse=b.idcourse
            INNER JOIN aauth_users c ON c.id=a.idpeserta
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
            INNER JOIN mpeserta f ON f.idpeserta=d.idpeserta
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

    public function updateCourse($id, $data, $tabel)
    {
        $this->db->where('idcourse', $id);
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

    public function deleteCourse($id, $tabel)
    {
        $this->db->where('idcourse', $id);
        $this->db->delete($tabel);
    }



    //Kategory
    public function getAllKategori()
    {
        $sql = "SELECT * FROM mkategori";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    //Question
    public function getQuestionById($idcourse){
        $sql = "SELECT * FROM mquestion a
            INNER JOIN mcourse b ON a.idcourse=b.idcourse 
            WHERE a.idcourse='$idcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }    

    public function updateQuestion($id, $data, $tabel)
    {
        $this->db->where('idquestion', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    } 


    ///------------------------

    public function getDataById($idData)
    {
        $query = "SELECT * FROM tblaset WHERE id_aset='$idData'";
        $sql = $this->db->query($query);
        return $sql->result_array();
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
