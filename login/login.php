<?php 
session_start(); 
include "conn.php";
if (isset($_POST['accnum']) && isset($_POST['password'])) {
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    $accno = validate($_POST['accnum']);
    $pass = validate($_POST['password']);
    if (empty($accno)) {
        header("Location: loginpage.php?error=User Name is required");
        exit();
    }else if(empty($pass)){
        header("Location: loginpage.php?error=Password is required");
        exit();
    }
        $sql = "SELECT * FROM login_credentials WHERE acc_no='$accno' AND password='$pass'";
        $result = mysqli_query($con,$sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['acc_no'] === $accno && $row['password'] === $pass) {
                echo "Logged in!";
                header("Location: home.html");//home change to page after login success
                exit();
            }else{
                header("Location: loginpage.php?error=Incorect User name or password");
                exit();
            }
        }else{
            header("Location: loginpage.php?error=Incorect User name or password");
            exit();
        }
    }else{
    header("Location: loginpage.php");//index changed to loginpage
    exit();
}