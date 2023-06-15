<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   
    <title>Student Create</title>
</head>
<body>
  
    <div class="container mt-5">
<div class="d-flex justify-content-end">
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  ADD USER
</button>

</div>

<h2>ALL RECORDS</h2>
<div class="records_content">

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">

<div class="mb-3">
    <label>Student Name</label>
    <input type="text" name="name" id="name" class="form-control">
</div>
<div class="mb-3">
    <label>Student Email</label>
    <input type="email" name="email" id="email" class="form-control">
</div>
<div class="mb-3">
    <label>Student Phone</label>
    <input type="text" name="phone" id="phone" class="form-control">
</div>
<div class="mb-3">
    <label>Student Course</label>
    <input type="text" name="course" id="course" class="form-control">
</div>


</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="AddUser()">Save</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">close</button>
      </div>

    </div>
  </div>
</div>



<div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">

<div class="mb-3">
    <label>Student Name</label>
    <input type="text" name="name" id="upname" class="form-control">
</div>
<div class="mb-3">
    <label>Student Email</label>
    <input type="email" name="email" id="upemail" class="form-control">
</div>
<div class="mb-3">
    <label>Student Phone</label>
    <input type="text" name="phone" id="upphone" class="form-control">
</div>
<div class="mb-3">
    <label>Student Course</label>
    <input type="text" name="course" id="upcourse" class="form-control">
</div>


</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="Update()">update</button>
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">close</button>
        <input type="hidden" name="" id="hidden_user_id">
      </div>

    </div>
      
    </div>
</div>


    <script>
      $(document).ready(function(){
    displayData()
});
    // Display  the  insert  data
     function displayData(){
        var displaydata = "readrecord";
        $.ajax({
            url:"Backend.php",
            type:"POST",
            data:{
                displaySend:displaydata,
            },
            success:function(data,status){
$('.records_content').html(data);
            }
            
        });
      }
        function AddUser(){
            var firstname = $("#name").val();
            var email= $("#email").val();
            var phone = $("#phone").val();

            var course = $("#course").val();
            $.ajax({
                url:"Backend.php",
                type:"post",
                data: {firstname:firstname,
                email:email,
            phone:phone,
        course:course},
        success:function(data,status){
            // status  means success or not
            displayData();
            

        }
            });

        }

       function  DeleteUserDetails(id){
        var conf = confirm("Are you sure");
        // alert(conf);

        if(conf==true){
          $.ajax({
            type: "post",
            url: "Backend.php",
            data: {id:id},
            // dataType: "dataType",
            success: function (data,status) {
            displayData();
            }
          });

        }

       }

       function GetUserDetails(id){
        // alert(id);
        $("#hidden_user_id").val(id);
        $.post("Backend.php",{

          id:id},function(data,status){
            var user = JSON.parse(data);
            $('#upname'),val(user.name);
            $('#upemail'),val(user.email);
            $('#upphone'),val(user.phone);

            $('#upcourse'),val(user.course);


          }


        );
        $("#updateModal").modal("show");
       }

       function update()
       {
        var first = $("#upname").val();
        var email = $("#upemail").val();

        var phone = $("#upphone").val();

        var course = $("#upcourse").val();
        var hiddenData = $("#hidden_user_id").val();
        $.post("Backend.php",{
          first:first,
          email:email,
          phone:phone,
          course:course,
          hidden:hiddenData
   
 },function(data,status){
    $("#updateModal").modal("hide");
    displayData();

 }
 );


       }
    </script>

</body>
</html>
