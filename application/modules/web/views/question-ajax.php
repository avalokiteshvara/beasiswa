<!-- Display posts list -->
<?php if (!empty($questions)) {
    foreach ($questions as $question) { ?>
        <div class="list-item">
            <div class="card row-hover pos-relative py-3 px-3 mb-3 border-primary border-top-0 border-right-0 border-bottom-0 rounded-0">
                <div class="row align-items-center">
                    <div class="col-md-8 mb-3 mb-sm-0">
                        <h5> <a data-bs-toggle="modal" data-param="<?php echo $question['id'] ?>" data-bs-target="#pertanyaanModal" href="#" class="text-primary"><?php echo $question['topik'] ?></a></h5>
                        <p class="text-sm"><span class="op-6">diposting</span> <a class="text-black" href="#"><?php echo nicetime($question['inserted_at']) ?></a> <span class="op-6">oleh</span> <a class="text-black" href="#"><?php echo $question['nama'] ?></a></p>

                    </div>
                    <div class="col-md-4 op-7">
                        <div class="row text-center op-7">
                            <div class="col px-1"> <i class="ion-ios-chatboxes-outline icon-1x"></i> <span class="d-block text-sm">
                                    <?php echo get_comment_reply_count($question['id'])?> Tanggapan
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} else { ?>
    <p>Pertanyaan tidak ditemukan...</p>
<?php } ?>

<!-- Render pagination links -->
<?php echo $this->ajax_pagination->create_links(); ?>