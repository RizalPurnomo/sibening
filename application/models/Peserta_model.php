<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getValidPeserta($username, $password)
    {
        $sql = "SELECT * FROM mpeserta 
 				where username='" . $username . "' and password='" . $password . "'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function updateLastLogin($username, $data, $tabel)
    {
        $this->db->where('idpeserta', $username);
        $this->db->update($tabel, $data);
        return  "Data " . $username . " Berhasil Diupdate";
    }

    public function getAllPeserta()
    {
        $sql = "SELECT * FROM mpeserta  order by idpeserta desc";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function updateData($id, $data, $tabel)
    {
        $this->db->where('idpeserta', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('idpeserta', $id);
        $this->db->delete($tabel);
    }

    public function getPesertaById($id)
    {
        $query = "SELECT * FROM mpeserta WHERE idpeserta='$id'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }
}
