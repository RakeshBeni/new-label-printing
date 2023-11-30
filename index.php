<?php

include './connection.php';

if (isset($_GET['brandName'])) {
    $brandName = $_GET['brandName'];
    $sql = "SELECT  * FROM `brand_product_img` WHERE `company` = '$brandName' ";
    $result = mysqli_query($conn, $sql);
} else {

    $sql = "SELECT DISTINCT `company`,`brand_url` FROM `brand_product_img` ";
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
            if (isset($_GET['brandName'])) {
                echo '<div class="col-12 m-3 text-center">
                <a href="index.php">
                    <button type="button" class="btn btn-primary btn-lg shadow">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                        </svg> &nbsp Select Brand
                    </button>
                </a>
            </div>';

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['product'] === 'AAA') {
                        continue;
                    }
                    

                    echo '<div class="col-md-3 mb-4">
                    <a href="testing.php?brandName=' . $row['company'] . '&product=' . $row['product'] . '" class="col-md-3 mb-4 diplay-block text-decoration-none text-dark">
                        <div class="card h-100"">
                            <div class="card-img-container">';


                            if ($row['product_url'] == "") {

                                echo '<h5 class="card-title text-center text-warning" > Image not avalible</h5>';
                            } else {
                                echo '<img src="https://authenfitplus.com/submit/brand_image/' . $row['product_url'] . '.png" class="card-img-top" alt="' . $row['product'] . '"> ';
                            }

                            echo '
                            </div>
                            <div class="card-body";>
                                <h5 class="card-title text-center"> ' . $row['product'] . '</h5>
                                <h5 class="card-title text-center text-success"> Rs ' . $row['price'] . '/-</h5>
                            </div>
                        </div>
                    </a>
                </div>';
                }

                echo '<div id="addBrand" onclick="addProuct()" class="col-md-3 mb-4 text-decoration-none text-dark"> 
                <div class="card h-100 mt-4" style="height: 50px;">
                    <h1 class="text-success text-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="76" height="76" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </h1>
                    <div class="card-body">
                        <h5 class="card-title text-success text-center"> Add brand</h5>
                    </div>
                </div>
            </div>';
            } else {
                echo ' <div class="col-12 m-3 text-center"> <button type="button" class="btn btn-secondary btn-lg shadow"  disabled> Select Brand</button></div>';

                while ($row = mysqli_fetch_assoc($result)) {

                    echo '  <a href="?brandName=' . $row['company'] . '" class="col-md-3 mb-4 diplay-block text-decoration-none text-dark"> <div class="card">';
                    if ($row['brand_url'] == "") {

                        echo '<h5 class="card-title text-center text-warning" > Image not avalible</h5>';
                    } else {

                        echo ' <img src="https://authenfitplus.com/submit/brand_image/' . $row['brand_url'] . '.png" class="card-img-top" alt="' . $row['company'] . '">';
                    }


                    echo '<div class="card-body">
                    <h5 class="card-title"> ' . $row['company'] . '</h5>
                    </div>
                    </div>
                    </a>';
                }
                echo '  <div id="addBrand" onclick="addbrand()" class="col-md-3 mb-4 diplay-block text-decoration-none text-dark"> 
                <div class="card"> <h1 class="text-success text-center mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="76" height="76" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
              </svg></h1><div class="card-body">
                    <h5 class="card-title text-success text-center"> Add brand</h5>
                    </div>
                    </div>
                    </div>';
            }
            ?>


        </div>
    </div>



    <div class="modal fade" id="myModalforProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product of <?php if (isset($_GET['brandName'])) {
                                                                                        echo $_GET['brandName'];
                                                                                    } ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p class="text-danger">Please Upload background removed png with max size of 700kb </p>
                    <div class="m-2">

                        <form action="https://authenfitplus.com/submit/addpoduct.php" method="POST" enctype="multipart/form-data">

                            <div class="row">
                                <input type="text" name="brand" value="<?php if (isset($_GET['brandName'])) {
                                                                            echo $_GET['brandName'];
                                                                        } ?>" hidden>

                                <div class="input-group mb-3 ">
                                    <input type="text" name="productName" class="form-control" placeholder="Product Name" aria-label="Username" aria-describedby="basic-addon1" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Product </span>
                                    </div>
                                </div>
                                <div class="input-group mb-3 ">
                                    <input type="number" name="price" class="form-control" placeholder="Price" aria-label="Username" aria-describedby="basic-addon1" required>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Price</span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <input type="file" name="productPhoto" accept="image/png" class="custom-file-input" id="customFile" onchange="updateLabel()" required>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="m-2">
                    <p class="text-danger">Please Upload background removed png with max size of 500kb </p>
                        <form action="https://authenfitplus.com/submit/addpoduct.php" method="POST" enctype="multipart/form-data">

                            <div class="row">

                                <div class="input-group mb-3 ">

                                    <input type="text" name="brandName" class="form-control" placeholder="Brand" aria-label="Username" aria-describedby="basic-addon1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">Brand Name</span>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                        <input type="file" name="icon" class="custom-file-input" accept="image/png" id="customFile" onchange="updateLabel()" required>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
<div class="modal fade" id="Modal11" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body ">
       
      <form class="d-flex justify-content-between" action="addflavour.php" method="post">    
     
      <input type="text" name="flavour" id="flavour" placeholder="add flavour">
      <button type="submit" class="btn btn-primary mx-2">Save changes</button>
      </form>
      </div>
      
    </div>
  </div>
</div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function addbrand() {
            $('#myModal').modal('show')
        }


        function addProuct() {
            $('#myModalforProduct').modal('show')


        }

        function updateLabel() {
            const input = document.getElementById('customFile');
            const label = input.previousElementSibling;
            const fileName = input.files[0].name;
            label.innerHTML = fileName;
        }


        function addflavour() {
            $('#Modal11').modal('show')
        }
    </script>
</body>

</html>