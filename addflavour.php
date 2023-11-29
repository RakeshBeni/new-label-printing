<?php 

include "connection.php";
global $conn;
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    // echo "hii";
    $flavour = $_POST['flavour'];
    $sql ="SELECT * FROM `category and flavours` WHERE `flavour` = '$flavour'  ";
    $result = mysqli_query($conn, $sql);
    $rownum = mysqli_num_rows($result);
    
    if($rownum>0){
        echo "<h2 class=\"text-warning text-center\">you already have this brand</h2>";
    }else{
        
        
        $sql2 ="INSERT INTO `category and flavours` (`flavour`) VALUES ('$flavour'); ";
        $result2 = mysqli_query($conn, $sql2);
        if($result2){
            header('location:index.php');
           
            }

        }
    }
    
    ?>