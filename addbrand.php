<?php

include './connection.php';

if (isset($_GET['brandName'])) {
    $brandName = $_GET['brandName'];
    $sql = "SELECT  * FROM `company` WHERE `company` = '$brandName' ";
    $result = mysqli_query($conn, $sql);
} else {

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
    printnav('add brand');
    ?>

    <div class="container mt-5">

        <div class="d-flex  justify-content-center">

            <form method="POST" enctype="multipart/form-data">

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
                            <input type="file" class="custom-file-input" id="customFile" onchange="updateLabel()">
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <hr>

        <div class="row">

            <?php

            echo ' <div class="col-12 m-3 text-center"> <button type="button" class="btn btn-secondary btn-lg shadow"  disabled> Already Exist</button></div>';

            while ($row = mysqli_fetch_assoc($result)) {

                echo '  <a href="?brandName=' . $row['company'] . '" class="col-md-3 mb-4 diplay-block text-decoration-none text-dark"> <div class="card">';
                if ($row['BrandUrl'] == "") {

                    echo '<h5 class="card-title text-center text-warning" > Image not avalible</h5>';
                } else {

                    echo ' <img src="https://authenfitplus.com/submit/brand_image/' . $row['BrandUrl'] . '.png" class="card-img-top" alt="' . $row['company'] . '">';
                }


                echo '<div class="card-body">
                    <h5 class="card-title"> ' . $row['company'] . '</h5>
                    </div>
                    </div>
                    </a>';
            }


            ?>


        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function updateLabel() {
            const input = document.getElementById('customFile');
            const label = input.previousElementSibling;
            const fileName = input.files[0].name;
            label.innerHTML = fileName;
        }
    </script>
</body>

</html>