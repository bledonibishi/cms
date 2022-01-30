<?php include "db.php"; ?>
<?php session_start(); ?>

<?php 

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($conn,$username);
    $password = mysqli_real_escape_string($conn,$password);

    $query = "SELECT * FROM users where username = '$username' ";
    $query_login = mysqli_query($conn,$query);
    if(!$query_login){
        die("query_login FAILED ".mysqli_error($conn));
    }

    while($row = mysqli_fetch_array($query_login)){
       $db_user_id        = $row['user_id'];
       $db_username       = $row['username'];
       $db_user_password  = $row['user_password'];
       $db_user_role      = $row['user_role'];
       $db_user_email     = $row['user_email'];
       $db_user_firstname = $row['user_firstname'];
       $db_user_lastname  = $row['user_lastname'];
    }
    // $password = crypt($password , $db_user_password);
    if(password_verify($password,$db_user_password)){
        $_SESSION['username']  = $db_username;
        $_SESSION['firstname'] = $db_user_firstname;
        $_SESSION['lastname']  = $db_user_lastname;
        $_SESSION['user_role'] = $db_user_role;

        header("Location:../admin");
    }else{
        header("Location:../index.php");
    }


}


?>