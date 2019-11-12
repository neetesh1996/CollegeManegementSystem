<?php
session_start();
require 'db.php'; 
$registered="";
if (isset($_GET['registered'])) {
    if ($_GET['registered'] == 'true')
      $errorMsg="You Are Successfully Registered , Log In Here..";
               $code= "2";
             }
             $reg="";
if (isset($_GET['reg'])) {
    if ($_GET['reg'] == 'true')
      $errorMsg="You Can Log In Here..";
               $code= "2";
             }

$registere="";
if (isset($_GET['registere'])) {

    if ($_GET['registere'] == 'true')
      $errorMsg="You Are Successfully Log Out , Log In Here..";
               $code= "2"; 
              // header("refresh:5;login.php");
   //echo "<script>alert('Logout Successful, Now You Can Login ');</script>";
//echo "<script>window.location = 'login.php';</script>";


}
if (isset($_POST['login'])) {
    $email=$_POST['email'];
     $password=$_POST['password'];
      if(isset($_REQUEST['remember']))
    $escapeRemember = mysqli_real_escape_string($conn,$_REQUEST['remember']);
 $cookie_time = 60 * 60 * 24 * 30;
   $cookie_time_Onset=$cookie_time+ time();
    if(isset($escapeRemember)) {
        setcookie("email", $email, $cookie_time_Onset);
        setcookie("password", $password, $cookie_time_Onset);
    }else{
        $cookie_time_fromOffset=time() -$cookie_time;
        setcookie("email", '',$cookie_time_fromOffset);
        setcookie("password",'',$cookie_time_fromOffset);
    }
  
     $query="select * from users WHERE email='$email' AND password='".md5($password)."'";
     $query_run = mysqli_query($conn,$query);
     if (mysqli_num_rows($query_run)>0) {
        $row= mysqli_fetch_assoc($query_run);
         //valid
         $q="select id1 from users where email='$email'";
        $p=mysqli_query($conn,$q);
         if (mysqli_num_rows($p)>0) {
        $rw= mysqli_fetch_assoc($p);
         $str = implode(",",$rw);
        header("location:index1.php?id1=$str");
      }
     }
     else
     {
        //invalid
      $errorMsg="Error :Invalid Creadentials";
               $code= "2"; 
       
     }

 }
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
         </title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="http://parsleyjs.org/dist/parsley.js"></script>
         <link rel="stylesheet" href="css/parsley.css">
         <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.1/parsley.js"></script>
   
        <link rel="stylesheet" href="style.css">
	<style >
		*{
	margin: 0px;
	padding: 0px;

}input.parsley-success,
select.parsley-success,
textarea.parsley-success {
  color: #468847;
  background-color: #DFF0D8;
  border: 1px solid #D6E9C6;
}

input.parsley-error,
select.parsley-error,
textarea.parsley-error {
  color: #B94A48;
  background-color: #F2DEDE;
  border: 1px solid #EED3D7;
}

.parsley-errors-list {
  margin: 2px 0 3px;
  padding: 0;
  list-style-type: none;
  font-size: 0.9em;
  line-height: 0.9em;
  opacity: 0;
  color: #B94A48;

  transition: all .3s ease-in;
  -o-transition: all .3s ease-in;
  -moz-transition: all .3s ease-in;
  -webkit-transition: all .3s ease-in;
}

.parsley-errors-list.filled {
  opacity: 1;
}
.parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }

body{

	font-size: 17px;
	background: #F8F8FF;
	background-image: url("images/d3.jpg");
}
.box
 {
   width: 35%;;
  
  background-color:white;
  border:1px solid #ccc;
  border-radius:0px 0px 10px 10px ;
  padding:16px;
  margin:0 auto;
 }
 .header{
  width: 35%;
  margin: 50px auto 0px;
  color: white;
  text-align: center;;
  border: 1px solid #80C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
  background: #5F9EAD;
}

	</style>
  <style type="text/css" >
  .errorMsg{border:1px solid green; }
  .message{color: #0000FF; font-weight:bold; }
  .errorMs{border:1px solid green; }
  .messag{color: green; font-weight:bold; }

 </style>
 <script type="text/javascript">
   setTimeout(function() {
    $('.alert').remove();
}, 50000);
 </script>
</head>  
<body >
 <div class="table-responsive">  
    <h2  class="header" align="center">Login</h2>
    <div class="box">
       <div class="alert alert-info alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <span align="center"  style="margin-top:0px;" ><?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?></span>
  </div>
      
       <span align="center"  style="margin-top:0px;" ><?php if (isset($errorMs)) { echo "<p class='messag'>" .$errorMs. "</p>" ;} ?></span>
     <form id="validate_form" action="" method="post" data-parsley-validate>
      <div class="row">
       <div class="col-md-12">
		<label>Email:</label><br>
		<input type="text" name="email" required data-parsley-type="email" data-parsley-trigger="keyup" style="width: 100%; border-radius: 5px;" value ="<?php if(isset($_COOKIE['email'])) echo $_COOKIE['email']; ?>"/ >
		<label>Pssword:</label><br>
		<input type="password" name="password" required  data-parsley-trigger="keyup" style="width: 100%; border-radius: 5px;" value ="<?php if(isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>">
		
	 <input type="checkbox" name="remember" id ="remember"
    value="1" <?php if(isset($_COOKIE['email'])){echo "checked='checked'";}?> >
    <label for="remember"> Remember Me</label> 
		<a href="email.php"> <span style="float: right;">Forget Password</span></a>
		<button style="margin-left: -0px;"  type="submit" name="login" id="login_btn" class="btn">Login</button>
		
	<br><br>
	<p style="float: left; " > Not an already account? <a href="index.php"><span> Register here</span></a></p><br>
	</div>

  <span<?php if(isset($code) && $code == 2){echo "class=errorMsg" ;}?> ></span>
  <span<?php if(isset($code) && $code == 3){echo "class=errorMs" ;}?> ></span>

</form>
</div>

</div>


 
<!--<?php 
if(isset($_POST['login']))
      {
        // echo '<script type="text/javascript">alert("Sign|button clicked")</script>';
       $connect = new PDO("mysql:host=localhost;dbname=collegemanagementsystem1", "root", "");
 
        $first_name=$_POST['first_name'];
        $password=$_POST['password'];

        $sql="select * from users WHERE first_name= ? AND password=?";
     $query = $connect->prepare($sql);
     $query->execute(array($first_name,$password));
     if ($query->rowCount() >=1) {
        
         //valid
        $_SESSION['first_name']=$first_name;
        
        header('location:index1.php');
     }
     else
     {
        //invalid
        echo '<script type="text/javascript"> alert("Invalid Creadentials")</script>';
     }

 }

?>
-->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>
