<?php

$conn = mysqli_connect('localhost', 'root', "",'collegemanagementsystem1');
//

if(isset($_POST["name2check"]) && $_POST["name2check"] != ""){

$mobileno = ($_POST['name2check']); 
$sql_uname_check = mysqli_query($conn, "SELECT mobileno FROM staff WHERE mobileno='$mobileno' LIMIT 1"); 
$uname_check = mysqli_num_rows($sql_uname_check);
if ($uname_check < 1) {
echo '<strong style="color:green; text-transform:lowercase!important; font-size: 10px;">' . $mobileno . ' is available </strong> ';
exit();
} else {
echo '<strong style="color:red; text-transform:lowercase!important;font-size: 10px;">' . $mobileno . ' is taken </strong>';
exit();
}
}
?>