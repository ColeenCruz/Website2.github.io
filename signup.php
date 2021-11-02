<!DOCTYPE html>
<?php require_once("config.php"); ?>
<html>
<head>
<title> REGISTRATION FORM </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"> 
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body >
    <div class="row">
    <div class="col-sm-4">
    </div>
     <div class="col-sm-4">
    </div>
  </div>
  <div class="row">

<?php 
 if(isset($_POST['signup'])){
  extract($_POST);
  if(strlen($fname)<3){ // Minimum 
      $error[] = 'Please enter First Name using 3 charaters atleast.';
        }
if(strlen($fname)>20){  // Max 
      $error[] = 'First Name: Max length 20 Characters Not allowed';
        }
if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/", $fname)){
            $error[] = 'Invalid Entry First Name. Please Enter letters without any Digit or special symbols like ( 1,2,3#,$,%,&,*,!,~,`,^,-,)';
        }   
  if(strlen($mname)<3){ // Minimum 
      $error[] = 'Please enter First Name using 3 charaters atleast.';
        }
if(strlen($mname)>20){  // Max 
      $error[] = 'Middle Name: Max length 20 Characters Not allowed';
        }
if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/", $mname)){
            $error[] = 'Invalid Entry Middle Name. Please Enter letters without any Digit or special symbols like ( 1,2,3#,$,%,&,*,!,~,`,^,-,)';
        }   
if(strlen($lname)<3){ // Minimum 
      $error[] = 'Please enter Last Name using 3 charaters atleast.';
        }
if(strlen($lname)>20){  // Max 
      $error[] = 'Last Name: Max length 20 Characters Not allowed';
        }
if(!preg_match("/^[A-Za-z _]*[A-Za-z ]+[A-Za-z _]*$/", $lname)){
            $error[] = 'Invalid Entry Last Name. Please Enter letters without any Digit or special symbols like ( 1,2,3#,$,%,&,*,!,~,`,^,-,)';
              }    
      if(strlen($username)<3){ // Change Minimum Lenghth   
            $error[] = 'Please enter Username using 3 charaters atleast.';
        }
  if(strlen($username)>50){ // Change Max Length 
            $error[] = 'Username : Max length 50 Characters Not allowed';
        }
  if(!preg_match("/^^[^0-9][a-z0-9]+([_-]?[a-z0-9])*$/", $username)){
            $error[] = 'Invalid Entry for Username. Enter lowercase letters without any space and No number at the start- Eg - myusername, okuniqueuser or myusername123';
        }  
if(strlen($email)>50){  // Max 
            $error[] = 'Email: Max length 50 Characters Not allowed';
        }
   if($cpassword ==''){
            $error[] = 'Please confirm the password.';
        }
        if($password != $cpassword){
            $error[] = 'Passwords do not match.';
        }
          if(strlen($password)<5){ // min 
            $error[] = 'The password is 6 characters long.';
        }
        
         if(strlen($password)>20){ // Max 
            $error[] = 'Password: Max length 20 Characters Not allowed';
        }
          $sql="select * from users where (username='$username' or email='$email');";
      $res=mysqli_query($dbc,$sql);
   if (mysqli_num_rows($res) > 0) {
$row = mysqli_fetch_assoc($res);

     if($username==$row['username'])
     {
           $error[] ='Username already Exists.';
          } 
       if($email==$row['email'])
       {
            $error[] ='Email already Exists.';
          } 
      }
         if(!isset($error)){ 
              $date=date('Y-m-d');
            $options = array("cost"=>4);
   
            
           $result = mysqli_query($dbc,"INSERT into users values('','$fname','$mname','$lname','$username','$email','$password')");

           if($result)
    {
     $done=2; 
    }
    else{
      $error[] ='Failed : Something went wrong';
    }
 }
 } ?>

     <div class="col-sm-4">
     
 <?php 
  if(isset($error)){ 
foreach($error as $error){ 
  echo '<p class="errmsg">&#x26A0;'.$error.' </p>'; 
}
}
?>
    </div>

    <div class="col-sm-4">
      <?php if(isset($done)) 
      { ?>
    <div class="successmsg"><span style="font-size:100px;">&#9989;</span> <br> <b>You have registered successfully!</b> <br> 
  <div class="input">   
      <?php

echo "Firstname: $fname";
echo "<br>";
echo "Middlename: $mname";
echo "<br>";
echo "Lastname: $lname";
echo "<br>";
echo "Username: $username";
echo "<br>";
echo "Email: $email";
echo "<br>";
echo "Password: $password";
echo "<br>";
echo "Confirm Password: $cpassword";
echo "<br>";
?>
</div>
    </div>
      <?php } else { ?>
  
  <div class="signup_form">
    <form action="" method="POST">
 
  <div class="form-group">
    <img src="logo.png" alt="pastry" class="logo">
    <br>
    <p>Fill in this form to create an account.</p>
    <label class="label_txt">First Name</label>
    <input type="text" class="form-control" name="fname" value="<?php if(isset($error)){ echo $_POST['fname'];}?>" required="">
  </div>

  <div class="form-group">
    <label class="label_txt">Middle Name </label>
    <input type="text" class="form-control" name="mname" value="<?php if(isset($error)){ echo $_POST['mname'];}?>" required="">
  </div>

  <div class="form-group">
    <label class="label_txt">Last Name </label>
    <input type="text" class="form-control" name="lname" value="<?php if(isset($error)){ echo $_POST['lname'];}?>" required="">
  </div>
 
<div class="form-group">
    <label class="label_txt">Username </label>
    <input type="text" class="form-control" name="username" value="<?php if(isset($error)){ echo $_POST['username'];}?>" required="">
  </div>

<div class="form-group">
    <label class="label_txt">Email </label>
    <input type="email" class="form-control" name="email" value="<?php if(isset($error)){ echo $_POST['email'];}?>" required="">
  </div>

  <div class="form-group">
    <label class="label_txt">Password </label>
    <input type="password" name="password" class="form-control" required="">
  </div>

   <div class="form-group">
    <label class="label_txt">Confirm Password </label>
    <input type="password" name="cpassword" class="form-control" required="">
  </div>

  <button type="submit" name="signup" class="btn btn-primary btn-group-lg form_btn">SignUp</button>
   <p>Already have an account?  <a href="login.php">Log in</a> </p>
</form>
<?php } ?> 
</div>
    </div>
    <div class="col-sm-4">
    </div>

  </div>
</div> 
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>