<?php
include 'db.php';

if (isset($_SERVER['HTTP_ORIGIN'])) {
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Credentials: true');
  header('Access-Control-Max-Age: 1000');
};
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
      header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
  };
  if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
          header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding,
          X-CSRF-Token, Authorization");
  };
  exit(0);
}
$res = array("error" => false);
$action='';

if (isset($_GET['action'])) {
  $action=$_GET['action'];
};

// LOGIN
if($action == 'login') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "Select * from admin where username= '$username' AND password='$password'";
  $result = $conn -> query($sql);
  $num = mysqli_num_rows($result);
  if($num > 0){
    $res['message'] = "Login successfully";
  }
  else{
    $res['error'] = true;
    $res['message'] = "Username or Password is invalid";
  }
};

// ADD DATA
if($action == 'addData') {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $technique = $_POST['technique'];
  $gender = $_POST['gender'];

  $sql = "INSERT INTO `devdata`(`id`, `name`, `email`, `technique`, `gender`) VALUES(NULL, '$name', '$email', '$technique', '$gender')";
  $result = $conn -> query($sql);
  if($result === true) {
    $res['success'] = true;
    $res['message'] = "Add successfully";
  }
  else {
    $res['success'] = false;
    $res['message'] = "Something went wrong";
  }
};

// GET DATA
if($action == 'getData') {
  $sql = "SELECT * FROM `devdata`";
  $result = $conn -> query($sql);
  $num = mysqli_num_rows($result);
  $devData = array();
  if($num > 0){
    while($row = $result->fetch_assoc()){
      array_push($devData,$row);
    };
    $res['error'] = false;
    $res['devData'] = $devData;
    $res['message'] = "Get Success";
  }
  else{
      $res['error'] = true;
      $res['message'] = "Get Fail";
  }
};

// UPDATE DATA
if($action == 'updateData') {
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $technique = $_POST['technique'];
  $gender = $_POST['gender'];

  $sql = "UPDATE `devdata` SET `name`='$name',`email`='$email', `technique`='$technique',`gender`='$gender' WHERE `id`='$id'";
  $result = mysqli_query($conn,$sql);
  if($result){
    $res['success'] = true;
    $res['message'] = "Update Success";
  }
  else{
    $res['success'] = false;
    $res['message'] = "Update Fail";
  }
};

// DELETE DATA
if($action == 'deleteData') {
  $id = $_POST['id'];
  
  $sql = "DELETE FROM `devdata` WHERE `id` IN ($id)";
  $result = mysqli_query($conn,$sql);
  if($result){
    $res['success'] = true;
    $res['message'] = "Delete Success";
  }
  else{
    $res['success'] = false;
    $res['message'] = "Delete Fail";
  }
};

$conn -> close();
header("Content-type: application/json");
echo json_encode($res);
die();
?>