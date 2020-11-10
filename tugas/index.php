<?php

SESSION_START();

include("database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $id)

{

   $result = $db->execute("SELECT * FROM user_tbl WHERE ID_USER = '".$id."' AND token = '".$token."' AND status = 1 ");

   if($result)

   {

       // redirect ke halaman user, token valid

       header("Location: http://localhost/tugas/user/");

   }

   // abaikan jika token tidak valid

}

// token tidak tersedia

 

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);

}

?>

PAGE : LOGIN

<form action="login/process.php" method="POST">

<table>

   <tr>

       <td>id</td>

       <td>:</td>

       <td><input type="text" name="id" required></td>

   </tr>

   <tr>

       <td>password</td>

       <td>:</td>

       <td><input type="password" name="password" required></td>

   </tr>

   <tr>

       <td colspan=3><input type="submit" value="LOGIN"></td>

   </tr>       

   </form>   

   <tr>

       <td colspan=3><button><a href="register.php">REGISTER</a></button></td>

   </tr>           

</table>