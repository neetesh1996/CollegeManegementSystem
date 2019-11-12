<?php
session_start();
$msg='';
$conn = mysqli_connect('localhost', 'root', "",'collegemanagementsystem1');
if(isset($_GET['id1'])){
$id1 = $_GET['id1']; // Prevent injection
 $q = " SELECT * FROM users WHERE id1 = ". $id1 ." ";
$result = mysqli_query($conn, $q ) ;
if($row = mysqli_fetch_array($result))
{
 $error="Name: ";
  $error .=  $row["fullname"];
     
   $msg=$error;
 }
}else{
  header('location:login.php?reg=true');
}
$_SESSION['id1'] = $id1;

extract($_POST);
if(isset($_POST['readrecord'])){
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
  $displayquery = "SELECT * FROM `colleges` ";
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
                <td>  <a href="ind2.php?id=<?php echo '.$row['ids'].'; ?>"
                
                </td>
                <td> <button onclick="GetUserDetails('.$row['ids'].')"
                class="btn btn-primary">Edit</button>
                </td>
                <td> <button onclick="DeleteUser('.$row['ids'].')"
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
           $query="select * from colleges where phoneno='$phoneno' || collegename ='$collegename' ";
           $query_run = mysqli_query($conn,$query);
           if(mysqli_num_rows($query_run)> 0 )

            {
        // output data of each row
        $row = mysqli_fetch_assoc($query_run);
        if ($phoneno==$row['phoneno'])
        {
            $errorMsg=  "Error :  Phone Number already exists..try another";
               $code= "2"; 
            
        }
        elseif($collegename==$row['collegename'])
        {
            $errorMsg=  "Error : College Name  already exists..try another";
               $code= "2"; 
            
        }
        
          


           }
           
           else
           {
            $query= " INSERT`colleges` SET `id1`=$id1,`collegename`='$collegename',`city`= '$city',`state`        ='$state',`phoneno`='$phoneno' ";
            
             mysqli_query($conn, $query);

             if($query_run)
             {
               $errorMs=  "Success : College Details Added Successfully ...";
               $code= "3";
                
                echo "<meta http-equiv='refresh' content='4'>";
 
               
             }
             else
             {
                 echo '<script type="text/javascript">alert("Error!")</script>';
             }




           }

        }

        if (isset($_POST['update_collegename'])) {
  $hidden_user_id = $_POST['hidden_user_id'];
  $update_collegename = $_POST['update_collegename'];
  $update_city = $_POST['update_city'];
  $update_state = $_POST['update_state'];
  $update_phoneno = $_POST['update_phoneno'];
}
 if(isset($_POST['update_collegename']) && ($_POST['update_city']) && ($_POST['update_state']) && ($_POST['update_phoneno'])){
  
  $query = " UPDATE `colleges` SET `collegename`='$update_collegename',`city`= '$update_city',`state`='$update_state',`phoneno`='$update_phoneno' WHERE  ids ='$hidden_user_id'";
  $query1=mysqli_query($conn, $query);
        

               $errorMs=  "Success : College Details Updated Successfully ...";

               $code= "4";
                echo "<meta http-equiv='refresh' content='4'>";     
} 

   
  ?>

<!DOCTYPE html>
<html>
<head>
  <title>college list</title>
  
  



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
 
 .parsley-type, .parsley-required, .parsley-equalto{
  color:#ff0000;
 }
 </style>
 <style type="text/css" >
  .errorMsg{border:1px solid green; }
  .message{color: brown; font-weight:bold; }
  .errorMs{border:1px solid green; }
  .messag{color: green; font-weight:bold; }
  .error{border:1px solid green; }
  .messa{color: green; font-size: 30px; margin-top:-50px
 </style>
</head>

<body>


  <div class="container-fluid">
    <h1 class=" text-primary text-center "  >College Management System</h1>
     <?php if (isset($msg)) { echo "<p class='messa'>" .$msg. "</p>" ;} ?>
    <span align="center"  style="margin-top:-100px;" ><?php if (isset($errorMsg)) { echo "<p class='message'>" .$errorMsg. "</p>" ;} ?></span>
    <span align="center"  style="margin-top:0px;" ><?php if (isset($errorMs)) { echo "<p class='messag'>" .$errorMs. "</p>" ;} ?></span>
     <form style=""class="myfo" action="login.php?registere=true" method="post">
    
    <button  style="margin-top: -50px; float:right;" name="logout" type="submit" id="logout_btn" class= "btn btn-danger btn-md"><span class="glyphicon glyphicon-log-out"></span>Logout</button>
    
</form>
    <div class="d-flex justify-content-end">

      <button style="margin-top: 25px; float: right;" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal">Add College

</button>
      
    </div>
    
    <div style="margin-top: -50px;" class="col-sm-6">
      
       <span style= "margin-top:0px;font-size: 25px;" class="input-group-addon">SEARCH:</span>
        <input  style="height: 30px; border-radius:5px;"
   type="text" name="search" id="search_text" placeholder="College Name" >
       <!--<button  style= "margin-top: -8px"type="Submit" name="Submit" class="btn btn-success btn-md" onclick="searchData()">Search</button> -->
     <div id="result"></div>
    </div>
    
    <h2 style="color:gray; margin-left: 12px;">College List</h2>
    <div id="recods_contant">
      </div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      
      <div class="modal-header">
        <h4 class="modal-title">Add College</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
     
        <form id="validate_form1" method="post" action="" data-parsley-validate >
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label>College Name</label>
          <input type="text" name="collegename" id="collegename"  class="form-control" placeholder="Enter College Name" required data-parsley-pattern="^[a-zA-Z0-9-&+,='.`()-/\ ]*$" data-parsley-trigger="keyup"  value= "<?php if(isset($_POST["collegename"])) echo $_POST["collegename"]; ?>" >
          <span name="collegename1" id="lbname"></span>
        </div>
         <div class="form-group">
          <label>City</label>
          <input type="text" name="city" id="city" class="form-control" placeholder="Enter City" required data-parsley-pattern="^[a-zA-Z0-9-&+,='.`()-/\ ]*$" data-parsley-trigger="keyup"  value= "<?php if(isset($_POST["city"])) echo $_POST["city"]; ?>">
           <span name="city1" id="lbcity"></span>
        </div>
         <div class="form-group">
          <label>State</label>
          <input type="text" name="state" id="state" class="form-control" placeholder="Enter State" required data-parsley-pattern="^[a-zA-Z0-9-&+,='.`()-/\ ]*$" data-parsley-trigger="keyup"  value= "<?php if(isset($_POST["state"])) echo $_POST["state"]; ?>">
           <span name="state1" id="lbstate"></span>
        </div>
         <div class="form-group">
          <label>Phone Number</label>
          <input type="text" name="phoneno" id="phoneno" class="form-control" placeholder="Enter Phone Number" data-parsley-length="[10, 10]" data-parsley-trigger="keyup" required data-parsley-pattern="^[0-9 ]{10}$" autocomplete="off"  value= "<?php if(isset($_POST["phoneno"])) echo $_POST["phoneno"]; ?>" >  
            
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary"   onsubmit ="addRecord()">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        

        </form>
      </div>
    </div>
  </div>

<span<?php if(isset($code) && $code == 2){echo "class=errorMsg" ;}?> ></span>
        <span<?php if(isset($code) && $code == 3){echo "class=errorMs" ;}?> ></span>
        
<!-- // update model-->

<!-- The Modal -->

<div class="modal" id="update_user_modal" >

  <div class="modal-dialog">
    <div class="modal-content">
    <form id="validate_form4"  method="post" action="" data-parsley-validate >
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update college Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
          <label for="update_collegename">College Name</label>
          <input type="text" name="update_collegename" id="update_collegename" class="form-control" placeholder="Update College Name"  required data-parsley-pattern="^[a-zA-Z0-9-&+,='.`()-/\ ]*$" data-parsley-trigger="keyup">
         
         <div class="form-group">
          <label for="update_city">City</label>
         
          <input type="text" name="update_city" id="update_city" class="form-control" placeholder="Update City" required data-parsley-pattern="^[a-zA-Z0-9-&+,='.`()-/\ ]*$" data-parsley-trigger="keyup" >
          
        </div>
         <div class="form-group">
          <label for="update_state">State</label>
         
          <input type="text" name="update_state" id="update_state" class="form-control" placeholder="Update State" required data-parsley-pattern="^[a-zA-Z0-9-&+,='.`()-/\ ]*$" data-parsley-trigger="keyup" >
         
        </div>
         <div class="form-group">
          <label for="update_phoneno">Phone Number</label>
         
          <input type="text" name="update_phoneno" id="update_phoneno" class="form-control" placeholder=" Update phone Number" required data-parsley-length="[10, 10]" data-parsley-trigger="keyup" data-parsley-pattern="^[0-9 ]{10}$" autocomplete="off">
          
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" id="submit1" onsubmit="updateuserdetai()">Submit</button>
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
             url:"bakend1.php",
            type:"post",
            data: { readrecord: readrecord},
            success: function(data,status){
              $('#recods_contant').html(data);
            }
          });
        }
        function addRecord() {
          event.preventDefault();
          var collegename =$('#collegename').val();
          var city = $('#city').val();
          var state = $('#state').val();
          var phoneno = $('#phoneno').val();
          // event.preventDefault();
         //alertify.confirm("Are you Sure to Add records?",function(e){
         // if (e) {
          $.ajax({
            url:"bakend1.php",
            type:"post",
            data:  {
            collegename : collegename,
            city : city,
            state : state,
            phoneno : phoneno
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
             url:"bakend1.php",
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
        function GetUserDetails(ids){
          $('#hidden_user_id').val(ids);
          $.post("bakend1.php", {
            ids:ids

          },
          function(data,status){
            var user = JSON.parse(data);
            $('#update_collegename').val(user.collegename);
            $('#update_city').val(user.city);
            $('#update_state').val(user.state);
            $('#update_phoneno').val(user.phoneno);
          }
          );
          $('#update_user_modal').modal('show');
        }
        function updateuserdetail() {
           var hidden_user_idupd =$('#hidden_user_id').val();
          var collegenameupd = $('#update_collegename').val();
           var cityupd = $('#update_city').val();
            var stateupd = $('#update_state').val();
             var phonenoupd = $('#update_phoneno').val();
              event.preventDefault();
         alertify.confirm("Are you Sure to update records?",function(e){
          if (e) {
            
             $.post("bakend1.php", {

              hidden_user_idupd : hidden_user_idupd,
              collegenameupd : collegenameupd,
              cityupd : cityupd,
              stateupd : stateupd,
             phonenoupd : phonenoupd,

             },
             function(data,status){
              $('#update_user_modal').modal('hide');
              readRecord();
               alertify.success("<h6> data updated");
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
             url:"bak2.php?id='.$row['ids'].'",
            type:"post",
            data: { record: record},
            success: function(data,status){
             window.location="ind2.php?id='.$row['ids'].'";
             readRecord();
            }
          });
        }
        
        // search
          $(document).ready(function(){
            $('#search_text').keyup(function(){
              var search = $(this).val();
               $.ajax({
                url:"bakend1.php",
                method:"post",
                data:{query:search},
                success:function(data)
                {
                  $('#recods_contant').html(data);
                }
               });
              });
            });

          
          

        
// validation
    
      </script>
    <!--  <script>  
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
</script>-->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>


</html>