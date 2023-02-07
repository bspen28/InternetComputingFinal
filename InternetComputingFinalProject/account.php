<!DOCTYPE html>
<?php
session_start();
require_once("database.php");
if($_SESSION['role'] != "Admin")
{
    include "navBar.html";
}
else{
    include "AdminNavBar.html";
}
?>
<html>
    <head>
        <title>Admin-Homepage</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    </head>
      <div>
        <h1><?php echo "Account Info of " . $_SESSION['user']. "";?></h1>
      </div>
      <?php
      $id = $_SESSION['id'];
      $query = "SELECT firstName, lastName, emailAddress, role FROM users WHERE ID = ".$id;
      $queryResult = $db->prepare($query);
      $queryResult->execute();
      $row = $queryResult->fetch();
      $queryResult->closeCursor();
      $fname = $row['firstName'];
      $lname = $row['lastName'];
      $email = $row['emailAddress'];
      $role = $row['role'];
      if($queryResult)
      {
        echo "<h3>First Name: " .$fname. "</h3>";
        echo "<h3>Last Name: " .$lname. "</h3>";
        echo "<h3>Email: " .$email. "</h3>";
        echo "<h3>Role: " .$role. "</h3>";
      }
      ?>
      <br><br>
      <body style = "text-align: center">
        <h1>Update Info</h1>
        <br>
        <form method = "POST">
            <table">
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="first" id = "first" size="25" autofocus/></td>
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="last" id = "last" size="25"/></td>
                </tr>
                <tr>
                <tr>
                    <td>E-mail Address:</td>
                    <td><input type="email" name="email"  id = "email" placeholder="name@domain.com" size="25"/></td>
                </tr>
                </table>
                <br><br>
                <input type = "submit" value = "Update" name = "Update">
        </form>
    </body>
</html>
<?php
    
     if(isset($_POST['Update']))
     {
        $data = [
        $email = $_POST['email'],
        $last = $_POST['last'],
        $first = $_POST['first']
         
        ];
        
        $query = "UPDATE users SET emailAddress = :email, 
        firstName = :first, lastName = :last
        WHERE ID = :id";
        $queryResult = $db->prepare($query);
        $queryResult->execute(array(":email" =>$email, 
        ":first"=>$first, 
        ":last" =>$last,":id"=>$id));
        $queryResult->closeCursor();
        if ($queryResult) {
          header('Location: account.php');
        }


     }
?>