<?php
include "./connection.php";

$brandName = $_GET['brandName'];
$product = $_GET['product'];
$sql = "SELECT  * FROM `brand_product_img` WHERE `company` = '$brandName' AND `product` = '$product' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Label</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body class="bg-light">
    
<?php
include "nav.php";
printnav('labels print');
?>

    <div class="container vh-100">
        <div class="mt-5">
            
            <div class="col-12 m-3 text-center"> <a href="index.php?brandName=<?php echo $brandName?>"><button type="button" class="btn btn-primary btn-lg shadow" ><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg> &nbsp Select product</button></a></div>
            <div class="d-flex justify-content-center ">

                <div class="card text-center" style="width: 26rem;">
                <?php 
                 
                  if($row['product_url'] == ""){

                      echo '<h5 class="card-title text-center text-warning" > Image not avalible</h5>';
                  }else{
                    echo '<img src="https://authenfitplus.com/submit/brand_image/'.$row['product_url'].'.png" class="card-img-top" alt="'.$row['product'].'"> ';
                  }
                ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['product'] ?></h5>
                        <h5 class="card-title text-center text-success" > Rs <?php echo $row['price'] ?>/-</h5>


                        <form action="printing.php" id="myForm" method="post">

                        <input type="text" name="brand" value="<?php echo $brandName?>" hidden>
                        <input type="text" name="product" value="<?php echo $product?>" hidden>
                        <input type="text" name="price" value="<?php echo $row['price']?>" hidden>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Flavous</label>
                            </div>
                            <select class="custom-select" name="flavour" id="inputGroupSelect01">
                            <?php $sql1 = "SELECT `flavour` ,`id` FROM `category and flavours` WHERE `flavour` != '' ";
                        $result = mysqli_query($conn, $sql1);

                        while ($row = mysqli_fetch_assoc($result)) {

                            $flavour = $row['flavour'];
                            // $code = $row['id'];
                            echo "<option value=\"$flavour\">$flavour</option>";
                        }
                        ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Mfg</span>
                            </div>
                            <input type="date" name="mfg" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Labels</span>
                            </div>
                            <input type="Number" name="labels" class="form-control" placeholder="Total Labels" aria-label="Username" aria-describedby="basic-addon1">
                        </div>




                        <button type="submit" class="btn btn-primary">Print Labels</button>

                        </form>
                    </div>
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
         function addflavour() {
            $('#Modal11').modal('show')
        }
    </script>
</body>

</html>