<?php

   SESSION_START();

   include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

   $db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya   

   $id = $_POST['id'];

   $password = md5($_POST['password']);

   $result = $db->get("SELECT ID_USER FROM user_tbl WHERE ID_USER= '".$id."' AND password='".$password."' ");

   if($result)

   {

       $_SESSION['notification'] = "Berhasil Login, Selamat Datang";

       $token = md5($id."tugas".date("Y-m-d H:i:s"));

       $db->execute("UPDATE user_tbl SET token = '".$token."' WHERE id  = '".$id."'"); // update token to user_tbl

       $_SESSION['token'] = $token;

       $_SESSION['id'] = $id;

      // header("Location: http://localhost/tugas/user/");

   }

   $_SESSION['notification'] = "Gagal Login, Coba lagi";
   header("Location: http://localhost/tugas/");

?>