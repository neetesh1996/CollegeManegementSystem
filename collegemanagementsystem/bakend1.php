<?php
session_start();
$conn = mysqli_connect('localhost', 'root', "",'collegemanagementsystem1');

extract($_POST);
if(isset($_POST['readrecord'])){
    $id1 = $_SESSION['id1'];
	$data = '<table class =" table table-bordered table-striped">
    <tr>
    <th>No.</th>
    <th>College Name</th>
    <th>City</th>
    <th>State</th>
    <th>Phone Number</th>
    <th>View</th>
    <th>Edit</th>
    <th>Delete</th>

	</tr>';
	$displayquery = "SELECT * FROM `colleges` where id1=$id1 ";
	$result = mysqli_query($conn,$displayquery);

	if (mysqli_num_rows($result) > 0) {
		
		$number=1;
		while ($row = mysqli_fetch_array($result)) {
			$data .='<tr>
               <td>'.$number.'</td>
               <td>'.$row['collegename'].'</td>
                <td>'.$row['city'].'</td>
                <td>'.$row['state'].'</td>
                <td>'.$row['phoneno'].'</td>
                <td> <button class="btn btn-success"><a href="ind2.php?ids='.$row['ids'].'">View</a></button>
                </td>
                <td> <button onclick="GetUserDetails('.$row['ids'].')"
                class="btn btn-primary">Edit</button>
                </td>
                <td> <button onclick="DeleteUser('.$row['ids'].')"
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
	
  if(isset($_POST['collegename']) && ($_POST['city']) && ($_POST['state']) && ($_POST['phoneno']))
        {
           $query="select * from colleges where phoneno='$phoneno'";
           $query_run = mysqli_query($conn,$query);
           if(mysqli_num_rows($query_run)> 0 )
           {
             //there is l=already a user with the same username
             echo '<script type="text/javascript">alert("email already exists..try another email")</script>';

           }
           else
           {
           	$query="insert into colleges values('','$collegename','$city','$state','$phoneno')";
            
	           mysqli_query($conn, $query);

             if($query_run)
             {
                
                 
                header("location:index1.php");
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
	$deletequery = "delete from colleges where ids='$userid'";
	mysqli_query($conn,$deletequery);
}
// get user datail
if (isset($_POST['ids']) && isset($_POST['ids']) != "") {
	$user_id = $_POST['ids'];
	$query = "SELECT * FROM colleges WHERE ids = '$user_id'";
	if (!$result = mysqli_query($conn,$query)) {
		exit(mysqli_error());

	$_SESSION['message']= "record has been deleted";
	$_SESSION['msg_type']= "danger";
	header("location:index1.php");
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
	$collegenameupd = $_POST['collegenameupd'];
	$cityupd = $_POST['cityupd'];
	$stateupd = $_POST['stateupd'];
	$phonenoupd = $_POST['phonenoupd'];
	$query = " UPDATE `colleges` SET `collegename`='$collegenameupd',`city`= '$cityupd',`state`='$stateupd',`phoneno`='$phonenoupd' WHERE  ids ='$hidden_user_idupd'";
	mysqli_query($conn, $query);
}
//search
if(isset($_POST['query'])){
	$search=$_POST['query'];
    $output='';
$id1 = $_SESSION['id1'];
 	$output = '<table class =" table table-bordered table-striped">
 	<div class="table-reponsive">
 	 <tr>
    <th>No.</th>
    <th>College Name</th>
    <th>City</th>
    <th>State</th>
    <th>Phone Number</th>
    <th>View</th>
    <th>Edit</th>
    <th>Delete</th>

	</tr>';
    $sql="SELECT * FROM colleges WHERE (collegename LIKE '%$search%') AND id1=$id1 " ;
 $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
   
 if (mysqli_num_rows($result)>0) {
     $number=1;
	while ($row = mysqli_fetch_array($result)) {
		
		$output .='<tr>
               <td>'.$number.'</td>
               <td>'.$row['collegename'].'</td>
                <td>'.$row['city'].'</td>
                <td>'.$row['state'].'</td>
                <td>'.$row['phoneno'].'</td>
                <td>  <button class="btn btn-success"><a href="ind2.php?ids='.$row['ids'].'">View</a></button>
                <td> <button onclick="GetUserDetails('.$row['ids'].')"
                class="btn btn-primary">Edit</button>
                </td>
                <td> <button onclick="DeleteUser('.$row['ids'].')"
                class="btn btn-danger">Delete</button>
                </td>



		</tr>	';
		$number++;
	}
}
	$output.='</table>';
	echo $output;
 }

 /*
if(isset($_POST['searching'])){
	$id = $_POST['searching'];
	$data = '<table class =" table table-bordered table-striped">
    <tr>
    <th>No.</th>
    <th>College Name</th>
    <th>City</th>
    <th>State</th>
    <th>Phone Number</th>
    <th>View</th>
    <th>Edit</th>
    <th>Delete</th>

	</tr>';
	if($id == null)
	{
		$query="SELECT * FROM `colleges`";
	}
	else{
	$query = "SELECT * FROM `colleges` WHERE collegename = '$id' or city = '$id' or state = '$id' or phoneno = '$id'  "; 
         }
	$result = mysqli_query($conn, $query) or die(mysqli_error($conn));

	if (mysqli_num_rows($result) > 0) {
		
		$number=1;
		while ($row = mysqli_fetch_array($result)) {
			$data .='<tr>
               <td>'.$number.'</td>
               <td>'.$row['collegename'].'</td>
                <td>'.$row['city'].'</td>
                <td>'.$row['state'].'</td>
                <td>'.$row['phoneno'].'</td>
                <td> <button onclick="('.$row['id'].')"
                class="btn btn-success">View</button>
                </td>
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

}*/
?>