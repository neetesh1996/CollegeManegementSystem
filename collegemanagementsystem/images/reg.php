<?php
  ob_start();
require 'db.php';
if(isset($_POST['fullname']))
      {
         
        // echo '<script type="text/javascript">alert("Sign|button clicked")</script>';
       
       
        $fullname=$_POST['fullname'];
         $email=$_POST['email'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
        $trn_date = date("Y-m-d H:i:s");
       $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

         if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
          $emailB != $email
          ) {
      echo '<script type="text/javascript">alert("This email adress isn\'t valid!")</script>';
      exit(0);
    }
        if($password == $cpassword)
        {
           $query="select * from users where email = '$email'";
           $query_run=mysqli_query($conn, $query);
           if(mysqli_num_rows($query_run) > 0)
           {
             //there is l=already a user with the same username
             echo '<script type="text/javascript">alert("email already exists..try another email")</script>';

           }
           else
           {
             $query="insert into users values('','$fullname','$email','".md5($password)."','$trn_date')";
             $query_run=mysqli_query($conn,$query);
             if($query_run)
             {
                
                header("location:login.php");
         
                exit();
             }
             else
             {
                 echo '<script type="text/javascript">alert("Error!")</script>';
             }




           }

        }
        else
        {
            echo '<script type="text/javascript">alert("Your password and confirm password does not match")</script>';

        } 
}
ob_end_flush();

        ?>


<!DOCTYPE html>
<html>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/parsley.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.4/build/css/themes/bootstrap.rtl.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.1/parsley.js"></script>
    
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
  width: 45%;
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
 input.parsley-success,
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
 background-image: url("images/d3.jpg");

}

 </style>
   <div class="container">  
   <div class="table-responsive">  
    <h2  class="header" align="center">Register</h2>

    <div class="box">

     <form id="validate_form"  action="" method="">
      <div class="row">
       <div class="col-md-12">
        <div class="form-group">
         <label> Name:</label>
         <input type="text" name="fullname" id="fullname" placeholder="Enter  Name" data-parsley-pattern="^[a-zA-Z ]*$" data-parsley-trigger="keyup" class="form-control" />
         <span class="error_form" id="fname_error_message"></span>
        </div>
       </div>
       
      </div>
      <div class="form-group">
       <label for="email">Email:</label>
       <input type="text" name="email" id="email" placeholder="Email" required data-parsley-type="email" data-parsley-trigger="keyup" class="form-control" />
        <span class="error_form" id="email_error_message"></span>
      </div>
      <div class="form-group">
       <label for="password">Password:</label>
       <input type="password" name="password" id="password" placeholder="Password" required data-parsley-length="[8, 16]" data-parsley-trigger="keyup" class="form-control" />
        <span class="error_form" id="password_error_message"></span>
      </div>
      <div class="form-group">
       <label for="cpassword">Confirm Password:</label>
       <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password"data-parsley-equalto="#password" data-parsley-trigger="keyup" required class="form-control" />
        <span class="error_form" id="retype_password_error_message"></span>
      </div>
     
      
      <div class="form-group">
       <button type="submit" id="submit" name="submit" value="Submit"  class="btn btn-success" >Register</button>
      </div>
      <div>
      
  <p>  Already have account? <a href="login.php">Login here</a></p>
  </div>

     </form>
    </div>
   </div> 
    </body>  
</html>  

      <script type="text/javascript">
       
        function addRecord() {
          event.preventDefault();
          var fullname =$('#fullname').val();
          var email = $('#email').val();
          var password = $('#password').val();
          var cpassword = $('#cpassword').val();
          // event.preventDefault();
         //alertify.confirm("Are you Sure to Add records?",function(e){
         // if (e) {
          $.ajax({
            url:"",
            type:"post",
            data:  {
            fullname : fullname,
            email : email,
            password : password,
           cpassword : cpassword
           },
          success:function(data,status) {
            $('#recods_contant').html(data);
            // alertify.success("<h6> data Added");
           //   return true;

          }

          });
        }
      </script>
<script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
 
 $('#validate_form').on('submit', function(event){
  event.preventDefault();
  if($('#validate_form').parsley().isValid())
  {
   $.ajax({
    url:"",
    method:"POST",
   // data:$(this).serialize(),
   // beforeSend:function(){
   //  $('#submit').attr('disabled','disabled');
    // $('#submit').val('Submitting...');
   // },
    success:function(data)
    {
     $('#validate_form')[0].reset();
     $('#validate_form').parsley().reset();
     $('#submit').attr('disabled',false);
     $('#submit').val('Submit');
     //alert(data);
    }
   });
  }
 });
});  
</script>