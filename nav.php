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
                    <button type="button" class="btn btn-primary" onclick="addflavour()">
                    add flavour
                  </button>
                    </li>
                    
                    
                </ul>
            </div>
            </div>
      
</nav>




'



;
 }

?>