<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $usernameErr = "";
$name = $email = $gender =  $username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["username"])) {
    $usernameErr = "Username is required";
  } else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
      $usernameErr = "Only letters and numbers allowed";
    }
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE HTML>  
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
          integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
   

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
<h2>Register!</h2>
 </div>
  <div class="panel-body">
                    <table class="table">
                        <thead>
                                                    
<p><span class="error">* required field</span></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

  <b>Name:</b> <input type="text" name="name" class="form-control" value="<?php echo $name;?>">
  <span class="error"> * <?php echo $nameErr;?></span>
  <br><br>

 <b> E-mail:</b> <input type="text" name="email" class="form-control" value="<?php echo $email;?>">
  <span class="error"> * <?php echo $emailErr;?></span>
  <br><br>


  <b>Username:</b> <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
  <span class="error"> * <?php echo $usernameErr;?></span>
  <br><br>




  <b> Gender:  </b>
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female"> Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male"> Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other"> Other  
  <span class="error"> * <?php echo $genderErr;?></span>
  <br><br>

  <input type="submit" name="submit" class="btn btn-primary btn-block" value="Register" style="font-weight:bold;">
</thead>
</form>

<?php
echo "<h3>Your info:</h3>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $username;
echo "<br>";
echo $gender;
?>

     </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>