<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aksescourse_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    //aksescourse
    public function getaksescoursebykategori($idcourse)
    {
        $query = "SELECT * FROM rzl_m_kategori a
            LEFT JOIN rzl_aksescourse b ON a.idkategori=b.idkategori
            LEFT JOIN m_bagian c ON c.bagian_id=b.idbagian
            WHERE b.idkategori='$idcourse'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    // Kategori
    public function allkategori()
    {
        $query = "SELECT * FROM rzl_m_kategori ";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    //Bagian
    public function allbagian()
    {
        $query = "SELECT * FROM m_bagian ";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }




    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function deleteAksesCourse($id, $tabel)
    {
        $this->db->where('idkategori', $id);
        $this->db->delete($tabel);
    }
}
