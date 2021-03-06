<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getValidUser($user, $password)
    {
        $sql = "SELECT * FROM muser 
 				where username='" . $user . "' and password='" . $password . "'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function updateLastLogin($user, $data, $tabel)
    {
        $this->db->where('username', $user);
        $this->db->update($tabel, $data);
        return  "Data " . $user . " Berhasil Diupdate";
    }

    public function getAllUser()
    {
        $sql = "SELECT * FROM muser  order by username desc";
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
