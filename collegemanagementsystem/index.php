

 <?php
session_start();
require 'db.php';
if(isset($_POST['submit']))
      {
        $fullname=$_POST['fullname'];
         $email=$_POST['email'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $trn_date = date("Y-m-d H:i:s");
       
        if($password == $cpassword)
        { 
           $query="select * from users where email = '$email'";
           $query_run=mysqli_query($conn, $query);
           if(mysqli_num_rows($query_run) > 0)
           {
             //there is l=already a user with the same username
               $errorMsg="Error:This email already exists..try another email";
               $code= "2";
           }
           else
           {
             $query="insert into users values('','$fullname','$email','".md5($password)."','$trn_date')";
             $query_run=mysqli_query($conn,$query);
             if($query_run)
             {
                $_SESSION['fullname']=$row['fullname'];
                $_SESSION['email']=$row['email'];
                header("location:login.php?registered=true");
             }
             else
             {
               $errorMsg="Error:Error!";
               $code= "2";  
             }
           }
        }
        else
        {
          $errorMsg="Error :Your password and confirm password does not match";
               $code= "2"; 
        }      
      }
        ?>
<!DOCTYPE html>
<html>
  <head>  
        <title>PHP Form
        </title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="http://parsleyjs.org/dist/parsley.js"></script>
         <link rel="stylesheet" href="css/parsley.css">
         <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.1/parsley.js"></script>
   
        <link rel="stylesheet" href="style.css">
        <style type="text/css" >
  .errorMsg{border:1px solid red; }
  .message{color: red; font-weight:bold; }
 </style>

    </head>
 <style>
#submit{
  margin-bottom: 10px;
  margin-top: 10px;
  background-color:#2471A3;
  padding: 5px;
  color: white;
  width: 100%;
  text-align: center;
  font-size: 18px;
  font-weight: bold;
  border-radius: 5px;

}
  .box
 {
  width:100%;
  max-width:455px;
  background-color:white;
  border:1px solid #ccc;
  border-radius:0px 0px 10px 10px ;
  padding:16px;
  margin:0 auto;
 }
 .header{
  float: center;
  width: 40%;
  margin: 50px auto 0px;
  max-width:455px;
  color: white;
  text-align: center;;
  border: 1px solid #80C4DE;
  border-bottom: none;
  border-radius: 10px 10px 0px 0px;
  padding: 20px;
  background: #5F9EAD;
}
 
 body{
 background-image: url("images/d3.jpg");
}
 </style>
<style type="text/css" >
  .errorMsg{border:1px solid green; }
  .message{color: red; font-weight:bold; }
 </style>
    <body style="">  
        <div class="container">  
   <div class="table-responsive">  
    <h2  class="header" align="center">Register</h2>
    <div class="box">
       <span align="center"  style="margin-top:0px;" ><?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?></span>
     <form id="validate_form" action="" method="post" name="reset" data-parsley-validate >
      
      <div class="row">
       <div class="col-md-12">
        <div class="form-group">
         <label> Name:</label>
         <input type="text" name="fullname" id="form_fname" placeholder="Enter  Name" required data-parsley-pattern="^[a-zA-Z ]*$" data-parsley-trigger="keyup" class="form-control" autocomplete="off" value= "<?php if(isset($_POST["fullname"])) echo $_POST["fullname"]; ?>"/>
         <span class="error_form" id="fname_error_message"></span>
        </div>
       </div>
       
      </div>
      <div class="form-group">
       <label for="email">Email:</label>
       <input type="text" name="email" id="form_email" placeholder="Email" required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" autocomplete="off" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>" />
        <span class="error_form" id="email_error_message"></span>
      </div>
      <div class="form-group">
       <label for="password">Password:</label>
       <input type="password" name="password" id="form_password" placeholder="Password" required data-parsley-minlength="8" data-parsley-trigger="keyup" class="form-control"  autocomplete="off"/>
        <span class="error_form" id="password_error_message"></span>
      </div>
      <div class="form-group">
       <label for="cpassword">Confirm Password:</label>
       <input type="password" name="cpassword" id="form_retype_password" placeholder="Confirm Password" data-parsley-equalto="#form_password" data-parsley-trigger="keyup" required class="form-control"  autocomplete="off" />
        <span class="error_form" id="retype_password_error_message"></span>
      </div>
     
      
      <div class="form-group">
       <button type="submit" id="submit" name="submit" value="Submit"  class="btn btn-success"  >Register</button>
      </div>
      <div>
      
  <p>  Already have account? <a href="login.php?reg=true">Login here</a></p>

  </div>
  <span<?php if(isset($code) && $code == 2){echo "class=errorMsg" ;}?> ></span>

     </form>
    </div>
   </div> 
  
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

    </body>  
</html>  
<!--action.php

if(!preg_match("/^[_\.0-9a-zA-Z-$&+,:;=?#|'<>.^*{}%!-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,10}$/i", $email)){
            $errorMsg="Error :This email adress is not valid!";
               $code= "2"; 

       //  echo '<script type="text/javascript">alert("This email adress isn\'t valid!")</script>';
      

          }
          elseif(strlen($password) > 7)
          {
-->

  <!-- <script type="text/javascript">
    function validate() {
    
    var valid = true;
    valid = check_fname($("#form_fname"));
    valid = valid && check_email($("#email"));
    
    $("#submit").attr("disabled",true);
    if(valid) {
      $("#submit").attr("disabled",false);
    } 
  }
    $(function() {
        $("#fname_error_message").hide();
        $("#sname_error_message").hide();
        $("#email_error_message").hide();
        $("#password_error_message").hide();
        $("#retype_password_error_message").hide();
        var error_fname = false;
        var error_sname = false;
        var error_email = false;
        var error_password = false;
        var error_retype_password = false;
        $("#form_fname").focusout(function(){
            check_fname();
        });
        $("#form_sname").focusout(function() {
            check_sname();
        });
        $("#form_email").focusout(function() {
            check_email();
        });
        $("#form_password").focusout(function() {
            check_password();
        });
        $("#form_retype_password").focusout(function() {
            check_retype_password();
        });
        function check_fname() {
            var pattern = /^[a-zA-Z ]*$/;
            var fname = $("#form_fname").val();
            if (pattern.test(fname) && fname !== '') {
                $("#fname_error_message").hide();
                $("#form_fname").css("background","#E0FFE6");
            } else {
                $("#fname_error_message").html('<span style="color:purple" >Should contain only Characters</span>');
                $("#fname_error_message").show();
                $("#form_fname").css("background","#FFE1DB");
                error_fname = true;
            }
        }
        function check_sname() {
            var pattern = /^[a-zA-Z]*$/;
            var sname = $("#form_sname").val()
            if (pattern.test(sname) && sname !== '') {
                $("#sname_error_message").hide(); AB9998
                $("#form_sname").css("background","#E0FFE6");
            } else {
                $("#sname_error_message").html('<span style="color:purple" > Should contain only Characters </span>');
                $("#sname_error_message").show();
                $("#form_sname").css("border","1px solid #F90A0A");
                error_fname = true;
            }
        }
        function check_password() {
            var password_length = $("#form_password").val().length;
            if (password_length < 8) {
                $("#password_error_message").html('<span style="color:purple" > Atleast 8 Characters </span>');
                $("#password_error_message").show();
                $("#form_password").css("background","#FFE1DB");
                error_password = true;
            } else {
                $("#password_error_message").hide();
                $("#form_password").css("background","#E0FFE6");
            }
        }
        function check_retype_password() {
            var password = $("#form_password").val();
            var retype_password = $("#form_retype_password").val();
            if (password !== retype_password) {
                $("#retype_password_error_message").html(' <span style="color:purple" >Passwords Did not Matched </span>');
                $("#retype_password_error_message").show();
                $("#form_retype_password").css("background","#FFE1DB");
                error_retype_password = true;
            } else {
                $("#retype_password_error_message").hide();
                $("#form_retype_password").css("background","#E0FFE6");
            }
        }
        function check_email() {
           /* var pattern = /^((([a-zA-Z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-zA-Z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-zA-Z]|\d|-|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-zA-Z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/;*/
             var pattern = /^[_\.0-9a-zA-Z-$&+,:;=?#|'<>.^*{}%!-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,10}$/i;
            var email = $("#form_email").val();
            if (pattern.test(email) && email !== '') {
                $("#email_error_message").hide();
                $("#form_email").css("background","#E0FFE6");
            } else {
                $("#email_error_message").html('<span style="color:purple" > Invalid Email </span>');
                $("#email_error_message").show();
                $("#form_email").css("background","#FFE1DB");
                error_email = true;
            }
        }
        $("#registration_form").submit(function(e) {
            e.preventDefault();
            error_fname = false;
            error_sname = false;
            error_email = false;
            error_password = false;
            error_retype_password = false;
            check_fname();
            check_sname();
            check_email();
            check_password();
            check_retype_password();
            if (error_fname === false && error_sname === false && error_email === false && error_password === false && error_retype_password === false) {
                alert("Registration Successfull");
                return true;
            } else {
                alert("Please Fill the form Correctly");
                return false;
            }
        });
    });
 /*window.onload = function() {

        // If sessionStorage is storing default values (ex. name), exit the function and do not restore data
        if (sessionStorage.getItem('fullname') == "fullname") {
            return;
        }

        // If values are not blank, restore them to the fields
        var fullname = sessionStorage.getItem('fullname');
        if (fullname !== null) $('#form_fname').val(fullname);

        var email = sessionStorage.getItem('email');
        if (email !== null) $('#form_email').val(email);

        var username= sessionStorage.getItem('username');
        if (username!== null) $('#form_sname').val(username);

       
    }

    // Before refreshing the page, save the form data to sessionStorage
    window.onbeforeunload = function() {
        sessionStorage.setItem("fullname", $('#form_fname').val());
        sessionStorage.setItem("email", $('#form_email').val());
        sessionStorage.setItem("username", $('#form_sname').val());
       
    } */
</script> -->

<!-- <script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
 
 $('#validate_form').on('submit', function(event){
  event.preventDefault();
  if($('#validate_form').parsley().isValid())
  {
   $.ajax({
    url:"Register.php",
    method:"POST",
    data:$(this).serialize(),
    beforeSend:function(){
     $('#submit').attr('disabled','disabled');
     $('#submit').val('Submitting...');
    },
    success:function(data)
    {
     $('#validate_form')[0].reset();
     $('#validate_form').parsley().reset();
     $('#submit').attr('disabled',false);
     $('#submit').val('Submit');
     alert(data);
    }
   });
  }
 });
});  
</script> 

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script> --> 

