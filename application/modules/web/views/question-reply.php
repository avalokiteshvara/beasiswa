<div class="alert alert-info">
    <div class="row flex-column flex-sm-row">
        <div class="col-12 col-sm-3 order-0 order-sm-0"><b><span class="bi bi-person"></span> <?php echo $pertanyaan['nama'] ?></b><br><small> Ditulis: <?php echo $pertanyaan['inserted_at'] ?> </small></div>
        <div class="col-12 col-sm-9 order-1 order-sm-1">
            <p><?php echo $pertanyaan['topik'] ?></p>
        </div>
    </div>
</div>

<?php foreach ($tanggapan->result_array() as $t) { ?>
    <div class="alert alert-warning">
        <div class="row flex-column flex-sm-row">
            <div class="col-12 col-sm-3 order-0 order-sm-0"><b><span class="bi bi-person"></span> <?php echo $t['nama'] ?></b><br><small> Ditulis: <?php echo $t['inserted_at'] ?> </small></div>
            <div class="col-12 col-sm-9 order-1 order-sm-1">
                <p><?php echo $t['komentar'] ?></p>
            </div>
        </div>
    </div>
<?php } ?>