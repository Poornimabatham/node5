
<?php
include "Connection.php";
extract($_POST);
if(isset($_POST['displaySend'])){
    $data ='<table class="table table-bordered table-striped">
    <tr>
    <th>ID</th>
    <th>First Name</th>

    <th>Email</th>

    <th>Phone</th>
</tr> ';
$displayQuery = "SELECT * FROM `students` ";
$result = mysqli_query($con,$displayQuery);
if(mysqli_num_rows($result)>0){
    $num = 1;
    while($row=mysqli_fetch_assoc($result)){
        $data.='<tr>
        <td>'.$num.'</td>
        <td>'.$row['name'].'</td>

        <td>'.$row['email'].'</td>

        <td>'.$row['phone'].'</td>

        <td>
        <button onclick="GetUserDetails('.$row['id'].')"  class="btn btn-primary"> Edit</button>
        </td>
        <td>
        <button onclick="DeleteUserDetails('.$row['id'].')"  class="btn btn-danger"> Delete</button>
        </td>

        </tr>';
        $num++;
    
    }
    $data.='</table>';
echo $data;
}


}



?>






<?php

include 'Connection.php';
if(isset($_POST['id'])){
    $unique= $_POST['id'];
    // echo $unique;
    // exit;
    $sql = "DELETE FROM `students` WHERE id = $unique";
    // echo $sql;
    // exit;
    $result = mysqli_query($con,$sql);
    if($result){
        // echo 'Data has been sucessfully';
    }
    
}



?>






<?php


include "Connection.php";






if(isset($_POST['id'])){
    $user_id = $_POST['id'];
    $sql = "SELECT * FROM `students` WHERE id = $user_id";

    $result = mysqli_query($con,$sql);
    $response = array();
    while($row = mysqli_fetch_assoc($result)){
        $response = $row;
    }
    echo json_encode($response);

}
else{
    $response['status']=200;
    $response['message']="Invalid or data not found";
}






?>





















<?php

include "Connection.php";
extract($_POST);

if(isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['course']) )
{

$query = "INSERT INTO `students` (`name`,`email`,`phone`,`course`) VALUES ('$firstname','$email','$phone','$course')";
$query_run = mysqli_query($con, $query);

}
?>