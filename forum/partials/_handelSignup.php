<?php
$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_name = $_POST['username'];
    $pass = $_POST['password'];
    $cpass =$_POST['cpassword'];

    // check user name
    $existSql= "select * from `users218` where user_name = '$user_name'";
    $result = mysqli_query($conn, $existSql);
    $num =mysqli_num_rows($result);
    if($num > 0){
        $showError = "User Name Already in use";
    }
    else{
        if($pass == $cpass){
            $hass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users218` (`id`, `user_name`, `user_password`, `time`) VALUES (NULL, '$user_name', '$hass', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showError = true;
                header("Location: /forum/index.php?singupsuccess=true");
                exit();
            }
        }
        else{
            $showError = "password do not match";
        }
    }
    header("location: /forum/index.php?singupsuccess=false&&error=$showError");
}
?>