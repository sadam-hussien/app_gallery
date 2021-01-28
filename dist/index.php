<?php 

    require_once "init.php";
    
?>

<div class="app">

    <section class="app-gallery padding-sec">

        <!-- start the preloader  -->
        <div class="cssloader">
            <div class="loader"></div>
        </div>
        <!-- // end the preloader  -->

        <div class="container">
        
            <!-- start app-gallery-head  -->
            <section class="app-gallery-head">
                <?php require components . "gallery/head.php"; ?>
            </section>
            <!-- // end app-gallery-head  -->

            <!-- start app-gallery-body  -->
            <section class="app-gallery-body">
                <!-- pagination  -->
                <?php require components . "gallery/pagination.php"; ?>

                <!-- content  -->
                <?php require components . "gallery/body.php"; ?>
            </section>
            <!-- // end app-gallery-body  -->

            <!-- start app-gallery-footer  -->
            <section class="app-gallery-footer">
            </section>
            <!-- // end app-gallery-footer  -->

        </div>

        <!-- start app-gallery-modal  -->
        <section class="app-gallery-modal">
            <?php require components . "gallery/add.php"; ?>
        </section>
        <!-- // end app-gallery-modal  -->

    </section>

</div>

<?php

    require_once templates . "footer.php"; 
    
?>