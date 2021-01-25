<div class="row modal fade" id="galleryAppAdd" tabindex="-1" aria-labelledby="galleryAppAddLabel" aria-hidden="true">
    <div class="col-12 col-md-8 col-lg-6 modal-dialog">
        <div class="modal-content">

            <!-- start mesages  -->
            <div class="messages"></div>
            <!-- // end messages  -->

            <!-- start modal-header  -->
            <div class="modal-header">
                <h4 class="modal-title text-capitalize" id="galleryAppAddLabel">upload new image</h4>
                <button class="my-btn close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- // end modal-header  -->

            <!-- start modal-body  -->
            <div class="modal-body">

                <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" class="add-gallery-form my-form" name="addGalleryForm" enctype="multipart/form-data">

                    <!-- start image title  -->
                    <div class="form-group">
                        <input type="text" name="imgTitle" id="imgTitle" class="form-control normal-inp img-title" placeholder="image title...">
                    </div>
                    <!-- // end image_title  -->

                    <!-- start image-file-upload  -->
                    <div class="form-group last-form-group">
                        <input type="file" class="file-inp" name="imgFile" id="imgFile">
                        <label class="file-inp-label" for="imgFile">no file choosen</label>
                    </div>
                    <!-- // end image-file-upload  -->

                    <button type="submit" class="my-btn submit-btn" id="addGallerySubmit">
                        <ion-icon name="cloud-upload-outline" class="the-icon"></ion-icon>
                        <span>upload</span>
                    </button>

                </form>
            </div>
            <!-- // end modal-body  -->

        </div>
    </div>  
</div>