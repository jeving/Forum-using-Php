<?php
$showError ="false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $u_name = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "select * from users218 where user_name = '$u_name'";
    $result = mysqli_query($conn,$sql);
    $num =mysqli_num_rows($result);
    if($num == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass , $row['user_password'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $u_name;
            echo "loggedin " . $u_name;
            // <!-- header("Location: /forum/index.php");
            // exit(); -->
        }
        header("Location: /forum/index.php");
    }
    header("Location: /forum/index.php");
}



?>