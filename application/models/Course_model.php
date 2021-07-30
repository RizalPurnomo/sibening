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
        $sql = "SELECT * FROM rzl_getcourse a
                INNER JOIN rzl_m_course b ON a.idcourse=b.idcourse
                WHERE a.nip = '$idpeserta'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function allCourse()
    {
        $sql = "SELECT a.idcourse AS idcourses,a.*,b.* FROM rzl_m_course a
            INNER JOIN rzl_m_kategori b ON a.idkategori=b.idkategori 
            ORDER BY idcourse DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
        // echo $sql;
    }

    public function availableCourse($idpeserta)
    {
        $sql = "SELECT d.idcourse AS idcourses,a.*,b.*,c.*,d.* FROM rzl_aksescourse a
            INNER JOIN m_pegawai b ON a.idbagian=b.bagian
            INNER JOIN rzl_m_kategori c ON c.idkategori=a.idkategori
            INNER JOIN rzl_m_course d ON d.idkategori=a.idkategori
            WHERE nip='$idpeserta'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
        // echo $sql;
    }    

    public function getCourseById($idcourse){
        $sql = "SELECT * FROM rzl_m_course a
            WHERE idcourse='$idcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getCourseDetailById($idgetcourse){
        $sql = "SELECT * FROM rzl_getcourse a
            INNER JOIN rzl_m_course b ON a.idcourse=b.idcourse
            INNER JOIN m_pegawai c ON c.nip=a.nip
            WHERE idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getCourseHasilById($idgetcourse){
        $sql = "SELECT * FROM rzl_m_question a
            INNER JOIN rzl_answer b ON a.idquestion=b.idquestion
            INNER JOIN rzl_answerpost c ON c.idquestion=a.idquestion
            INNER JOIN rzl_getcourse d ON d.idgetcourse=c.idgetcourse
            INNER JOIN rzl_m_course e ON e.idcourse=d.idcourse
            INNER JOIN m_pegawai f ON f.nip=d.nip
            WHERE b.idgetcourse='$idgetcourse' AND c.idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getPreTest($idgetcourse){
        $sql = "SELECT c.idquestion AS idsoal,a.*,b.*,c.*,d.* FROM rzl_getcourse a
            INNER JOIN rzl_m_course b ON a.idcourse=b.idcourse
            LEFT JOIN rzl_m_question c ON c.idcourse=a.idcourse 
            LEFT JOIN rzl_answer d ON d.idquestion=c.idquestion AND d.idgetcourse=a.idgetcourse  
            WHERE a.idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getPostTest($idgetcourse){
        $sql = "SELECT c.idquestion AS idsoal,a.*,b.*,c.*,d.* FROM rzl_getcourse a
            INNER JOIN rzl_m_course b ON a.idcourse=b.idcourse
            LEFT JOIN rzl_m_question c ON c.idcourse=a.idcourse 
            LEFT JOIN rzl_answerpost d ON d.idquestion=c.idquestion AND d.idgetcourse=a.idgetcourse
            WHERE a.idgetcourse='$idgetcourse'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function getSudahDijawab($idgetcourse,$idquestion){
        $sql = "SELECT * FROM rzl_answer
            WHERE idgetcourse='$idgetcourse' AND idquestion='$idquestion'";
        $qry = $this->db->query($sql)->result_array();
        if(empty($qry)){
            return "";
        }else{
            return $qry[0]['idanswer'];
        }
    }

    public function getSudahDijawabPost($idgetcourse,$idquestion){
        $sql = "SELECT * FROM rzl_answerpost
            WHERE idgetcourse='$idgetcourse' AND idquestion='$idquestion'";
        $qry = $this->db->query($sql)->result_array();
        if(empty($qry)){
            return "";
        }else{
            return $qry[0]['idanswerpost'];
        }
    }

    public function getJawabanBenar($idquestion){
        $sql = "SELECT * FROM rzl_m_question
            WHERE idquestion='$idquestion'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function hasil($idgetcourse){
        $sql = "SELECT * FROM rzl_m_question a
            LEFT JOIN rzl_answer b ON a.idquestion=b.idquestion
            LEFT JOIN rzl_answerpost c ON a.idquestion=c.idquestion 
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

    public function getJplFinish(){
        $sql = "SELECT SUM(jpl) AS jplFinish FROM rzl_getcourse a
            INNER JOIN rzl_m_course b ON a.idcourse=b.idcourse
            WHERE flag='finish'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }



    //Kategory
    public function getAllKategori()
    {
        $sql = "SELECT * FROM rzl_m_kategori";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    //Question
    public function getQuestionById($idcourse){
        $sql = "SELECT * FROM rzl_m_question a
            INNER JOIN rzl_m_course b ON a.idcourse=b.idcourse 
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

    //Report
    public function progressPeserta(){
        $sql = "SELECT 
            a.nama_pegawai, 
            SUM(IF(flag!='finish',1,0)) AS progres, 
            SUM(IF(flag='finish',1,0)) AS finish, 
            SUM(IF(flag='finish',c.jpl,0)) AS jplfinish, 
            a.* 
            FROM m_pegawai a
            LEFT JOIN rzl_getcourse b ON a.nip=b.nip
            LEFT JOIN rzl_m_course c ON c.idcourse=b.idcourse
            WHERE a.is_active='1'   
            GROUP BY a.nip";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }    


}
