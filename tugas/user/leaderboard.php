<?php

SESSION_START();

include("../database.php");
$db = new Database(); 
$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "";

$token = (isset($_SESSION['token'])) ? $_SESSION['token'] : "";

if($token && $id)

{

   $result = $db->execute("SELECT * FROM user_tbl WHERE id_user = '".$id."' AND token = '".$token."' AND status = 1 ");

   if(!$result)
   {
echo("gagal1");
//   header("Location: http://localhost/tugas/");
   }

   $userdata = $db->get("SELECT user_tbl.id_user as id, user_tbl.username as username

                       from user_tbl WHERE user_tbl.id_user = '".$id."' ");               

   $userdata = mysqli_fetch_assoc($userdata);  

}

else

{
echo"gagal2";
//   header("Location: http://localhost/tugas/");

}

$notification = (isset($_SESSION['notification'])) ? $_SESSION['notification'] : "";

if($notification)

{

   echo $notification;

   unset($_SESSION['notification']);   

}

?>

PAGE : LEADERBOARD

<table border=1>

   <tr>

       <td>MENU</td>

       <td><a href="http://localhost/tugas/user/">HOME</a></td>

       <td><a href="http://localhost/tugas/score/submitscore.php">SUBMITSCORE</a></td>       

       <td><a href="http://localhost/tugas/user/leaderboard.php">LEADERBOARD</a></td>

       <td><a href="http://localhost/tugas/user/logout.php">LOGOUT</a></td>

   </tr>

</table>

<br>

<form action="http://localhost/tugas/user/leaderboard.php" method='GET'>

       Pilih Level Game

       <select name="levelid">

           <?php

           $gamedata = $db->get("SELECT LEVEL_ID, LEVEL_NAME FROM level_tbl");                                

           while($row = mysqli_fetch_assoc($gamedata))

           {

               ?>

               <option value="<?php echo $row['LEVEL_ID']?>"><?php echo $row['LEVEL_NAME']?></option>

               <?php

           }

           ?>

       </select>

       <input type="submit" value="Tampilkan Leaderboard">

</form>

<?php

if(isset($_GET['levelid']))

{

   echo "LEADERBOARD LEVEL ID :".$_GET['levelid'];

   ?>
   <?php

   $leaderboarddata = $db->get("SELECT user_tbl.USERNAME as username, 
								max(user_activity_tbl.score) as score 
								FROM user_tbl, user_activity_tbl 
								WHERE user_tbl.id_user = user_activity_tbl.user_id AND user_activity_tbl.level_id = ".$_GET['levelid']." 
								GROUP BY user_tbl.id_user 
								ORDER BY score DESC");

   $no = 0;

  if($leaderboarddata != null)
  {
	  ?>
	  
	  

   <table border=1>

   <tr><td>NO</td><td>USERNAME</td><td>SCORE</td></tr>

	  
	  <?php
   while($row = mysqli_fetch_assoc($leaderboarddata))

   {

       $no++;

       ?>

       <tr>

       <td><?php echo $no?></td>

       <td><?php echo $row['username']?></td>

       <td><?php echo $row['score']?></td>               

       </tr>

       <?php

   }
  }
  else
  {
	?>
	<br>
	<?php 
echo "tidak ada data";	
  }
   ?>

   </table>

   <?php

}

?>