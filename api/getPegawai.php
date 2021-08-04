<?php
 //Memanggil conn.php yang telah kita buat sebelumnya
 include "conn.php";
 
 //Syntax MySql untuk melihat semua record yang
 //ada di tabel siswa
 $sql = "SELECT * FROM m_pegawai";
  
 //Execetute Query diatas
 $query = mysqli_query($link,$sql);
 while($dt=mysqli_fetch_array($query)){
  $item[] = array(
    "id_pegawai" =>$dt["id_pegawai"],
    "nip" =>$dt["nip"],
    "nama_pegawai" =>$dt["nama_pegawai"],
    "tempat_lahir" =>$dt["tempat_lahir"],
    "tgl_lahir" =>$dt["tgl_lahir"],
    "jenis_kelamin" =>$dt["jenis_kelamin"],
    "no_tlp" =>$dt["no_tlp"],
    "email" =>$dt["email"],
    "alamat" =>$dt["alamat"],
    "agama" =>$dt["agama"],
    "jabatan" =>$dt["jabatan"],
    "bagian" =>$dt["bagian"],
    "pendidikan" =>$dt["pendidikan"],
    "status" =>$dt["status"],
    "rumpun" =>$dt["rumpun"],
    "pajak" =>$dt["pajak"],
    "no_ktp" =>$dt["no_ktp"],
    "npwp" =>$dt["npwp"],
    "norek_dki" =>$dt["norek_dki"],
    "status_pns" =>$dt["status_pns"],
    "bpjs_ks" =>$dt["bpjs_ks"],
    "bpjs_jkk" =>$dt["bpjs_jkk"],
    "bpjs_ijht" =>$dt["bpjs_ijht"],
    "bpjs_jp" =>$dt["bpjs_jp"],
    "pj_cuti" =>$dt["pj_cuti"],
    "foto_url" =>$dt["foto_url"],
    "tgl_masuk" =>$dt["tgl_masuk"],
    "tmt_gaji" =>$dt["tmt_gaji"],
    "is_active" =>$dt["is_active"],
    "tempat_tugas" =>$dt["tempat_tugas"],
    "tempat_tugas_ket" =>$dt["tempat_tugas_ket"],
    "shift_status" =>$dt["shift_status"],
    "golongan" =>$dt["golongan"],
    "nrk" =>$dt["nrk"],
    "gelar_depan" =>$dt["gelar_depan"],
    "gelar_belakang" =>$dt["gelar_belakang"]
  );
 }
 
 
 //Merubah data kedalam bentuk JSON
 echo json_encode($item);
?>
