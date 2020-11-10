<?php

SESSION_START();

include("database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$username = (isset($_SESSION['username'])) ? $_SESSION['username'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $username)

{

  $result = $db->execute("SELECT * FROM user_tbl WHERE username = '".$username."' AND token = '".$token."' AND status = 1 ");

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

PAGE : REGISTER

<form action="login/register_process.php" method="POST">

<table>
<tr>

      <td>id_user</td><td>:</td><td><input type="text" name="id" required></td>

  </tr>
  <tr>

      <td>username</td><td>:</td><td><input type="text" name="username" required></td>

  </tr>

  <tr>

      <td>password</td><td>:</td><td><input type="password" name="password" required></td>

  </tr>

  <tr>

      <td>password(again)</td><td>:</td><td><input type="password" name="password2" required></td>

  </tr>  

  

  <tr>

      <td>email</td><td>:</td><td><input type="text" name="email" required></td>

  </tr>  


 

  <tr>

      <td colspan=3><input type="submit" value="REGISTER"></td>

  </tr>      

</table>

</form>

<button><a href="http://localhost/tugas/">Back to Login</button>