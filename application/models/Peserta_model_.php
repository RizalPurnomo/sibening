<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getValidPeserta($email, $password)
    {
        $sql = "SELECT * FROM aauth_users 
 				where email='" . $email . "' and password='" . $password . "'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function updateLastLogin($email, $data, $tabel)
    {
        $this->db->where('idpeserta', $email);
        $this->db->update($tabel, $data);
        return  "Data " . $email . " Berhasil Diupdate";
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
        $query = "SELECT * FROM aauth_users WHERE idpeserta='$id'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }
}
