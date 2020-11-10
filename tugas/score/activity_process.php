<?php

   SESSION_START();

   include("../database.php");
   $db = new Database(); 
$id = (isset($_SESSION['id'])) ? $_SESSION['id'] : "";
   $level_id = (isset($_POST['level_id'])) ? $_POST['level_id'] : "";
   $score = $_POST['score'];
   echo $level_id;

    $result = $db->execute("INSERT INTO user_activity_tbl(USER_ID,LEVEL_ID,SCORE
                                                       ) VALUES(
														'".$id."',
                                                       '".$level_id."',
                                                       '".$score."'
                                                   );");

           if($result){   

		   $_SESSION["notification"] = "Pembuatan match history Berhasil";    }

           else{    
		 
		   $_SESSION["notification"] = "Pembuatan match history Gagal";     }

      
   header("Location: http://localhost/tugas/score/submitscore.php");   

?>