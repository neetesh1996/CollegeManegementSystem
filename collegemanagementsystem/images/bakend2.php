<?php
$conn = mysqli_connect('localhost', 'root', "",'collegemanagementsystem1');

extract($_POST);
if(isset($_POST['readrecords'])){
	$data = '<table class =" table table-bordered table-striped">
    <tr>
    <th>No.</th>
    <th>Name of Staff</th>
    <th>Mobile Number</th>
    <th>Email Id</th>
    <th>Department Name</th>
   
    <th>Edit</th>
    <th>Delete</th>

	</tr>';
	$displayquery = "SELECT * FROM `staff` ";
	$result = mysqli_query($conn,$displayquery);

	if (mysqli_num_rows($result) > 0) {
		
		$number=1;
		while ($row = mysqli_fetch_array($result)) {
			$data .='<tr>
               <td>'.$number.'</td>
               <td>'.$row['sname'].'</td>
                <td>'.$row['mobileno'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['department'].'</td>
                
                <td> <button onclick="GetstaffDetails('.$row['ids'].')"
                class="btn btn-primary editbtn ">Edit</button>
                </td>
                <td> <button onclick="DeleteStaff('.$row['ids'].')"
                class="btn btn-danger">Delete</button>
                </td>



		</tr>	';
		$number++;
		}
	}
	$data.='</table>';
	echo $data;

}
if(isset($_POST['collegename']))
      {
         
        // echo '<script type="text/javascript">alert("Sign|button clicked")</script>';
       
       
        $collegename=$_POST['collegename'];
         $city=$_POST['city'];
        $state=$_POST['state'];
        $phoneno=$_POST['phoneno'];
       
       
    }


	//$_SESSION['message']= "record has been saved";
	//$_SESSION['msg_type']= "success";
	//header("location:index1.php");
	
  if(isset($_POST['sname']) && ($_POST['mobileno']) && ($_POST['email']) && ($_POST['department']))
        {
           $query="select * from staff where email='$email' || mobileno='$mobileno'";
           $query_run = mysqli_query($conn,$query);
           if(mysqli_num_rows($query_run)> 0 )
           {
             //there is l=already a user with the same username
             echo '<script type="text/javascript">alert("email already exists..try another email")</script>';

           }
           else
           {
           	$query= "INSERT INTO `staff`(`sname`, `mobileno`, `email`, `department`) VALUES ('$sname','$mobileno','$email','$department')";
	
	           mysqli_query($conn, $query);

             if($query_run)
             {
                
                 
                header("location:index2.php");
             }
             else
             {
                 echo '<script type="text/javascript">alert("Error!")</script>';
             }




           }

        }


//delete user record
if (isset($_POST['deletids'])) {
	$use_rid=$_POST['deletids'];
	$deletequery = "delete from staff where ids='$use_rid'";
	mysqli_query($conn,$deletequery);
}
// get user datail

if (isset($_POST['ids']) && isset($_POST['ids']) != "") {
	$userid = $_POST['ids'];
	$query = "SELECT * FROM staff WHERE ids = '$userid'";
	if (!$result = mysqli_query($conn,$query)) {
		exit(mysqli_error());

	$_SESSION['message']= "record has been deleted";
	$_SESSION['msg_type']= "danger";
	header("location:index2.php");
	}
	$response = array();
	if (mysqli_num_rows($result) > 0) {
		while ($row =mysqli_fetch_array($result)){
			$response = $row;
		}
	}

else {
	$response['status'] = 200;
	$response['message'] ="data not found!";

}
echo json_encode($response);
}
else
{
	$response['status'] = 200;
	$response['message'] ="Invalid request!";
} 
//
///update table
/*if (isset($_POST['hidden_user_idupd1'])) {
	$hidden_user_idupd1 = $_POST['hidden_user_idupd1'];
	$snameupd = $_POST['snameupd'];
	$mobilenoupd = $_POST['mobilenoupd'];
	$emailupd = $_POST['emailupd'];
	$departmentupd = $_POST['departmentupd'];
	$query = " UPDATE `staff` SET `sname`='$snameupd',`mobileno`= '$mobilenoupd',`email`='$emailupd',`department`='$departmentupd' WHERE  ids ='$hidden_user_idupd1'";
	mysqli_query($conn, $query);
} */
// 
if (isset($_POST['hidden_idupd'])) {
	$hidden_idupd = $_POST['hidden_idupd'];
	$snameupd = $_POST['snameupd'];
	$mobilenoupd = $_POST['mobilenoupd'];
	$emailupd = $_POST['emailupd'];
	$departmentupd = $_POST['departmentupd'];
	$query = " UPDATE `staff` SET `sname`='$snameupd',`mobileno`= '$mobilenoupd',`email`='$emailupd',`department`='$departmentupd' WHERE  ids ='$hidden_idupd'";
	mysqli_query($conn, $query);
}
//

//search
if(isset($_POST['searchi'])){
	$ids = $_POST['searchi'];
	$data = '<table class =" table table-bordered table-striped">
    <tr>
    <th>No.</th>
    <th>Name of Staff</th>
    <th>Mobile Number</th>
    <th>Email Id</th>
    <th>Department Name</th>
   
    <th>Edit</th>
    <th>Delete</th>


	</tr>';
	if($ids == null)
	{
		$query="SELECT * FROM `staff`";
	}
	else{
	$query = "SELECT * FROM `staff` WHERE sname = '$ids' or mobileno = '$ids' or email = '$ids' or department = '$ids'  "; 
         }
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	if (mysqli_num_rows($result) > 0) {
		
		$number=1;
		while ($row = mysqli_fetch_array($result)) {
			$data .='<tr>
               <td>'.$number.'</td>
               <td>'.$row['sname'].'</td>
                <td>'.$row['mobileno'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['department'].'</td>
                
                <td> <button onclick="GetstaffDetails('.$row['ids'].')"
                class="btn btn-primary editbtn ">Edit</button>
                </td>
                <td> <button onclick="DeleteStaff('.$row['ids'].')"
                class="btn btn-danger">Delete</button>
                </td>



		</tr>	';
		$number++;
		}
	}
	$data.='</table>';
	echo $data;

}

?>
<!-- <script type="text/javascript">
	$(document).ready(function(){
		$()
	})

</script> -->