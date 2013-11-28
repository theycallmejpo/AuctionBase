
<?php /* currtime.php - show current time  */
  include ('./sqlitedb.php');
?>


<?php
  $query = "select current_datetime from Time";
  
  try {
    $result = $db->query($query);
    $row = $result->fetch();
    echo "<h4>Current time is: ".htmlspecialchars($row["current_datetime"])." 
    <small><a href='./selecttime.php'>change</a></small></h4>";
  } catch (PDOException $e) {
    echo "Current time query failed: " . $e->getMessage();
  }
  
  $db = null;
?>



