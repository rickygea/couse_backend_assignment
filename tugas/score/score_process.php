<?php
   SESSION_START();
   include("../database.php");
   $db = new Database(); 
   $angka = (isset($_POST['score'])) ? $_POST['score'] : "ga ada";

    $result = $db->execute("INSERT INTO score_tbl(SCORE
                                                       ) VALUES(
														'".$angka."'
                                                   );");

           if($result){    $_SESSION["notification"] = "Cetak Score Berhasil";    }

           else{    
		 
		   $_SESSION["notification"] = "Cetak Score Gagal";     }

      
 //  $_SESSION['scoreid'] 
  // $result = ;
   $row = mysqli_fetch_assoc($db -> get("SELECT MAX(score_id) FROM score_tbl"));
   echo $row['SCORE_ID']
  // header("Location: http://localhost/tugas/user/");   

?>