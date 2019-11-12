<?php
session_start();

?>
<!DOCTYPE html>
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
 option.parsley-success,
 textarea.parsley-success {
   color: #468847;
   background-color: #DFF0D8;
   border: 1px solid #D6E9C6;
 }

 input.parsley-error,
 option.parsley-error,
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
</head>
<body>
   <div class="container-fluid">
      <h1 class=" text-primary text-center "  >College Management System</h1>
      <form "class="myfo" action="login.php" method="post" >
    
   <button  style="margin-top: -40px; float:right;" name="logout" type="submit" id="logout_btn" class= "btn btn-danger glyphicon glyphicon-log-out"> <span class="glyphicon glyphicon-log-out"></span>Logout</button>
 </form>
 <form action="index1.php" method="post">
    <button  style="margin-top: -40px;float:left;" name="logout" type="submit" id="logout_btn" class= "btn btn-info">Back</button>
</form>
<?php  
if (isset($_POST['logout'])) 
{ 
session_destroy();
header('location:login.php');
}
?>
      <div class="d-flex justify-content-end">
         <button style="margin-top: 20px; float: right;" type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal1">Add Staff

</button>
         
      </div>
    
    <div style="margin-top: -40px;" class="col-sm-6">
      
          
    <select style="font-size: 22px; border-radius:3px;
  " type="text" name="ids" id="search_texts" >
        <option value="" >Select Department</option>
          <option value="CSE">CSE</option>
           <option value="CIVIL">CIVIL</option>
            <option value="Mechanical">MECHANICAL</option>
             <option value="Electrical">ELECTRICAL</option>
      </select>
       

        
       <button  style= "margin-top: -8px; margin-left: 0px;"type="Submit" name="Submit" class="btn btn-success btn-md" onclick="searchDat()">Search</button>
     
    </div>
    
      <h2 style="color:gray; margin-left: 12px;">Staff</h2>
      <div id="recod_contant">
      </div>

<!-- The Modal  add collge-->
<div class="modal fade" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      
      <div class="modal-header">
        <h4 class="modal-title">Add Staff</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
        <form id="validate_form2">
      <!-- Modal body -->
      <div class="modal-body">
        <div class="form-group">
         <label>Name:</label>
         <input type="text" name="sname" id="sname"  class="form-control" placeholder="Enter Name" required data-parsley-pattern="^[a-zA-Z ]*$" data-parsley-trigger="keyup" >
          <span class="error_form" id="fname_error_message"></span>
        </div>
         <div class="form-group">
         <label>Mobile No:</label>
         <input type="number" name="mobileno" id="mobileno" class="form-control" placeholder="Enter Mobile No" required data-parsley-length="[10, 10]" data-parsley-trigger="keyup" data-parsley-pattern="^[0-9 ]{10}$" autocomplete="off">
           <span class="error_form" id="sname_error_message"></span>
        </div>
         <div class="form-group">
         <label>Email:</label>
         <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" required data-parsley-type="email" data-parsley-trigger="keyup" >
           <span class="error_form" id="state_error_message"></span>
        </div>
         <div class="form-group">
          <label>DEPARTMENT:</label><br>
      <select  style="font-size:20px; width:100%; border-radius:5px; font-color:red; " name="department"id="department" required data-parsley-trigger="keyup" >
        <option style=""  required value="" >Select Department </option>
          <option value="CSE">CSE</option>
           <option value="CIVIL">CIVIL</option>
            <option value="Mechanical">MECHANICAL</option>
             <option value="Electrical">ELECTRICAL</option>
      </select><br/>
         
       
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
         <button type="submit" id="submit" name="submit" value="Submit" class="btn btn-primary"  data-dismiss="modal" onclick="addRecords()">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </form>
      </div>
</div>
    </div>
  </div>
 </div>

<!-- // update model-->

<!-- The Modal -->

<div class="modal" id="update_user_modal1" >

  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Staff Detail</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
 <!-- Modal body -->
      <div class="modal-body">
        <form id="validate_form3">
        <div class="form-group">
          <label for="update_sname">Name:</label>
          <input type="text" name="sname" id="update_sname" class="form-control" placeholder="Update Name" required data-parsley-pattern="^[a-zA-Z ]*$" data-parsley-trigger="keyup">
         <!-- <span name="sname1" id="form_fname"></span> -->
        </div>
         <div class="form-group">
          <label for="update_mobileno">Mobile No:</label>
          <input type="number" name="mobileno" id="update_mobileno" class="form-control" placeholder="Update Mobile No" required data-parsley-length="[10, 10]" data-parsley-trigger="keyup" data-parsley-pattern="^[0-9 ]{10}$" autocomplete="off">
          <!-- <span name="mobileno1" id="mobileno"></span> -->
        </div>
         <div class="form-group">
          <label for="update_email">Email:</label>
          <input type="text" name="email" id="update_email" class="form-control" placeholder="Update Email" required data-parsley-type="email" data-parsley-trigger="keyup">
           <!--<span name="email1" id="form_email"></span>-->
        </div>
         <div class="form-group">
           <label for="update_department">DEPARTMENT:</label>
      <select  style="font-size:15px;" <input  name="department" id="update_department" class="form-control" required data-parsley-trigger="keyup" >
        <option   required value="">Select Department </option>
          <option value="CSE">CSE</option>
           <option value="CIVIL">CIVIL</option>
            <option value="Mechanical">MECHANICAL</option>
             <option value="Electrical">ELECTRICAL</option>
      </select><br/>
       <!--<span name="departmen1" id="form_department"></span> -->
         </div> 
      

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button"  name="submit2" id="submit2" class="btn btn-primary" data-dismiss="modal" onclick="updatestaffdetail()">Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_id">
      </div>
    </form>
  </div>
</div>
    </div>
  
</div>
   


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
     </script>

     <!-- javascerip -->
      
      <script src="http://parsleyjs.org/dist/parsley.js"></script>
      <!-- value read function -->
     
      <script type="text/javascript">
        $(document).ready(function(){
          readRecords();
        });
        function readRecords() {
          var readrecords = "readRecords";
          $.ajax({
             url:"bakend2.php",
            type:"post",
            data: { readrecords: readrecords},
            success: function(data,status){
              $('#recod_contant').html(data);
            }
          });
        }
        /* add college list  */
        function addRecords() {
          event.preventDefault();
          var sname =$('#sname').val();
          var mobileno = $('#mobileno').val();
          var email= $('#email').val();
          var department = $('#department').val();
          event.preventDefault();
         alertify.confirm("Are you Sure to Add records?",function(e){
          if (e) {
          $.ajax({
            url:"bakend2.php",
            type:"post",
            data:  {
            sname : sname,
           mobileno: mobileno,
            email: email,
           department: department
           },
          success:function(data,status) {
            readRecords();
            
          }

          });
        }
         }, function(){
          alertify.error("<h5> Data not added </h5>");
          });
        }
        // delete records
        function DeleteStaff(deletids) {
          event.preventDefault();
         alertify.confirm("Are you Sure to Delete records?",function(e){
          if (e) {
            $.ajax({
             url:"bakend2.php",
            type:"post",
            data : { deletids:deletids},
            success:function(data,status){
              readRecords();
              alertify.success("<h6> data Deleted");
              return true;
            }

            });
          }
        }, function(){
          alertify.error("<h5> Not Deleted</h5>");
          });
        }
        
        
     /*   // update user
       function GetstaffDetails(ids){
          $('#hidden_user_id1').val(ids);
          $.post("bakend2.php", {
            ids:ids

          },
          function(data,status){
            var user = JSON.parse(data);
            $('#update_sname').val(user.sname);
            $('#update_mobileno').val(user.mobileno);
            $('#update_email').val(user.email);
            $('#update_department').val(user.department);
          }
          );
          $('#update_user_modal1').modal('show');
        } */
         //
       





        function GetstaffDetails(ids){
          $('#hidden_id').val(ids);
          $.post("bakend2.php", {
            ids:ids

          },
          function(data,status){
            var user = JSON.parse(data);
            $('#update_sname').val(user.sname);
            $('#update_mobileno').val(user.mobileno);
            $('#update_email').val(user.email);
            $('#update_department').val(user.department);
          }
          );
          $('#update_user_modal1').modal("show");
        } 
        //
       
        function updatestaffdetail() {
          event.preventDefault();
           var hidden_idupd =$('#hidden_id').val();
          var snameupd = $('#update_sname').val();
           var mobilenoupd = $('#update_mobileno').val();
            var emailupd = $('#update_email').val();
             var departmentupd = $('#update_department').val();
              event.preventDefault();
         alertify.confirm("Are you Sure to update records?",function(e){
          if (e) {
            
             $.post("bakend2.php", {

              hidden_idupd : hidden_idupd,
              snameupd : snameupd,
             mobilenoupd : mobilenoupd,
               emailupd :  emailupd,
              departmentupd : departmentupd

             },
             function(data,status){
              $('#update_user_modal1').modal('hide');
              readRecords();
               alertify.success("<h6> data updated");
              return true;
             }

              );
        }
        }, function(){
          alertify.error("<h5> Data not updated </h5>");
          });
        } 
        //
        /*  function updatestaffdetail() {
           var hidden_user_idupd1 =$('#hidden_user_id1').val();
          var snameupd = $('#update_sname').val();
           var mobilenoupd = $('#update_mobileno').val();
            var emailupd = $('#update_email').val();
             var departmentupd = $('#update_department').val();
              event.preventDefault();
         alertify.confirm("Are you Sure to update records?",function(e){
          if (e) {
            
             $.post("bakend2.php", {

              hidden_user_idupd1 : hidden_user_idupd1,
              snameupd : snameupd,
             mobilenoupd : mobilenoupd,
             emailupd : emailupd,
            departmentupd : departmentupd,

             },
             function(data,status){
              $('#update_user_modal1').modal('hide');
              readRecords();
               alertify.success("<h6> data updated");
              return true;
             }

              );
        }
        }, function(){
          alertify.error("<h5> Data not updated </h5>");
          });
        } */
        //
          /* search  college by name   */
        function searchDat() {
          var searchi = $('#search_texts').val();
         $.post("bakend2.php",
         {
         searchi:searchi
         },
          function(data,status) {
           $('#recod_contant').html(data);
          }
          );
          }
        
          /* add go inside college records staff table  */
         function GetstaffId(soid) {
          var record = "soid";
          $.ajax({
             url:"bakend2.php",
            type:"post",
            data: { record: record},
            success: function(data,status){
             window.location="index2.php";
             readRecords();
            }
          });
        }
// reload values if form not submitted

/*
 window.onload = function() {

        // If sessionStorage is storing default values (ex. name), exit the function and do not restore data
        if (sessionStorage.getItem('sname1') == "sname1") {
            return;
        }

        // If values are not blank, restore them to the fields
        var sname = sessionStorage.getItem('sname1');
        if (sname1 !== null) $('#form_fname').val(sname1);

        var email1 = sessionStorage.getItem('email1');
        if (email !== null) $('#form_email').val(email1);

        var mobileno1= sessionStorage.getItem('mobileno1');
        if (mobileno1!== null) $('#form_mobileno').val(mobileno1);

        vardepartment1= sessionStorage.getItem('department1');
        if (department1!== null) $('#form_department').val(department1);

       
    }

    // Before refreshing the page, save the form data to sessionStorage
    window.onbeforeunload = function() {
        sessionStorage.setItem("sname1", $('#form_sname').val());
        sessionStorage.setItem("email1", $('#form_email').val());
        sessionStorage.setItem("mobileno1", $('#form_mobileno').val());
        sessionStorage.setItem("department1", $('#form_department').val());
       
       
    } */
    
      </script>

      <script>  
         /* parsleyjs for  add modal validation */
$(document).ready(function(){  
    $('#validate_form2').parsley();
 
 $('#validate_form2').on('submit', function(event){
  event.preventDefault();
  if($('#validate_form2').parsley().isValid())
  {
   $.ajax({
    url:"addstaff.php",
    method:"POST",
    data:$(this).serialize(),
    beforeSend:function(){
     $('#submit1').attr('disabled','disabled');
     $('#submit1').val('Submitting...');
    },
    success:function(data)
    {
     $('#validate_form2')[0].reset();
     $('#validate_form2').parsley().reset();
     $('#submit').attr('disabled',false);
     $('#submit').val('Submit');
     alert(data);
    }
   });
  }
 });
});  
</script>
<script >
  /* parsleyjs for  update modal validation */
$(document).ready(function(){  
    $('#validate_form3').parsley();
 
 $('#validate_form3').on('submit2', function(event){
  event.preventDefault();
  if($('#validate_form3').parsley().isValid())
  {
   $.ajax({
    url:"addstaf.php",
    method:"POST",
    data:$(this).serialize(),
    beforeSend:function(){
     $('#submit2').attr('disabled','disabled');
     $('#submit2').val('Submitting...');
    },
    success:function(data)
    {
     $('#validate_form3')[0].reset();
     $('#validate_form3').parsley().reset();
     $('#submit2').attr('disabled',false);
     $('#submit2').val('Submit2');
     alert(data);
    }
   });
  }
 });
});  
</script>
</body>


</html>