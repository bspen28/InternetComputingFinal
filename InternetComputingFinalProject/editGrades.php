<!DOCTYPE html>
<?php
require_once("database.php");
include "AdminNavBar.html";

$id = $_GET['id'];
$query = "SELECT * FROM grades WHERE student_id = ".$id;
$queryResult = $db->prepare($query);
$queryResult->execute();
$queryResult->setFetchMode(PDO::FETCH_OBJ);
$result = $queryResult -> fetchAll();

if (isset ($_POST['assignment1']) && isset ($_POST['midterm'])  
&& isset($_POST['assignment2'])  && isset($_POST['assignment3'])&& isset ($_POST['finalexam']) ) {
 $data = [
  $assignment1 = $_POST['assignment1'],
  $assignment2 = $_POST['assignment2'],
  $midterm = $_POST['midterm'],
  $assignment3 = $_POST['assignment3'],
  $finalexam = $_POST['finalexam']
 ];
  $query2 = "UPDATE grades SET assignment1 = :assignment1, assignment2 = :assignment2,
  midterm = :midterm, assignment3 = :assignment3, finalexam = :finalexam
                              WHERE student_id = :id";
  $queryResult2 = $db->prepare($query2);
  $queryResult2->execute(array(":assignment1" =>$assignment1, ":assignment2"=>$assignment2, ":midterm" =>$midterm,":assignment3"=>$assignment3, ":finalexam" =>$finalexam,":id"=>$id));
  $queryResult2->closeCursor();
  if ($queryResult2) {
    header('Location: studentGrades.php');
  }
}


 ?>
 <html>
<div class="container">
  <div class="card mt-5">
    <div class="card-header">
      <h2>Update Grades</h2>
    </div>
      <form method="post">
        <div class="form-group">
          <label for="assignment1">Assignment 1: </label>
          <input value="" type="text" name="assignment1" id="assignment1" class="form-control">
        </div>
        <div class="form-group">
          <label for="assignment2">Assignment 2: </label>
          <input value="" type="text" name="assignment2" id="assignment2" class="form-control">
          </div>
          <div class="form-group">
          <label for="assignment1">Midterm: </label>
          <input value="" type="text" name="midterm" id="midterm" class="form-control">
        </div>  
        <div class="form-group">
        <label for="assignment3">Assignment 3: </label>
          <input value="" type="text" name="assignment3" id="assignment3" class="form-control">
          </div> 
          <div class="form-group">
          <label for="assignment1">Final Exam: </label>
          <input value="" type="text" name="finalexam" id="finalexam" class="form-control">
        </div>
          <div class="form-group">
          <button type="submit" class="btn btn-info">Update Grades</button>
        </div>
      </form>
    </div>
  </div>
  </html>