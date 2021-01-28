<?php 

    $quiry = new Query();

    $pages = $quiry->imagesCount();
    
?>

<!-- start pagination  -->
<nav aria-label="navigation page">
    <ul class="pagination">

        <!-- previous icon  -->
        <li class="page-item">
            <a href="#" class="page-link page-link-arrows page-link-prev" aria-label="Previous" data-page="0">
                <ion-icon name="chevron-back-outline" class="the-icon"></ion-icon>
            </a>
        </li>

        <?php 
                        
            for ($i = 0; $i < $pages; $i++) {

                $active = $i == 0 ? "active" : "";

                echo "<li class='page-item'>
                    <a href='#' class='page-link ".$active."' data-page=". $i .">". ($i + 1) ."</a>
                </li>";
                
            }

        ?>

        <!-- next icon  -->
        <li class="page-item">
            <a href="#" class="page-link page-link-arrows page-link-next" aria-label="Next" data-page="2">
                <ion-icon name="chevron-forward-outline" class="the-icon"></ion-icon>
            </a>
        </li>
        
    </ul>
</nav>
<!-- // end pagination  -->