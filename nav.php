<?php 
 function printnav($page){
    echo '<nav class="navbar navbar-expand-lg navbar-light bg-light shadow" ">
    <div class="container-fluid">
    <a class="navbar-brand" href="">
    <p class="h4">Royalent</p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse  justify-content-center" id="navbarSupportedContent">
            <div class="d-flex">

                <ul class="navbar-nav d-flex me-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-3">
                        <a class="nav-link ';
                        if($page == 'labels print'){
                            echo 'active';
                        };
                        echo ' " aria-current="page" href="index.php">
                            <p class="h5">Print labels</p>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link ';
                        if($page == 'add brand'){
                            echo 'active ';
                        };
                        echo '" href="addbrand.php">
                            <p class="h5">Add Brand</p>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link ';
                        if($page == 'add product'){
                            echo 'active ';
                        };
                        echo '" href="productAdd1.php">
                            <p class="h5">Add product</p>
                        </a>
                    </li>
                   
                    <li class="nav-item mx-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal11">
                    add flavour
                  </button>
                    </li>
                    
                    
                </ul>
            </div>
            </div>
      
</nav>


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


'



;
 }

?>