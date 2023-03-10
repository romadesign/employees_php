<?php
function login()
{
  include('db/dbconnect.php');
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $exist = mysqli_fetch_assoc($result);
    $user_id = $exist['id'];
    if (isset($exist)) {
      if (isset($_COOKIE["login_status"]) == NULL || isset($_COOKIE["login_status"]) == "" || isset($_COOKIE["login_status"]) == "false") {
        setcookie("login_status", 'true');
        setcookie("type_user", $exist['role']);
        setcookie("user_id", $user_id);
        
        header('Location: users.php');
        exit;
      }
    }else{
      session_start();
      $_SESSION['mensaje'] = "Incorrect user or password";
    }
  }
}
?>