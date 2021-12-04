<?php 

session_start(); 

include "conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['username']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("Location: loginpage.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("Location: loginpage.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM login_credentials WHERE user_name='$uname' AND password='$pass'";

        $result = mysql_query($con, $sql);

        if (mysql_num_rows($result) === 1) {

            $row = mysql_fetch_assoc($result);

            if ($row['user_name'] === $uname && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['user_name'] = $row['user_name'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];

                header("Location: /home/home.html");//home change to page after login success

                exit();

            }else{

                header("Location: loginpage.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: loginpage.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: loginpage.php");//index changed to loginpage

    exit();

}