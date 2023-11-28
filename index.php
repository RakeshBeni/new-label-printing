<?php

include './connection.php';

if(isset($_GET['brandName'])){
    $brandName = $_GET['brandName'];
    $sql = "SELECT  * FROM `company` WHERE `company` = '$brandName' ";
    $result = mysqli_query($conn, $sql);
}else{
   
    $sql = "SELECT DISTINCT `company`,`BrandUrl` FROM `company` ";
    $result = mysqli_query($conn, $sql);
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brand Cards</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">

<?php
include "nav.php";
printnav('labels print');
?>

    <div class="container mt-5">
        <div class="row">

        

       

            <?php 
            if(isset($_GET['brandName'])){
                echo ' <div class="col-12 m-3 text-center"> <a href="index.php"><button type="button" class="btn btn-primary btn-lg shadow" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
              </svg> &nbsp Select Brand</button></a></div>';
                while ($row = mysqli_fetch_assoc($result)) { 
         
                    echo '  <a href="testing.php?brandName='.$row['company'].'&product='.$row['product'].'" class="col-md-3 mb-4 diplay-block text-decoration-none text-dark"> <div class="card">';
                    if($row['productUrl'] == ""){

                        echo '<h5 class="card-title text-center text-warning" > Image not avalible</h5>';
                    }else{
                        echo '<img src="https://authenfitplus.com/submit/brand_image/'.$row['productUrl'].'.png" class="card-img-top" alt="'.$row['product'].'"> ';
                    }
                    echo ' <div class="card-body"><h5 class="card-title text-center"> '.$row['product'].'</h5>
                                       <h5 class="card-title text-center text-success" > Rs '.$row['price'].'/-</h5>
                                   </div>
                               </div>
                           </a>';
           
                     }
            
            }else{
                echo ' <div class="col-12 m-3 text-center"> <button type="button" class="btn btn-secondary btn-lg shadow"  disabled> Select Brand</button></div>';

                while ($row = mysqli_fetch_assoc($result)) { 
                    
                    echo '  <a href="?brandName='.$row['company'].'" class="col-md-3 mb-4 diplay-block text-decoration-none text-dark"> <div class="card">';
                    if($row['BrandUrl'] == ""){

                        echo '<h5 class="card-title text-center text-warning" > Image not avalible</h5>';
                    }else{
                       
                        echo ' <img src="https://authenfitplus.com/submit/brand_image/'.$row['BrandUrl'].'.png" class="card-img-top" alt="'.$row['company'].'">';
                    }
                    
                    
                    echo '<div class="card-body">
                    <h5 class="card-title"> '.$row['company'].'</h5>
                    </div>
                    </div>
                    </a>';
                }

          }
           ?>


        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>