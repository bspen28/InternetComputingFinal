<!DOCTYPE html>

<html lang="en">
    <?php
    session_start();
    require_once('database.php');
?>
    <head>
        <title>login</title>
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
        <h1 class="text-center mt-5" style = "color: orange;  font-family:cverdana">Login</h1>
        <div class="card my-5">

          <form class="card-body cardbody-color p-lg-5" method = "POST" action="login.php">

            <div class="text-center">
              <img src="https://cdn-icons-png.flaticon.com/512/167/167707.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>

            <div class="mb-3">
              <input type="text" class="form-control" name="email" aria-describedby="emailHelp"
                placeholder="Email Address">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="text-center"><button type="submit" class="btn btn-color px-5 mb-5 w-100" name = "Login">Login</button></div>
            <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not
              Registered? <a href="register.php" class="text-dark fw-bold"> Create an Account</a>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>  
    </body>
    <?php
if(isset($_POST['Login']))
{
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $query = 'SELECT * FROM users
              WHERE emailAddress = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    $role = $row['role'];
    $valid_password = password_verify($pass, $hash);
    if ($valid_password) 
    {
      $_SESSION['user'] = $row['firstName']." ".$row['lastName'];
      $_SESSION['id'] = $row['ID'];
      $_SESSION['role'] = $row['role'];
        if($role == 'Admin')
        {
            header('Location: admin_homepage.php');
        }
        else
        {
            header('Location: student_homepage.php');
        }
    }
    else?>{
      <center><div class="alert alert-danger" role="alert">
      Login Failed
    </div></center>
   
    } <?php
}
?> 

</html>

<style>

    body{
        background-color:  #fde3e9;
        
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

