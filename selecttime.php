
<?php /* selectime.php - let's you choose a new time */
    
    $pageTitle = 'Select Time';
    include ('./header.php');
    include ('./sqlitedb.php');
?>

<center>
<h3> Select a Time </h3> 

 <form method="POST" action="selecttime.php">
  <?php 
    include ('./timetable.html');
  ?>
  </form>

  <?php
    $MM = $_POST["MM"];
    $dd = $_POST["dd"];
    $yyyy = $_POST["yyyy"];
    $HH = $_POST["HH"];
    $mm = $_POST["mm"];
    $ss = $_POST["ss"];    
    $entername = htmlspecialchars($_POST["entername"]);
    
    if($_POST["MM"]) {
      $selectedtime = $yyyy."-".$MM."-".$dd." ".$HH.":".$mm.":".$ss;
	  
  	  try {
  	  
  	  	$db->beginTransaction();

  		#Run command
  	  	$query = "update Time set current_datetime = '$selectedtime';";
  		  $result = $db->query($query);
  		  $db->commit();
        echo '<div class="alert alert-success"><strong>Completed.</strong> Time has been updated.</div>';
        echo '<div class="alert alert-info"><strong>New Time: </strong> '.$selectedtime.'</div>';

  	  } catch (PDOException $e) {
  	  	try {
  	  		$db->rollBack();
  		} catch (PDOException $pe) {}
  		echo "Transaction failed: " . $e->getMessage();
      echo '<div class="alert alert-danger"><strong>Transaction failed: </strong>'.$e->getMessage().'. Try again.</div>';
  	  }

  	  $db = null;
		
    }
?>

</center>
<?php
  include ('./footer.html');
?>


