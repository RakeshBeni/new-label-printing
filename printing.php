<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="spinner-border m-5" role="status">
  <span class="sr-only">Loading...</span>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>


<?php 

if(isset($_POST) ){
    include './connection.php';


    $sql = "SELECT * FROM `unique code database`WHERE `company` ='' AND `product` ='' ";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        // print_r($row);
        // echo ($row);

        $available = $row['sr no'];
    print_r($_POST);

    $company = $_POST["brand"];
    $product = $_POST["product"];
    $flavour = $_POST["flavour"];
    $mfg0 = $_POST["mfg"];
    if($mfg0==''&& date('d')<=15){
        $GLOBALS['mfg0'] = mktime( 0,0,0, date('m')-1, 2, date('y'));
        $mfg = date('d-M-o', $mfg0);
    }elseif($mfg0==''&& date('d')>15){
        $GLOBALS['mfg0'] = mktime( 0,0,0, date('m')-1, 16, date('y'));
        $mfg = date('d-M-o', $mfg0);
    }elseif($mfg0 != ""){
        $mfg = $mfg0;
    }
    
    $totalCode = $_POST["labels"];
    $lastCode = $available + $totalCode - 1;
    $exp = date('d-M-o', strtotime("$mfg + 550 days"));

    //for geting flavour code
    $sql4 = "SELECT `id` FROM `category and flavours` WHERE `flavour` = '$flavour' ";
    $result4 = mysqli_query($conn, $sql4);
    $row4 = mysqli_fetch_assoc($result4);
    $id = $row4['id'];

    // for geting price of the product
    $sql3 = "SELECT * FROM `brand_product_img` WHERE `company` LIKE '$company' AND `product` LIKE '$product'";
    $result2 = mysqli_query($conn, $sql3);
    $row2 = mysqli_fetch_assoc($result2);
    $price = "$row2[price]";
    $code = $row2['code']*100;

    $batch = $code+$id;


    // $sql21 = "UPDATE `unique code database` SET `company`='$company',`product`='$product',`flavour`='$flavour',`mfg` = '$mfg' , `best before` = '$exp' , `price` = '$price' ,`batch` = '$batch' ,`date` = sysdate()  WHERE `sr no` BETWEEN '$available' AND '$lastCode' ";

    // $result21 = mysqli_query($conn, $sql21);

    // if ($result21) {

    //     $sql2 = "UPDATE `unique code database` SET `company`='$company',`product`='$product',`flavour`='$flavour',`mfg` = '$mfg' , `best before` = '$exp' , `price` = '$price' ,`batch` = '$batch' ,`date` = sysdate()  WHERE `sr no`BETWEEN '$available' AND '$lastCode' " ;

    //     $result2 = mysqli_query($con, $sql2);
    // } else {

    //     echo "pleae connect to the internet";
    // }


    
    $result5 = mysqli_query($con, "SELECT * FROM tagdatabase WHERE `brand` = '$company'");
    
    $row5 = mysqli_fetch_assoc($result5);
    
    $tag = $row5['brandTag'];
    

$apiUrl = 'http://DESKTOP-B5NGVSH:83/Integration/labelprint/Execute';


// // Data to be sent in the POST request (example data as an associative array)
$postData = array(
    'range' => $available . '-' . $lastCode,
    'tag' => $tag,

);

// Convert the data to a JSON-encoded string
$jsonData = json_encode($postData);
print_r($postData);

// // Initialize cURL session
// $ch = curl_init();

// // Set the cURL options
// curl_setopt($ch, CURLOPT_URL, $apiUrl);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string instead of outputting it
// curl_setopt($ch, CURLOPT_POST, true); // Set as POST request
// curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Set POST data as JSON
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); // Set JSON content type header

// // Execute the cURL session and capture the response
// $response = curl_exec($ch);

// // Check for cURL errors
// if (curl_errno($ch)) {
//     echo 'Curl error: ' . curl_error($ch);
// }

// // Close the cURL session
// curl_close($ch);

// // Handle the response
// if ($response !== false) {
    
//     $responseData = json_decode($response, true);
//     if ($responseData !== null) {
//         // Handle the response data here
//         var_dump($responseData);
//     } else {
//         // If the response is not in JSON format, handle it accordingly
//         echo 'Invalid response format: ' . $response;
//     }
// } else {
//     // If cURL execution failed, handle the error
//     echo 'Failed to execute the request.';
// }

header("location:index.php");


}

?>