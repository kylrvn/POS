<div class="card card-primary">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <h5>Order Details | </h5>
            </div>
            <div class="col-sm-6">
                <select class="custom-select custom-select-sm rounded-0 select_update" id="o_status">
                    <option value="<?= @$o_status->ID ?>" selected><?= ucfirst(@$o_status->List_name) ?></option>

                    <?php
                    foreach (@$status as $value) { ?>
                        <option value="<?= @$value->ID ?>" <?= @$o_status->ID == @$value->ID ? 'disabled class="text-bold text-danger"' : '' ?>><?= ucfirst(@$value->List_name) ?><?= @$o_status->ID == @$value->ID ? " (Selected)" : '' ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6">
                <h6>Book Date: <b><?= date('M d, Y', strtotime(@$order_dets->Book_date)) ?></b></h6>

                <label for="">Booking Note</label>
                <p class="<?= empty(@$order_dets->Order_note) ? 'text-danger text-bold' : '' ?> note_area2"><?= empty(@$order_dets->Order_note) ? 'No note' : @$order_dets->Order_note ?></p>
                <textarea id="b_note" class="form-control note_area" placeholder="Enter Booking Note..."><?= empty(@$order_dets->Order_note) ? '' : @$order_dets->Order_note ?></textarea>
            </div>
            <div class="col-sm-6">
                <h6 class="dates2">Deadline: <b><?= date('M d, Y', strtotime(@$order_dets->Deadline)) ?></b></h6>
                <h6 class="dates">Deadline: <input id="deadline_date" class="form-control" type="date" value="<?= date(@$order_dets->Deadline) ?>"></b></h6>

                <label for="">Deadline Note</label>
                <p class="<?= empty(@$order_dets->Deadline_notes) ? 'text-danger text-bold' : '' ?> note_area2"><?= empty(@$order_dets->Deadline_notes) ? 'No note' : @$order_dets->Deadline_notes ?></p>
                <textarea id="d_note" class="form-control note_area" placeholder="Enter Deadline Note..."><?= empty(@$order_dets->Deadline_notes) ? '' : @$order_dets->Deadline_notes ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <label for="">Freebies</label>
                <p class="<?= empty(@$order_dets->Freebies) ? 'text-danger text-bold' : '' ?> note_area2"><?= empty(@$order_dets->Freebies) ? 'No freebies' : @$order_dets->Freebies ?></p>
                <textarea id="freebies" class="form-control note_area" placeholder="Enter Freebies..."><?= empty(@$order_dets->Freebies) ? '' : @$order_dets->Freebies ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <label for="">Sewer</label>
                <select class="custom-select custom-select-sm rounded-0 select_update" id="sewer">
                    <option value="<?= @$sewer->ID ?>" selected><?= ucfirst(@$sewer->LName) . " ," . ucfirst(@$sewer->FName) ?></option>
                    <?php
                    foreach (@$users as $value) { ?>
                        <option value="<?= @$value->ID ?>" <?= @$sewer->ID == @$value->ID ? 'disabled class="text-bold text-danger"' : '' ?>><?= ucfirst(@$value->LName) . " ," . ucfirst(@$value->FName) ?><?= @$sewer->ID == @$value->ID ? " (Selected)" : '' ?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="">Layout Artist</label>
                <select class="custom-select custom-select-sm rounded-0 select_update" id="layout">
                    <option value="<?= @$lay_artist->ID ?>" selected><?= ucfirst(@$lay_artist->LName) . " ," . ucfirst(@$lay_artist->FName) ?></option>

                    <?php
                    foreach (@$users as $value) { ?>
                        <option value="<?= @$value->ID ?>" <?= @$lay_artist->ID == @$value->ID ? 'disabled class="text-bold text-danger"' : '' ?>><?= ucfirst(@$value->LName) . " ," . ucfirst(@$value->FName) ?><?= @$lay_artist->ID == @$value->ID ? " (Selected)" : '' ?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="">Setup Artist</label>
                <select class="custom-select custom-select-sm rounded-0 select_update" id="setup">
                    <option value="<?= @$set_artist->ID ?>" selected><?= ucfirst(@$set_artist->LName) . " ," . ucfirst(@$set_artist->FName) ?></option>

                    <?php
                    foreach (@$users as $value) { ?>
                        <option value="<?= @$value->ID ?>" <?= @$set_artist->ID == @$value->ID ? 'disabled class="text-bold text-danger"' : '' ?>><?= ucfirst(@$value->LName) . " ," . ucfirst(@$value->FName) ?><?= @$set_artist->ID == @$value->ID ? " (Selected)" : '' ?></option>
                    <?php }
                    ?>
                </select>
            </div>
        </div>
        <button type="button" class="btn btn-xs btn-primary btn-flat mt-2" id="update_dets" <?= @$session->Role == "Artist" ? 'disabled' : '' ?>>Update</button>
        <button type="button" class="btn btn-xs btn-danger btn-flat mt-2" id="cancel">Cancel</button>
        <button type="button" class="btn btn-xs btn-success btn-flat mt-2" data-oid="<?= @$order_dets->ID ?>" id="save_dets">Save</button>

        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="exampleInputFile">Mockup Design <span><button type="button" data-oid="<?= @$order_dets->ID ?>" id="view_mockup" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i></button></span></label>
                    <!-- Modal Mock Up Design-->
                    <div class="modal" tabindex="-1" role="dialog" id="view_modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Mockup Design</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <!-- ... -->
                                <div class="modal-body">
                                    <!-- Display the current mockup design -->
                                    <img id="mockupImage" src="<?php echo base_url(); ?>assets/uploaded/proofs/<?= @$mockup_img->Mockup_design ?>" alt="Mockup Design" class="img-fluid">
                                </div>

                                <div class="modal-footer">
                                    <!-- Add a button to view previous designs -->
                                    <button type="button" class="btn btn-secondary" id="view_previous_designs" data-toggle="modal" data-target="#previousDesignsModal">View Previous Designs</button>
                                </div>

                                <!-- Modal for viewing previous designs -->
                                <div class="modal" tabindex="-1" role="dialog" id="previousDesignsModal">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Previous Mockup Designs</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <style>
                                                    .gallery {
                                                        display: flex;
                                                        flex-wrap: wrap;
                                                        justify-content: center;
                                                        padding: 20px;
                                                    }

                                                    .gallery img {
                                                        margin: 10px;
                                                        cursor: pointer;
                                                        max-width: 300px;
                                                        width: 50%;
                                                        height: 50%;
                                                        border-radius: 10px;
                                                    }

                                                    /* Lightbox styles */
                                                    #lightbox {
                                                        display: none;
                                                        position: fixed;
                                                        top: 0;
                                                        left: 0;
                                                        width: 100%;
                                                        height: 100%;
                                                        background: rgba(0, 0, 0, 0.8);
                                                        justify-content: center;
                                                        align-items: center;
                                                        overflow: hidden;
                                                        flex-direction: column;
                                                    }

                                                    #lightbox img {
                                                        max-width: 80%;
                                                        max-height: 60vh;
                                                        box-shadow: 0 0 25px rgba(0, 0, 0, 0.8);
                                                        border-radius: 10px;
                                                    }

                                                    #close-btn {
                                                        position: absolute;
                                                        top: 10px;
                                                        right: 10px;
                                                        font-size: 24px;
                                                        color: #fff;
                                                        cursor: pointer;
                                                        z-index: 2;
                                                    }

                                                    /* Style for navigation buttons */
                                                    #prev-btn,
                                                    #next-btn {
                                                        position: absolute;
                                                        top: 50%;
                                                        transform: translateY(-50%);
                                                        font-size: 20px;
                                                        color: #fff;
                                                        background-color: rgba(0, 0, 0, 0.5);
                                                        border: none;
                                                        padding: 10px;
                                                        cursor: pointer;
                                                        transition: background-color 0.3s;
                                                    }

                                                    #prev-btn {
                                                        left: 10px;
                                                    }

                                                    #next-btn {
                                                        right: 10px;
                                                    }

                                                    #prev-btn:hover,
                                                    #next-btn:hover {
                                                        background-color: rgba(0, 0, 0, 0.8);
                                                    }

                                                    /* Styles for thumbnails */
                                                    .thumbnail-container {
                                                        display: flex;
                                                        flex-direction: row;
                                                        flex-wrap: wrap;
                                                        justify-content: center;
                                                    }

                                                    .thumbnail {
                                                        max-width: 50px;
                                                        width: 100px;
                                                        cursor: pointer;
                                                        margin-top: 40px;
                                                        margin-left: 5px;
                                                        margin-right: 5px;
                                                        border: 2px solid #fff;
                                                        transition: opacity 0.3s;
                                                    }

                                                    .thumbnail:hover,
                                                    .thumbnail.active-thumbnail {
                                                        opacity: 0.7;
                                                    }
                                                </style>

                                                <div class="gallery" onclick="openLightbox(event)">
                                                    <?php foreach (@$previousDesigns as $design) : ?>
                                                        <img src="<?php echo base_url(); ?>assets/uploaded/proofs/<?= @$design->Mockup_design ?>" alt="Previous Mockup Design" class="img-fluid">
                                                    <?php endforeach; ?>
                                                </div>

                                                <!-- Lightbox container -->
                                                <div id="lightbox">
                                                    <!-- Close button -->
                                                    <span id="close-btn" onclick="closeLightbox()">&times;</span>

                                                    <!-- Main lightbox image -->
                                                    <img id="lightbox-img" src="" alt="lightbox image">

                                                    <!-- Thumbnails container -->
                                                    <div id="thumbnail-container">
                                                        <!-- Thumbnails will be added dynamically using JavaScript -->
                                                    </div>

                                                    <!-- Previous and Next buttons -->
                                                    <button id="prev-btn" onclick="changeImage(-1)">&lt; Prev</button>
                                                    <button id="next-btn" onclick="changeImage(1)">Next &gt;</button>
                                                </div>
                                                <!-- Loop through the previous designs and display them -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ... -->

                            </div>
                        </div>
                    </div>
                    <div class="input-group input-group-xs">
                        <div class="custom-file">
                            <form id="uploadForm" enctype="multipart/form-data">
                                <input type="file" class="custom-file-input" name="files[]" id="modal_reqs" multiple>
                                <label class="custom-file-label" for="exampleInputFile">
                                    <?php if (@$mockup_img) : ?>
                                        <?= @$mockup_img->Mockup_design; ?>
                                    <?php else : ?>
                                        Choose file
                                    <?php endif; ?>
                                </label>
                            </form>
                        </div>
                        <input type="button" value="Upload Mockup" data-name="<?= @$order_dets->Cust_ID ?>" data-oid="<?= @$order_dets->ID ?>" class="btn btn-xs btn-success float-right" id="submit_req">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    // var role = "<?= @$session->Role ?>";
    //code for strpos version of php incase new types of artist are implemented
    function strpos(haystack, needle, offset) {
        var i = (haystack + '').indexOf(needle, (offset || 0));
        return i === -1 ? false : i;
    }
    // var x = 
    var role = strpos("<?= @$session->Role ?>", 'Artist');

    if (role == "Artist") {
        $("#update_dets").css("display", "none");
    }

    $("#cancel").css("display", "none");
    $("#save_dets").css("display", "none");
    // $("#load_order :input").prop("disabled", true);
    $("#load_order :input:not(:button):not(#modal_reqs)").prop("disabled", true);
    var currentIndex = 0;
    var images = document.querySelectorAll('.gallery img');
    var totalImages = images.length;

    // Open the lightbox
    function openLightbox(event) {
        if (event.target.tagName === 'IMG') {
            var clickedIndex = Array.from(images).indexOf(event.target);
            currentIndex = clickedIndex;
            updateLightboxImage();
            document.getElementById('lightbox').style.display = 'flex';
        }
    }

    // Close the lightbox
    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }

    // Change the lightbox image based on direction (1 for next, -1 for prev)
    function changeImage(direction) {
        currentIndex += direction;
        if (currentIndex >= totalImages) {
            currentIndex = 0;
        } else if (currentIndex < 0) {
            currentIndex = totalImages - 1;
        }
        updateLightboxImage();
    }

    // Update the lightbox image and thumbnails
    function updateLightboxImage() {
        var lightboxImg = document.getElementById('lightbox-img');
        var thumbnailContainer = document.getElementById('thumbnail-container');

        // Update the main lightbox image
        lightboxImg.src = images[currentIndex].src;

        // Clear existing thumbnails
        thumbnailContainer.innerHTML = '';

        // Add new thumbnails
        images.forEach((image, index) => {
            var thumbnail = document.createElement('img');
            thumbnail.src = image.src;
            thumbnail.alt = `Thumbnail ${index + 1}`;
            thumbnail.classList.add('thumbnail');
            thumbnail.addEventListener('click', () => updateMainImage(index));
            thumbnailContainer.appendChild(thumbnail);
        });

        // Highlight the current thumbnail
        var thumbnails = document.querySelectorAll('.thumbnail');
        thumbnails[currentIndex].classList.add('active-thumbnail');
    }

    // Update the main lightbox image when a thumbnail is clicked
    function updateMainImage(index) {
        currentIndex = index;
        updateLightboxImage();
    }

    // Add initial thumbnails
    updateLightboxImage();


    // To add keyboard navigation (left/right arrow keys)
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('lightbox').style.display === 'flex') {
            if (e.key === 'ArrowLeft') {
                changeImage(-1);
            } else if (e.key === 'ArrowRight') {
                changeImage(1);
            }
        }
    });
</script>