$(function () {

    let addGalleryMsg = $(".app-gallery .messages");

    let addGalleryForm = $(".app-gallery .add-gallery-form");

    let imgTitleInput = addGalleryForm.find("#imgTitle");

    let imgFileInput = addGalleryForm.find("#imgFile");

    let addGallerySubmit = addGalleryForm.find("#addGallerySubmit");

    // fetch all images
    fetchAllImages();

    // validation on uploaded
    imgFileInput.on("change", function () {

        let fileValue = $(this).val();

        let fileExtension = fileValue.split(".").pop().toLowerCase();

        // the allowed files extensions uploaded
        let myExtensions = ["jpg", "jpeg", "png"];

        // check on the extension file
        if (myExtensions.includes(fileExtension)) {               

            // get the file size with "kb"
            let fileSize = Math.round(this.files[0].size / 1024);

            // the allowed size
            let mySize = 1024 * 4;

            // check on the file size
            if (fileSize <= mySize) {

                // allow for user from submiting
                addGallerySubmit.prop("disabled", false);
                addGallerySubmit.removeClass("no-active");

                addGalleryForm.find(".file-inp-label").html(this.files[0].name);

                showMsg("success", "the image upload success");

                // and make the what you want like preview img ...

            } else {

                // prevent user from submiting
                addGallerySubmit.prop("disabled", true);
                addGallerySubmit.addClass("no-active");

                showMsg("danger", `the image size must be less than ${mySize} KB`, true);

            }
            
        } else {

            // prevent user from submiting
            addGallerySubmit.prop("disabled", true);
            addGallerySubmit.addClass("no-active");

            showMsg("danger", `the image type not supported! only ${myExtensions.join(", ")}`, true);

        }
        

    });

    // submiting the data after validation
    addGalleryForm.on("submit", function (e) {

        let self = $(this);

        e.preventDefault();

        const data = new FormData(this);

        data.append("uploadImg", true);

        $.ajax({
            url: "upload.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response, two, th) {

                addGalleryMsg.html(response);

                self[0].reset();

                fetchAllImages(); 

            }

        });

    });

    // show details
    $(document).on("click", ".img-item-details", function () {

        let id = $(this).data("id");

        let img = $(this).parent().find("img").attr("src");

        let title = $(this).find(".img-item-details-title").text();

        let date = $(this).find(".img-item-details-date").text();

        $("body").css("overflow", "hidden");

        $(".full-img-details").html(`
        
            <div class='full-img-details-box padding-sec'>
                <div class='container'>
                    <div class='de position-relative'>
                        <h4 class='full-img-details-box-title'>${title}</h4>
                        <h6 class='full-img-details-box-date m-0'>uploaded at: ${date}</h6>
                        <button class='my-btn full-img-details-box-close'>
                            <ion-icon class='the-icon' name='close-outline'></ion-icon>
                        </button>
                    </div>
                    <div class='img'>
                        <img src='${img}' class='img-fluid' alt="${title}">
                    </div>
                    <div class='de-actions'>
                        <button type='button' class='my-btn' data-id='${id}'><ion-icon name='trash-outline' class='the-icon'></ion-icon>delete</button>
                    </div>
                </div>
            </div>

        `).fadeIn("slow");

    });

    // close details
    $(document).on("click", ".full-img-details-box-close", function () {

        resetDefaultAppGallery();

    });

    // delete img
    $(document).on("click", ".full-img-details .de-actions .my-btn", function () {

        let self = $(this);

        let id = $(this).data("id");

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {

                $.ajax({
                    url: "upload.php",
                    method: "POST",
                    data: {"deleteImg": 1, "imgId": id},
                    chache: false,
                    success: function (response) {
                        swal("Poof! Your imaginary file has been deleted!", {

                            icon: "success",

                        }).then((val) => {

                            resetDefaultAppGallery();

                            fetchAllImages();

                        })
                    }

                });

            }
        });

    });
    
    // messages
    function showMsg(type, content, status = null) {

        if (status != null) {

            addGalleryMsg.html(`
                <div class='alert alert-${type}'>${content}</div>
            `);

        } else {

            addGalleryMsg.html("");

        }

        return true;
    }

    // reset default gallery function
    function resetDefaultAppGallery() {

        $("body").css("overflow", "auto");

        $(".full-img-details").fadeOut("slow", function () {

            $(this).html("");

        });

    }

    // fetch all images
    function fetchAllImages() {
        $.ajax({
            url: "upload.php",
            method: "POST",
            data: {"fetchAllImages": 1},
            chache: false,
            success: function (response) {
                $(".cssloader").slideUp("slow", function () {

                    $(this).remove();

                });
                
                $(".app-gallery-body-inner").html(response);
            }
        });
    }

});