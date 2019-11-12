<?php

//action.php

sleep(5);

if(isset($_POST['sname']))
{
 $connect = new PDO("mysql:host=localhost;dbname=collegemanagementsystem1", "root", "");
 
 $data = array(
  ':sname'  => $_POST['sname'],
  
  ':mobileno'   => $_POST['mobileno'],
  ':email'   => $_POST['email'],
  ':department'   => $_POST['department']
  
  
 );
 $query = "
 INSERT INTO staff
 (sname,  mobileno, email, phoneno) 
 VALUES (:sname,  :mobileno, :email, :department)
 ";
 $statement = $connect->prepare($query);
 if($statement->execute($data))
 {
  echo 'Registration Completed Successfully...';
 }
}

?>