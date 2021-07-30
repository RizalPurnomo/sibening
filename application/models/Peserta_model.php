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
        $sql = "SELECT * FROM aauth_users 
 				where username='" . $username . "' and pass='" . $password . "'";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function updateLastLogin($username, $data, $tabel)
    {
        $this->db->where('nip', $username);
        $this->db->update($tabel, $data);
        return  "Data " . $username . " Berhasil Diupdate";
    }

    public function getAllPeserta()
    {
        $sql = "SELECT * FROM m_pegawai a
            LEFT JOIN m_bagian b ON a.bagian= b.bagian_id 
            LEFT JOIN m_jabatan c on c.id_jabatan=a.jabatan
            WHERE a.is_active='1'   
            ORDER BY nip DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }

    public function saveData($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }

    public function updateData($id, $data, $tabel)
    {
        $this->db->where('nip', $id);
        $this->db->update($tabel, $data);
        return  "Data " . $id . " Berhasil Diupdate";
    }

    public function deleteData($id, $tabel)
    {
        $this->db->where('nip', $id);
        $this->db->delete($tabel);
    }

    public function getPesertaById($id)
    {
        $query = "SELECT * FROM m_pegawai WHERE nip='$id'";
        $sql = $this->db->query($query);
        return $sql->result_array();
    }


    public function getPesertaTerdaftar()
    {
        $sql = "SELECT * FROM rzl_getcourse a
            INNER JOIN m_pegawai b ON a.nip=b.nip
            INNER JOIN rzl_m_course c ON c.idcourse=a.idcourse
            INNER JOIN rzl_m_kategori d ON d.idkategori=c.idkategori
            ORDER BY datecourse DESC";
        $qry = $this->db->query($sql);
        return $qry->result_array();
    }
}
