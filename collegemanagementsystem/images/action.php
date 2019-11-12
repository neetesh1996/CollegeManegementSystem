
 <?php

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

        ?>

<!--


if(isset($_POST['fullname']))
{
 $connect = new PDO("mysql:host=localhost;dbname=collegemanagementsystem1", "root", "");
 
 $data = array(
  ':fullname'  => $_POST['fullname'],
  
  ':email'   => $_POST['email'],
  ':password'   => $_POST['password']
  
);
 $query = "
 INSERT INTO users
 (fullname,  email, password) 
 VALUES (:fullname,  :email, :password)
 ";
 $statement = $connect->prepare($query);
 if($statement->execute($data))
 {
  echo '<button>login</button>Registration Completed Successfully... click to login..';
   
 }
}*/

?>