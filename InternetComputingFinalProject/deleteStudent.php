<?php
require_once("database.php");
include "AdminNavBar.html";

$id = $_GET['id'];
$query = "DELETE FROM users WHERE id= ".$id;
$queryResult = $db->prepare($query);
$queryResult->execute();
  if ($queryResult) {
    header('Location: studentGrades.php');
  }
 ?>
