<!DOCTYPE html>
<?php
session_start();
include "AdminNavBar.html";
require_once("database.php");
?>
<html>
    <head>
        <title>Admin-Grades</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
      <body>
	<center>
		</br>
		<table width="80%" cellspacing="0" style="border:3px solid ##fde3e9;border-style: inset;">
			<tr>
				<th>
					<table width="100%" cellspacing="0">
						<tr>
							<th colspan="12" style="border-bottom: 1px solid;background-color:lightblue;padding: 5px 0px;font-size: 45px;">Student Records</th>
						</tr>
						<tr>
                            <th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Student ID</th>
                            <th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">First Name</th>
                            <th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Last Name</th>
							<th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Homework 1</th>
							<th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Homework 2</th>
                            <th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Midterm</th>
							<th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Homework 3</th>
                            <th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Final Exam</th>
                            <th width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Final Grade</th>
                            <th colspan = "2" width="7%" style="background-color: gray;border-bottom: 1px solid;padding: 5px 0px;">Action</th>
                            
						</tr>
						<?php
						$query = "SELECT ID, firstName, lastName, assignment1, assignment2, midterm, assignment3, finalexam
                                    FROM users
                                    LEFT JOIN grades
                                    on users.ID = grades.student_id
                                    INTERSECT
                                    SELECT ID, firstName, lastName, assignment1, assignment2, midterm, assignment3, finalexam
                                    FROM users 
                                    RIGHT JOIN grades
                                    on users.ID = grades.student_id";
                        $queryResult = $db->prepare($query);
                        $queryResult->execute();
                        $queryResult->setFetchMode(PDO::FETCH_OBJ);
                        $result = $queryResult -> fetchAll();
                        $queryResult->closeCursor();
                        //$finalGrade = ($result['assignment1'] + $result['assignment2'] + $result['assignment3']) / 3;
                        if($result)
                        {
                            
                           foreach($result as $row)
                         {
                            $finalGrade = (($row->assignment1) + ($row->assignment2) + 
                            ($row->midterm)+($row->assignment3)+($row->finalexam))/5;
                           ?> 
                           <tr>
                                <td><?= $row->ID; ?></td>
                                <td><?= $row->firstName; ?></td>
                                <td><?= $row->lastName; ?></td>
                                <td><?= $row->assignment1; ?></td>
                                <td><?= $row->assignment2; ?></td>
                                <td><?= $row->midterm; ?></td>
                                <td><?= $row->assignment3; ?></td>
                                <td><?= $row->finalexam; ?></td>
                               <td><?php echo filter_var($finalGrade, FILTER_VALIDATE_INT) == false ? number_format($finalGrade, 2):
                                    number_format($finalGrade)  ?></td>
                                <td> <a href="editGrades.php?id=<?= $row->ID ?>" class="btn btn-info">Edit</a></td>
                                <td><a onclick="return confirm('Are you sure you want to delete this entry?')" href= "deleteStudent.php?id=<?= $row->ID ?>" class='btn btn-danger'>Delete</a></td>
                            </tr>
                            <?php
                         } 
                        }
                        ?> 
					</table>
				</th>
			</tr>
		</table>
	</center>
</body>
</html>
