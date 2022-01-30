<?php

function escape($string)
{
    global $conn;

    return mysqli_real_escape_string($conn, trim($string));
}


function users_count_online()
{

    if (isset($_GET['onlineusers'])) {
        global $conn;
        if (!$conn) {
            session_start();
            include "../include/db.php";


            $session = session_id();
            $time = time();
            $time_out_count = 10;
            $time_out = $time - $time_out_count;

            $query = "SELECT * FROM users_online WHERE session = '$session' ";
            $query_users_online = mysqli_query($conn, $query);
            $count = mysqli_num_rows($query_users_online);

            if ($count == NULL) {
                mysqli_query($conn, "INSERT INTO users_online(session,time) VALUES('$session' ,$time) ");
            } else {
                mysqli_query($conn, "UPDATE users_online SET time = $time WHERE session = '$session' ");
            }

            $users_online_send = mysqli_query($conn, "SELECT * FROM users_online WHERE time > $time_out ");
            $count_users = mysqli_num_rows($users_online_send);
            echo $count_users;
        }
    }
}
users_count_online();

function queryCheck($result)
{
    global $conn;
    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($conn));
    }
}

function adding_categories()
{

    global $conn;

    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];

        if ($cat_title == "" || empty($cat_title)) {
            echo "this field should not be empty";
        } else {
            $query = "INSERT INTO category(cat_title) values('{$cat_title}') ";
            $add_query = mysqli_query($conn, $query);

            if (!$add_query) {
                die("query failed" . mysqli_error($conn));
            }
        }
    }
}

function allCategories()
{
    global $conn;
    $query = "SELECT * FROM category";
    $query_category = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($query_category)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
        echo "<td><a href='categories.php?update={$cat_id}'>EDIT</a></td>";
        echo "</tr>";
    }
}

function deleteCategories()
{
    global $conn;

    if (isset($_GET['delete'])) {
        $deleted_id = $_GET['delete'];
        $query = "DELETE from category where cat_id = {$deleted_id}";
        $delete_query = mysqli_query($conn, $query);
        header("location:categories.php");
    }
}
