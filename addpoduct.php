 <?php 
 include "./connection.php";
 if(isset($_POST)){

    print_r($_POST);
    if(isset($_POST['brand'])){
        echo "product load";
        $brand = $_POST['brand'];
        $product = $_POST['productName'];
        $price = $_POST['price'];
        $productUrl = $brand."/".$product;
        print_r($_FILES);
        $file_tmp = $_FILES['productPhoto']['tmp_name'];

        if (isset($_FILES['productPhoto']) && $_FILES['productPhoto']['error'] == 0) {

            $destinationFolder = "brand_image/$brand";
            if (!is_dir($destinationFolder)) {
                mkdir($destinationFolder, 0777, true); 
            }
            move_uploaded_file($file_tmp, "brand_image/$brand/" . $product . ".png");
            $result1 = mysqli_query($conn , "SELECT * FROM `company` WHERE `company` = '$brand' AND `product` = 'AAA' ");
            $rownum = mysqli_num_rows($result1);
            if($rownum == "1"){
                $result2 = mysqli_query($conn, "UPDATE `company` SET `product`='$product',`productUrl`='$productUrl',`price`='$price' WHERE `company` = '$brand' AND `product` = 'AAA'");
            }elseif($rownum == "0"){
                $result2 = mysqli_query($conn, "SELECT  `BrandUrl` FROM `company` WHERE `company` = '$brand'");
                $row = mysqli_fetch_assoc($result2);
                $brandUrl = $row['BrandUrl'];

                $result3 = mysqli_query($conn , "INSERT INTO `company`( `company`, `product`, `BrandUrl`, `productUrl`, `price`) VALUES ('$brand','$product','$brandUrl','$productUrl','$price')");
            } 

            
        }
        
        
        
    }else{
        echo "brand load";
        $brand = $_POST['brandName'];
        $brandUrl = $brand."icon";

        $file_tmp = $_FILES['icon']['tmp_name'];

        print_r($_FILES);
        if (isset($_FILES['icon']) && $_FILES['icon']['error'] == 0) {

            $destinationFolder = "brand_image";
            if (!is_dir($destinationFolder)) {
                mkdir($destinationFolder, 0777, true); 
            }
            move_uploaded_file($file_tmp, "brand_image/" . $brand . "icon.png");
            $result = mysqli_query($conn,"INSERT INTO `company`( `company`, `product`, `BrandUrl`) VALUES ('$brand','AAA','$brandUrl')");
        }
     
    }



 }
 
 
 
 ?>