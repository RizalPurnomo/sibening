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
        $query = "SELECT * FROM mkategori a
            LEFT JOIN aksescourse b ON a.idkategori=b.idkategori
            LEFT JOIN mbagian c ON c.bagian_id=b.idbagian
            WHERE b.idkategori='$idcourse'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    // Kategori
    public function allkategori()
    {
        $query = "SELECT * FROM mkategori ";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }

    //Bagian
    public function allbagian()
    {
        $query = "SELECT * FROM mbagian ";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }
}
