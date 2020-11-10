<?php

   SESSION_START();

   include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

   $db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya   
$id = $_POST['id'];
   $username = $_POST['username'];

   $email = $_POST['email'];

   $token = ""; // dikosongkan untuk awal

   $status = 1; // status aktif

   $password = md5($_POST['password']);

   $password2 = md5($_POST['password2']);   

   if($password == $password2)

   {

       if($username && $email )

       {

           $result = $db->execute("INSERT INTO user_tbl(
															ID_USER,
                                                           USERNAME,
                                                           PASSWORD,
                                                           TOKEN,
                                                           EMAIL,
                                                           STATUS

                                                       ) VALUES(
														'".$id."',
                                                       '".$username."',
                                                       '".$password."',
                                                       '".$token."',
                                                       '".$email."',
                                                       '".$status."'
                                                   );");

           if($result){    $_SESSION["notification"] = "Register User Berhasil";    }

           else{    
		 
		   $_SESSION["notification"] = "Register User Gagal";     }

       }

   }

   header("Location: http://localhost/tugas/");   

?>