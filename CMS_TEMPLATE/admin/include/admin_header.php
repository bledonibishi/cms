<?php include "../include/db.php"; ?>
<?php include "functions.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>

<?php

if (!isset($_SESSION['user_role'])) {
    // if($_SESSION['user_role'] !== 'admin'){
    //     
    // }
    header("Location:../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CMS Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- JS dashboard chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>

</head>



<body>