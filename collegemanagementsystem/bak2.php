<?php
session_start();
$conn = mysqli_connect('localhost', 'root', "",'collegemanagementsystem1');
  
extract($_POST);
if(isset($_POST['readrecord'])){
  $ids = $_SESSION['ids'];
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
	$displayquery = "SELECT * FROM `staff` WHERE ids=$ids ";
 /*$displayquery = "SELECT staff.id,staff.sname, staff.mobileno, staff.email,staff.department
    FROM staff, colleges
    WHERE staff.ids = colleges.ids";*/
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
                
                <td> <button onclick="GetUserDetails('.$row['id'].')"
                class="btn btn-primary">Edit</button>
                </td>
                <td> <button onclick="DeleteUser('.$row['id'].')"
                class="btn btn-danger">Delete</button>
                </td>



		</tr>	';
		$number++;
		}
	}
	$data.='</table>';
	echo $data;
   
}


//if(isset($_POST['collegename']) && ($_POST['city']) && ($_POST['state']) && ($_POST['phoneno']))


if(isset($_POST['sname']))
      {
         
        // echo '<script type="text/javascript">alert("Sign|button clicked")</script>';
       
       
        $sname=$_POST['sname'];
         $mobileno=$_POST['mobileno'];
        $email=$_POST['email'];
        $department=$_POST['department'];
       
       
    }


	//$_SESSION['message']= "record has been saved";
	//$_SESSION['msg_type']= "success";
	//header("location:index1.php");
	
  if(isset($_POST['sname']) && ($_POST['mobileno']) && ($_POST['email']) && ($_POST['department']))

        { 
           $query="select * from staff where email='$email'";
           $query_run = mysqli_query($conn,$query);
           if(mysqli_num_rows($query_run)> 0 )
           {
             //there is l=already a user with the same username
             echo '<script type="text/javascript">alert("email already exists..try another email")</script>';


           }
           else
           {
           	$query="insert into staff values('','$sname','$mobileno','$email','$department')";
            
	           mysqli_query($conn, $query);

             if($query_run)
             {
                
                 
                header("location:ind2.php");
             }
             else
             {
                 echo '<script type="text/javascript">alert("Error!")</script>';
             }




           }

        }
     
	
	


//delete user record
if (isset($_POST['deleteid'])) {
	$userid=$_POST['deleteid'];
	$deletequery = "delete from staff where id='$userid' ";
	mysqli_query($conn,$deletequery);
}
// get user datail
if (isset($_POST['id']) && isset($_POST['id']) != "") {
	$user_id = $_POST['id'];
	$query = "SELECT * FROM  staff WHERE id = '$user_id'";
	if (!$result = mysqli_query($conn,$query)) {
		exit(mysqli_error());

	$_SESSION['message']= "record has been deleted";
	$_SESSION['msg_type']= "danger";
	header("location:ind2.php");
	}
	$response = array();
	if (mysqli_num_rows($result) > 0) {
		while ($row =mysqli_fetch_assoc($result)){
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
///update table
if (isset($_POST['hidden_user_idupd'])) {
	$hidden_user_idupd = $_POST['hidden_user_idupd'];
	$snameupd = $_POST['snameupd'];
	$mobilenoupd = $_POST['mobilenoupd'];
	$emailupd = $_POST['emailupd'];
	$departmentupd = $_POST['departmentupd'];
	$query = " UPDATE `staff` SET `sname`='$snameupd',`mobileno`= '$mobilenoupd',`email`='$emailupd',`department`='$departmentupd' WHERE  id ='$hidden_user_idupd'";
	mysqli_query($conn, $query);
}
//search
if(isset($_POST['query'])){
	$search=$_POST['query'];
    $output='';
$ids = $_SESSION['ids'];
 	$output = '<table class =" table table-bordered table-striped">
 	<div class="table-reponsive">
 	 <tr>
   <th>No.</th>
    <th>Name of Staff</th>
    <th>Mobile Number</th>
    <th>Email Id</th>
    <th>Department Name</th>
    
    <th>Edit</th>
    <th>Delete</th>

   
    

	</tr>';
    $sql="SELECT * FROM staff WHERE (sname LIKE '%$search%'  OR mobileno LIKE '%$search%') AND ids=$ids";
 $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
   
 if (mysqli_num_rows($result)>0) {
      $number=1;
	while ($row = mysqli_fetch_array($result)) {
		
		$output .='<tr>
               <td>'.$number.'</td>
               <td>'.$row['sname'].'</td>
                <td>'.$row['mobileno'].'</td>
                <td>'.$row['email'].'</td>
                <td>'.$row['department'].'</td>
                
                <td> <button onclick="GetUserDetails('.$row['id'].')"
                class="btn btn-primary">Edit</button>
                </td>
                <td> <button onclick="DeleteUser('.$row['id'].')"
                class="btn btn-danger">Delete</button>
                </td>



		</tr>	';
		$number++;
	}
}
	$output.='</table>';
	echo $output;
 }
 //

 if(isset($_POST['searchi'])){
    $id = $_POST['searchi'];
    $ids = $_SESSION['ids'];
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
    if($id == null)
    {
        $query="SELECT * FROM `staff` WHERE ids=$ids";
    }
    else{
    $query = "SELECT * FROM `staff` WHERE ( sname = '$id' or mobileno = '$id' or email = '$id' or department = '$id' ) AND ids=$ids  "; 
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
                
               
                <td> <button onclick="GetUserDetails('.$row['id'].')"
                class="btn btn-primary">Edit</button>
                </td>
                <td> <button onclick="DeleteUser('.$row['id'].')"
                class="btn btn-danger">Delete</button>
                </td>



        </tr>   ';
        $number++;
        }
    }
    $data.='</table>';
    echo $data;

}


?>