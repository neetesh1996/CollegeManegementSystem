<?php
session_start();

$conn = mysqli_connect('localhost', 'root', "",'collegemanagementsystem1');
//

if(isset($_POST["name2check"]) && $_POST["name2check"] != ""){

$username = ($_POST['name2check']); 
$sql_uname_check = mysqli_query($conn, "SELECT sname FROM staff WHERE sname='$username' LIMIT 1"); 
$uname_check = mysqli_num_rows($sql_uname_check);
if ($uname_check < 1) {
echo '<strong style="color:green; text-transform:lowercase!important;">' . $username . ' is available </strong> ';
exit();
} else {
echo '<strong style="color:red; text-transform:lowercase!important;">' . $username . ' is taken </strong>';
exit();
}
}

//

extract($_POST);
if(isset($_POST['readrecord'])){
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
                
                <td> <button onclick="GetUserDetails('.$row['id'].')"
                class="btn btn-primary">Edit</button>
                </td>
                <td> <button onclick="DeleteUser('.$row['id'].')"
                class="btn btn-danger">Delete</button>
                </td>



    </tr> ';
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
           $query="select * from staff where email='$email' || mobileno='$mobileno'";
           $query_run = mysqli_query($conn,$query);
           if(mysqli_num_rows($query_run)> 0 )
           {
        // output data of each row
        $row = mysqli_fetch_assoc($query_run);
        if ($mobileno==$row['mobileno'])
        {
            $errorMsg=  "Error :  Mobile Number already exists..try another";
               $code= "2"; 
            
        }
        elseif($email==$row['email'])
        {
            $errorMsg=  "Error : Email  already exists..try another";
               $code= "2"; 
            
        }
        
          


           }
           else
           {
            $query="insert into staff values('','$sname','$mobileno','$email','$department')";
            
             mysqli_query($conn, $query);

             if($query_run)
             {
                $errorMs=  "Success : Staff Details Added Successfully .. ";
               $code= "3";
                 echo "<meta http-equiv='refresh' content='4'>";
                
             }
             else
             {
                 echo '<script type="text/javascript">alert("Error!")</script>';
             }




           }


        }
        if (isset($_POST['hidden_user_id'])) {
  $hidden_user_id = $_POST['hidden_user_id'];
  $update_sname = $_POST['update_sname'];
  $update_mobileno = $_POST['update_mobileno'];
  $update_email = $_POST['update_email'];
  $update_department = $_POST['update_department'];
  }
 if(isset($_POST['update_sname']) && ($_POST['update_mobileno']) && ($_POST['update_email']) && ($_POST['update_department'])){
      $selectquery ="SELECT * FROM staff WHERE email='$update_email'";
      $selectresult=mysqli_query($conn,$selectquery) or die("query fout " . mysqli_error() );
     if(mysqli_num_rows($selectresult)==1)
    { 
      $errorMsg=  "Error : Email  already exists..try another";
               $code= "2"; 
    }else{
 
  $query = " UPDATE `staff` SET `sname`='$update_sname',`mobileno`= '$update_mobileno',`email`='$update_email',`department`='$update_department' WHERE  id ='$hidden_user_id'";
  mysqli_query($conn, $query);
      
    
             
                $errorMs=  "Success : Staff Details Updated Successfully .. ";
               $code= "4";
                 echo "<meta http-equiv='refresh' content='2'>";
                 }
}

     
  ?>
  

<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title> Staff list</title>
	
  



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
 
 .parsley-type, .parsley-required, .parsley-equalto, .parsley-oninput{
  color:#ff0000;
 }
 </style>
 <style type="text/css" >
  .errorMsg{border:1px solid green; }
  .message{color: red; font-weight:bold; }
  .errorMs{border:1px solid green; }
  .messag{color: green; font-weight:bold; }
</style>
 <script> function checkusername(){ 
var status = document.getElementById("usernamestatus");
 var u = document.getElementById("update_sname").value;
 if(u != ""){ status.innerHTML = '<b style="color:red;">checking...</b>'; var hr = new XMLHttpRequest(); 
hr.open("POST", "ind2.php", true); 
 hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); hr.onreadystatechange = function() { 
if(hr.readyState == 4 && hr.status == 200) {
 status.innerHTML = hr.responseText; 
} }
var v = "name2check="+u; hr.send(v); } } 
</script>

</head>
<body>
<?php  
if (isset($_SESSION['message'])): 
?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">
<?php
echo $_SESSION['message'];

unset($_SESSION['message']);
?>
</div> 
<?php endif ?>
	<div class="container-fluid">
		<h1 class=" text-primary text-center "  >College Management System</h1>
    
     <form style=""class="myfo" action="login.php?registere=true" method="post">
    
    <button  style="margin-top: -40px; float:right;" name="logout" type="submit" id="logout_btn" class= "btn btn-danger btn-md"><span class="glyphicon glyphicon-log-out"></span>Logout</button>
    </form>
     <form action="index1.php" method="post">
    <button  style="margin-top: -40px;float:left;" name="logout" type="submit" id="logout_btn" class= "btn btn-info">Back</button>

    
</form>
 <span align="center" style="margin-top:0px;" ><?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?> </span>
 <span align="center"  style="margin-top:0px;" ><?php if (isset($errorMs)) { echo "<p class='messag'>" .$errorMs. "</p>" ;} ?></span>
		<div class="d-flex justify-content-end">

			<button style="margin-top: 40px; float: right;" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Add staff

</button>
			
		</div>

    <div style="margin-top: -5px;  margin-left:150px;" class="col-sm-6">
      
          
    <select style="font-size: 22px; border-radius:3px;
  " type="text" name="id" id="search_texts" >
        <option value="" >Select Department</option>
          <option value="CSE">CSE</option>
           <option value="CIVIL">CIVIL</option>
            <option value="Mechanical">MECHANICAL</option>
             <option value="Electrical">ELECTRICAL</option>
      </select>
       

        
       <button  style= "margin-top: -10px; margin-left: 0px;"type="Submit" name="Submit" class="btn btn-success btn-md" onclick="searchDat()">Search</button>
     
    </div>
    
    
    <div style="margin-top: -90px;" class="col-sm-6">
      
       <span style= "margin-top:0px;font-size: 30px;" class="input-group-addon">SEARCH:</span>
        <input  style="height: 35px; border-radius:5px;"
   type="text" name="search" id="search_text" placeholder="staff name" >
       <!--<button  style= "margin-top: -8px"type="Submit" name="Submit" class="btn btn-success btn-md" onclick="searchData()">Search</button> -->
     <div id="result"></div>
    </div>
     
		<h2 style="color:gray; margin-left: 12px;">Staff List</h2>
		<div id="recods_contant">
      </div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      
      <div class="modal-header">
        <h4 class="modal-title">Add Staff</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

 

        <form id="validate_form1" action=""  method="post"  data-parsley-validate >
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
        	<label> Name:</label>
        	<input type="text" name="sname" id="sname"  class="form-control" placeholder="Enter Name" required data-parsley-pattern="^[a-zA-Z ]*$" data-parsley-trigger="keyup"  value= "<?php if(isset($_POST["sname"])) echo $_POST["sname"]; ?>" >
          <span name="collegename1" id="lbname"></span>
        </div>
         <div class="form-group">
        	<label>Mobile Number:</label>
        	<input type="Number" name="mobileno" id="mobileno" class="form-control" placeholder="Enter Mobile Number" required  data-parsley-length="[10, 10]" data-parsley-pattern="^[0-9 ]{10}$" data-parsley-trigger="keyup" value= "<?php if(isset($_POST["mobileno"])) echo $_POST["mobileno"]; ?>">
           <span name="city1" id="lbcity"></span>
        </div>
         <div class="form-group">
        	<label>Email:</label>
        	<input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required data-parsley-type="email" data-parsley-trigger="keyup" value= "<?php if(isset($_POST["email"])) echo $_POST["email"]; ?>">
           <span name="state1" id="lbstate"></span>
        </div>
         <div class="form-group">
        	<label>Department:</label><br>
      <select  style="font-size:20px; width:100%; border-radius:5px; font-color:red; " name="department"id="department" required data-parsley-trigger="keyup" value= "<?php if(isset($_POST["department"])) echo $_POST["department"]; ?>" >
        <option style=""  required value="" >Select Department </option>
          <option value="CSE">CSE</option>
           <option value="CIVIL">CIVIL</option>
            <option value="Mechanical">MECHANICAL</option>
             <option value="Electrical">ELECTRICAL</option>
      </select><br/>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      	<button type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary"  onsubmit ="addRecord()">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      <span<?php if(isset($code) && $code == 2){echo "class=errorMsg" ;}?> ></span>
      <span<?php if(isset($code) && $code == 3){echo "class=errorMs" ;}?> ></span>
        </form>
      </div>
</div>
    </div>
    </div>

<!-- // update model-->

<!-- The Modal -->

<div class="modal" id="update_user_modal" >

  <div class="modal-dialog">
    <div class="modal-content">
    <form id="validate_form4" action=""  method="post"  data-parsley-validate >
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update staff Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="update_sname">Name:</label>
          <input type="text" name="update_sname" id="update_sname" oninput="checkusername()" class="form-control" placeholder="Update  Name"  required data-parsley-pattern="^[a-zA-Z ]*$" data-parsley-trigger="keyup">
           
        
       <span id="usernamestatus"></span>
         
         <div class="form-group">
          <label for="update_mobileno">Mobile Number:</label>
         
          <input type="Number" name="update_mobileno" id="update_mobileno" class="form-control" placeholder="Update Mobile Number" required  data-parsley-length="[10, 10]" data-parsley-pattern="^[0-9 ]{10}$" data-parsley-trigger="keyup" >
          
        </div>
         <div class="form-group">
          <label for="update_email">Email:</label>
         
          <input type="email" name="update_email" id="update_email" class="form-control" placeholder="Update Email" required data-parsley-type="email" data-parsley-trigger="keyup" />
         
        </div>
         <div class="form-group">
          <label for="update_department">Department:</label>
         
      <select  style="font-size:20px; width:100%; border-radius:5px; font-color:red; " name="update_department"id="update_department" required data-parsley-trigger="keyup" >
        <option style=""  required value="" >Select Department </option>
          <option value="CSE">CSE</option>
           <option value="CIVIL">CIVIL</option>
            <option value="Mechanical">MECHANICAL</option>
             <option value="Electrical">ELECTRICAL</option>
      </select><br/>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="" onsubmit ="updateuserdetail()">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="hidden_user_id" id="hidden_user_id">
      </div>
      </form>
</div>
    </div>
  
</div>

	


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
  	  </script>
      
      <script src="http://parsleyjs.org/dist/parsley.js"></script>
      
     
      <script type="text/javascript">
        $(document).ready(function(){
          readRecord();
        });
        function readRecord() {
          var readrecord = "readRecord";
          $.ajax({
             url:"bak2.php",
            type:"post",
            data: { readrecord: readrecord},
            success: function(data,status){
              $('#recods_contant').html(data);
            }
          });
        }
        function addRecord() {
          
          event.preventDefault();
          var sname =$('#sname').val();
          var mobileno = $('#mobileno').val();
          var email = $('#email').val();
          var department = $('#department').val();
          // event.preventDefault();
         //alertify.confirm("Are you Sure to Add records?",function(e){
         // if (e) {
          $.ajax({
            url:"bak2.php",
            type:"post",
            data:  {
            sname : sname,
            mobileno : mobileno,
            email : email,
            department: department
           },
          success:function(data,status) {
            readRecord();
            // alertify.success("<h6> data Added");
           //   return true;

          }

          });
        }
      
       // }, function(){
         // alertify.error("<h5> Data not added </h5>");
         // });
       // }
     // }
        // delete records
        function DeleteUser(deleteid) {
          event.preventDefault();
         alertify.confirm("Are you Sure to Delete records?",function(e){
 

          if (e) {
            $.ajax({
             url:"bak2.php",
            type:"post",
            data : { deleteid:deleteid},
            success:function(data,status){
              readRecord();
               alertify.success("<h6> data Deleted");
              return true;
            }

            });
          }
        }, function(){
          alertify.error("<h4> Not Deleted</h4>");
          });
        }
        
        
        // update user
        function GetUserDetails(id){
          $('#hidden_user_id').val(id);
          $.post("bak2.php", {
            id:id

          },
          function(data,status){
            var user = JSON.parse(data);
            $('#update_sname').val(user.sname);
            $('#update_mobileno').val(user.mobileno);
            $('#update_email').val(user.email);
            $('#update_department').val(user.department);
          }
          );
          $('#update_user_modal').modal('show');
        }
        function updateuserdetail() {
           var hidden_user_idupd =$('#hidden_user_id').val();
          var snameupd = $('#update_sname').val();
           var mobilenoupd = $('#update_mobileno').val();
            var emailupd = $('#update_email').val();
             var departmentupd = $('#update_department').val();
              event.preventDefault();
         alertify.confirm("Are you Sure to update records?",function(e){
          if (e) {
            
             $.post("bak2.php", {

              hidden_user_idupd : hidden_user_idupd,
              snameupd : snameupd,
              mobilenoupd : mobilenoupd,
              emailupd : emailupd,
             departmentupd : departmentupd,

             },
             function(data,status){
              $('#update_user_modal').modal('hide');
              readRecord();
               alertify.success("<h6> data updated </h6>");
              return true;
             }

              );
        }
        }, function(){
          alertify.error("<h5> Data not updated </h5>");
          });
        }
        
     /*   function searchData(){
          var searching =$('#search_text').val();
         $.post("bakend1.php",
         {
         searching:searching
         },
          function(data,status) {
           $('#recods_contant').html(data);
          }
          );
          }
        */
         
         function GetId(coid) {
          var record = "coid";
          $.ajax({
             url:"bakend2.php",
            type:"post",
            data: { record: record},
            success: function(data,status){
             window.location="index2.php";
             readRecord();
            }
          });
        }
        
        // search
          $(document).ready(function(){
            $('#search_text').keyup(function(){
              var search = $(this).val();
               $.ajax({
                url:"bak2.php",
                method:"post",
                data:{query:search},
                success:function(data)
                {
                  $('#recods_contant').html(data);
                }
               });
              });
            });

          
          function searchDat() {
          var searchi = $('#search_texts').val();
         $.post("bak2.php",
         {
         searchi:searchi
         },
          function(data,status) {
           $('#recods_contant').html(data);
          }
          );
          }

        
// validation
    
      </script>
<!--<script>  
$(document).ready(function(){  
    $('#validate_form1').parsley();
 
 $('#validate_form1').on('submit', function(event){
  event.preventDefault();
  if($('#validate_form1').parsley().isValid())
  {
   $.ajax({
    url:"addco.php",
    method:"POST",
    data:$(this).serialize(),
    beforeSend:function(){
     $('#submit').attr('disabled','disabled');
     $('#submit').val('Submitting...');
    },
    success:function(data)
    {
     $('#validate_form1')[0].reset();
     $('#validate_form1').parsley().reset();
     $('#submit').attr('disabled',false);
     $('#submit').val('Submit');
     alert("college added successfully");
    }
   });
  }
 });
});  
</script> 
 </script>
      <script>  
$(document).ready(function(){  
    $('#validate_form4').parsley();
 
 $('#validate_form4').on('submit', function(event){
  event.preventDefault();
  if($('#validate_form4').parsley().isValid())
  {
   $.ajax({
    url:"addcolle.php",
    method:"POST",
    data:$(this).serialize(),
    beforeSend:function(){
     $('#save').attr('disabled','disabled');
     $('#save').val('Submitting...');
    },
    success:function(data)
    {
     $('#validate_form4')[0].reset();
     $('#validate_form4').parsley().reset();
     $('#save').attr('disabled',false);
     $('#save').val('Submit');
     alert("college added successfully");
    }
   });
  }
 });
});  
</script> -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>


</html>