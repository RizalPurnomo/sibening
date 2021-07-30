<?php
 $host = "10.50.171.111";  //Nama Host
 $user = "pkmmatraman"; //Nama User
 $pass = "tanyaDatin2021!"; //Password
 $db = "phcmtrm_intranet"; //Nama Database
  
 //Koneksi
 $link = mysqli_connect($host, $user, $pass)
  or die ();
  
 //Pilih Database
 mysqli_select_db($link,$db)
  or die(" Database Not Found!");
?>