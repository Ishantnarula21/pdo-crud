<?php
$servername = "localhost";
$username = "root";

try {
    //database connection
    $conn = new PDO("mysql:host=$servername;dbname=pdotry", $username);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Insert record
    if (!empty($_REQUEST['name']) && !empty($_REQUEST['marks'])) {
        $name = $_REQUEST['name'];
        $marks = $_REQUEST['marks'];
        $query = "insert into student (name,marks) VALUES('$name','$marks')";
        $conn->exec($query);
        echo "Record inserted";
    }
    //delete record
    if (!empty($_REQUEST['did'])) {
        $id = $_REQUEST['did'];
        $query = "delete from student where id=$id";
        $result = $conn->prepare($query);
        $result->execute();
        if ($result) {
            echo "Record deleted";
        }
    }
    //update record
    if (!empty($_REQUEST['uid'])) {
        $id = $_REQUEST['uid'];
        $name = $_REQUEST['uname'];
        $marks = $_REQUEST['umarks'];
        $query = "update student set name='$name',marks='$marks' where id=$id";
        $result = $conn->prepare($query);
        $result->execute();
        if ($result) {
            echo "Record updated";
        }
    }
    //display custom record
    if (isset($_REQUEST['cid'])) {
        $id = $_REQUEST['cid'];
        $query = "select * from student where id=$id";
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchAll();
        foreach ($row as $data) {
            print_r($data);
        }
    }
    //display record
    else {
        $query = "select * from student";
        $result = $conn->prepare($query);
        $result->execute();
        $row = $result->fetchAll();
        print_r($row);
    }
    //catching error
} catch (PDOException $e) {
    echo "Connection failed: " . " " . $e->getMessage();
}
