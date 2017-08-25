<?php


include("classes/DB.php"); 
if(isset($_POST['register']))
{
    $user_name  = $_POST['name'];           
    $user_pass  = $_POST['pass'];           
    $user_email = $_POST['email'];          


    if($user_name == '')
    {
        echo"<script>alert('Please enter the name')</script>";
        exit(); 
    }

    if($user_pass == '')
    {
        echo"<script>alert('Please enter the password')</script>";
        exit();
    }

    if($user_email == '')
    {
        echo"<script>alert('Please enter the email')</script>";
        exit();
    }
    
    //here query check weather if user already registered so can't register again.
    $check_email_query = "select * from users WHERE user_email='$user_email'";
    $run_query         = mysqli_query($dbcon, $check_email_query);

    if(mysqli_num_rows($run_query) > 0)
    {
        echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
        exit();
    }

    $insert_user = "insert into users (user_name,user_pass,user_email) VALUE ('$user_name','$user_pass','$user_email')";
    
    if(mysqli_query($dbcon, $insert_user))
    {
        echo"<script>window.open('welcome.php','_self')</script>";
    }
}

?>