<?php

$con = new mysqli("localhost","Rezwan","Rez1rez1","vue_crud");

if($con->connect_errno){
	die("<h1>Error Eshtabishing Database Connection! </h1>");
}

$response = [];
$response["error"] = false;
$action = "read";

if(isset($_GET["action"])){
	$action = $_GET["action"];
}

if($action == "read"){
   $users = [];
   $data = $con->query("SELECT * FROM users");
   while($result = $data->fetch_assoc()){
     array_push($users, $result);
   }
   $response["users"] = $users;
   if($data){
    $response["message"] = "Data Successfully Collected!";
   }
}


elseif($action == "create"){
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
	$create = $con->query("INSERT INTO `users` (`name`, `username`, `email`) VALUES ('$name','$username','$email')");
  if($create){
    $response["message"] = "Data Successfully inserted!";
  }else{
    $response["error"] = true;
    $response["message"] = "Something wents wrong!";
  }
}


elseif($action == "update"){
	$id = $_POST['id'];
  $name = $_POST['name'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $create = $con->query("UPDATE `users` SET `name`='$name',`username`='$username',`email`='$email' WHERE `id`= '$id'");
  if($create){
    $response["message"] = "Data Successfully Updted!";
  }else{
    $response["error"] = "Something wents wrong!";
  }
}


elseif($action == "delete"){
  $id = $_POST['id'];
  $create = $con->query("DELETE FROM `users` WHERE id='$id'");
  if($create){
    $response["message"] = "Data Successfully Deleted!";
  }else{
    $response["error"] = "Something wents wrong!";
  }
}
else{
  echo "<center><h1>Invalid Request!</h1></center>";
}

header("content-type:application/json");
echo json_encode( $response );

