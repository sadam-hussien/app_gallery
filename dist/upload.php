<?php 
    
    require_once "init.php";

    // classes
    $util = new Util();

    $quiry = new Query();

    // fetch all images
    if (isset($_POST["fetchAllImages"])) {
        
        $imgs = $quiry->fetchAllImgs();

        $output = "";

        foreach($imgs as $img) {

            $output .= "<div class='img-item-outer'>
                <div class='img-item'>
                    <img src='uploads/".$img["path"]."' class='img-fluid' alt='".$img["title"]."' >

                    <div class='img-item-details' data-id='".$img["id"]."'>
                        <h5 class='img-item-details-title text-capitalize'>".$img["title"]."</h5>
                        <h6 class='img-item-details-date'>".$img["uploaded"]."</h6>
                        <ion-icon class='the-icon' name='expand-outline'></ion-icon>
                    </div> 
                </div>
            </div>";

        }

        echo $output;

    }

    // pagination
    if (isset($_POST["pageNumber"])) {

        $pageNum = $_POST["pageNumber"];

        $quiry->page = $pageNum;

        $quiry->startOf();

        $imgs = $quiry->fetchAllImgs();

        $output = "";

        foreach($imgs as $img) {

            $output .= "<div class='img-item-outer'>
                <div class='img-item'>
                    <img src='uploads/".$img["path"]."' class='img-fluid' alt='".$img["title"]."' >

                    <div class='img-item-details' data-id='".$img["id"]."'>
                        <h5 class='img-item-details-title text-capitalize'>".$img["title"]."</h5>
                        <h6 class='img-item-details-date'>".$img["uploaded"]."</h6>
                        <ion-icon class='the-icon' name='expand-outline'></ion-icon>
                    </div> 
                </div>
            </div>";

        }

        echo $output;

    }

    // upload img
    if (isset($_POST["uploadImg"])) {
        
        // image title
        $imgTitle = $util->inputVal($_POST["imgTitle"]);

        // image file
        $imgFile = $_FILES["imgFile"];
        
        $imgFileName = $imgFile["name"];
        $imgFileType = $imgFile["type"];
        $imgFileTemp = $imgFile["tmp_name"];
        $imgFileSize = $imgFile["size"] / 1024;
        $imgFileError = $imgFile["error"];

        // image extension
        $fileExtension = explode(".", $imgFileName);
        $fileExtension = end($fileExtension);
        $fileExtension = strtolower($fileExtension);

        // unique name
        $imgUniqueName = rand(0, 100000) . "." . $fileExtension;

        // allowed extension
        $myExtensions = ["jpg", "jpeg", "png"];

        $mySize = 1024 * 4;

        $target = __DIR__ . "\uploads\\";

        // check if there is no files choosed
        if ($imgFileError == 4) {

            echo $util->msg("danger", "no files choosed");

        // end check if there is no files choosed
        } else {

            // check on extension
            if (in_array($fileExtension, $myExtensions)) {

                // check on image size
                if ($mySize >= $imgFileSize) {

                    if (move_uploaded_file($imgFileTemp, $target . $imgUniqueName)) {

                        $quiry->uploadImg($imgTitle, $imgUniqueName);

                    }

                    echo $util->msg("success", "the image uploaded successfully!");
                    
                // end check on image size
                } else {

                    echo $util->msg("danger", "the image size must be less than ".$mySize." KB");

                }

            // end check on extension
            } else {

                echo $util->msg("danger", "the image type not supported! only ".implode(", ", $myExtensions)."");

            }

        }

    }

    // delete img
    if (isset($_POST["deleteImg"])) {
        $quiry->deleteImg($_POST["imgId"]);
        echo "deleted";
    }

?>