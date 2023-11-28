 <?php 
 if(isset($_POST)){

    print_r($_POST);
    if(isset($_POST['brand'])){
        echo "product load";
        $brand = $_POST['brand'];
        $product = $_POST['productName'];
        $price = $_POST['price'];
        
        
        
    }else{
        echo "brand load";
        $brand = $_POST['brandName'];
     
    }



 }
 
 
 
 ?>