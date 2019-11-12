<?php

//action.php

sleep(5);

if(isset($_POST['collegename1']))
{
 $connect = new PDO("mysql:host=localhost;dbname=collegemanagementsystem1", "root", "");
 
 $data = array(
  ':collegename1'  => $_POST['collegename1'],
  
  ':city1'   => $_POST['city1'],
  ':state1'   => $_POST['state1'],
  ':phoneno1'   => $_POST['phoneno1']
  
  
 );
 $query = "
 INSERT INTO colleges
 (collegename,  city, state, phoneno) 
 VALUES (:collegename1,  :city1, :state1, :phoneno1)
 ";
 $statement = $connect->prepare($query);
 if($statement->execute($data))
 {
  echo 'Registration Completed Successfully...';
 }
}

?>