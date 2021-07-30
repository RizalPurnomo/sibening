<?php
 //Memanggil conn.php yang telah kita buat sebelumnya
 include "conn.php";
 
 //Syntax MySql untuk melihat semua record yang
 //ada di tabel siswa
 $sql = "SELECT * FROM aauth_users";
  
 //Execetute Query diatas
 $query = mysqli_query($link,$sql);
 while($dt=mysqli_fetch_array($query)){
  $item[] = array(
    "id" =>$dt["id"],
    "email" =>$dt["email"],
    "pass" =>$dt["pass"],
    "username" =>$dt["username"],
    "banned" =>$dt["banned"],
    "last_login" =>$dt["last_login"],
    "last_activity" =>$dt["last_activity"],
    "date_created" =>$dt["date_created"],
    "forgot_exp" =>$dt["forgot_exp"],
    "remember_time" =>$dt["remember_time"],
    "remember_exp" =>$dt["remember_exp"],
    "verification_code" =>$dt["verification_code"],
    "totp_secret" =>$dt["totp_secret"],
    "ip_address" =>$dt["ip_address"],
    "nama_lengkap" =>$dt["nama_lengkap"],
    "nip" =>$dt["nip"],
    "is_upd_username" =>$dt["is_upd_username"]
  );
 }
 
 
 //Merubah data kedalam bentuk JSON
 echo json_encode($item);
?>
