<!DOCTYPE html>

<html lang="en">
    <?php
 
?>
    <head>
        <title>register</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
      <h1 class="text-center mt-5" style = "color: orange; font-size: 72px; font-family:cverdana">NotCanvas</h1>
        <h1 class="text-center mt-5" style = "color: orange;  font-family:cverdana">Register</h1>
        <div class="card my-5">

          <form class="card-body cardbody-color p-lg-5" method = "POST">

            <div class="text-center">
              <img src="https://cdn.picpng.com/person/person-individually-alone-icon-49284.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="fname" placeholder="First Name">
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="lname" placeholder="Last Name">
            </div>
            <div class="mb-3">
              <input type="text" class="form-control" name="email" aria-describedby="emailHelp"
                placeholder="Email Address">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
              <select name = "role"class="form-control" id="role">
                <option>Admin</option>
                <option>Student</option>
              </select>
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100" name = "Register">Register</button></div>
          </form>
        </div>
      </div>
    </div>
    </body>

    <?php
       session_start();
       require_once("database.php");
    if(isset($_POST['Register']))
    {
      
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname']; 
    $role = $_POST['role'];
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $query = 'INSERT INTO users (ID, emailAddress,
                  password, firstName, lastName, role)
              VALUES (NULL, :email, :pass, :fname, :lname, :role)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':pass', $hash);
    $statement->bindValue(':fname', $fname);
    $statement->bindValue(':lname', $lname);
    $statement->bindValue(':role', $role);
    $statement->execute();
    $statement->closeCursor();
 
    $query2 = 'SELECT * FROM users
              WHERE emailAddress = :email';
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':email', $email);
    $statement2->execute();
    $row2 = $statement2->fetch();
    $statement2->closeCursor();

    $_SESSION['user'] = $fname." ".$lname;
    $_SESSION['id'] = $row2['ID'];
    $data = [
      $id = $row2['ID']
    ];
    if($statement)
    {
        if($role == "Admin")
        {
            header('Location: admin_homepage.php');
        }
        else
        {
          $query = "INSERT INTO `grades` (`grade_id`, `student_id`, `assignment1`, 
          `assignment2`, `assignment3`) VALUES (NULL, :id, NULL, NULL, NULL);";
          $statement = $db->prepare($query);
          $statement->execute(array(":id"=>$id));
          $statement->closeCursor();
          header('Location: student_homepage.php');
        }
        
    
    }
}
    ?>
</html>

<style>

    body{
        background-color: #EBCFC4;
        
    }
   
    .btn-color{
  background-color: #0e1c36;
  color: #fff;
  
}

.profile-image-pic{
  height: 200px;
  width: 200px;
  object-fit: cover;
}



.cardbody-color{
  background-color: lightblue;
}

a{
  text-decoration: none;
}
    </style>
