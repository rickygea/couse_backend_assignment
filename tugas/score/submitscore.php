<?php

SESSION_START();

include("../database.php"); // sertakan database.php untuk dapat menggunakan class database

$db = new Database(); // membuat objek baru dari class database agar dapat menggunakan fungsi didalamnya

$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $id)

{

   $result = $db->execute("SELECT * FROM user_tbl WHERE ID_user = '".$id."' AND token = '".$token."' AND status = 1 ");

   if(!$result)

   {

       // redirect ke halaman login, data tidak valid
       header("Location: http://localhost/tugas/");

   }

   // abaikan jika token valid

   $userdata = $db->get("SELECT user_tbl.ID_USER as id, user_tbl.USERNAME as username

                       from user_tbl WHERE user_tbl.ID_USER = '".$id."'");               

   $userdata = mysqli_fetch_assoc($userdata);                       

}

else

{

   header("Location: http://localhost/tugas/");

}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);   

}

?>

PAGE : HOME
<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/tugas/user/">HOME</a></td>

       <td><a href="http://localhost/tugas/score/submitscore.php">SUBMITSCORE</a></td>       

       <td><a href="http://localhost/tugas/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/tugas/user/logout.php">LOGOUT</a></td>

   </tr>

   <tr><td align="center" colspan=5>Profile</td></tr>

</table>

<form action="../score/activity_process.php" method="POST">

<?php

$iduser = $id;
?>
<tr>
<td>LEVEL</td><td>:</td>

      <td>

          <select name="level_id" required>

              <option value="">- pick level -</option>

          <?php

          $level = $db->get("SELECT LEVEL_ID, LEVEL_NAME FROM level_tbl");

          if($level)

          {

              while($row = mysqli_fetch_assoc($level))

              {

                  ?>

                  <option value=
				  "<?php echo $row['LEVEL_ID'] ?>"
				  >
				  <?php echo $row['LEVEL_NAME']?>
				  </option>

                  <?php

              }

          }

          ?>

          </select>

      </td>

</tr>
</br>
<tr>
<td>
 <td>score</td><td>:</td><td><input type="text" name="score" required></td>
</td>
</tr>
</br>
 <tr>

      <td colspan=3><input type="submit" value="InputScore"></td>

  </tr>  
  </form>