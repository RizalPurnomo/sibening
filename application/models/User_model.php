<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getValidUser($email, $password)
    {
        $sql = "SELECT * FROM mpeserta 
 				where email='" . $email . "' and password='" . $password . "'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function updateLastLogin($email, $data, $tabel)
    {
        $this->db->where('email', $email);
        $this->db->update($tabel, $data);
        return  "Data " . $email . " Berhasil Diupdate";
    }

    public function getAllUser()
    {
        $sql = "SELECT * FROM mpeserta  order by email desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function updateData($id, $data, $tabel)
    {
        $this->db->where('email', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('email', $id);
        $this->db->delete($tabel);
    }

    public function getUserById($idUser)
    {
        $query = "SELECT * FROM tbluser WHERE iduser='$idUser'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }
}
