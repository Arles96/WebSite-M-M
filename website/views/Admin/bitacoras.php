<?php 
include_once ROOT.FOLDER_PATH."/website/views/head.php";
?>

<body>
    <div class="contanier">
        <div class="col-lg-3 menu">
            <?php    include_once 'menu_bar.php'; ?>
        </div>
        <div class="col-lg-9">
            <h1 class="w3-xxlarge w3-text-red title"> <b>Bitacora</b> </h1>
            <hr class="divition w3-round">
            <?php 
                if ($bitacoras->num_rows>0){
                    $html = '';
                }
            ?>
        </div>
    </div>    
</body>

</html>

