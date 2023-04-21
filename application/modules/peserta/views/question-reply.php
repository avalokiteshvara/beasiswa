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
            <div class="col-12 col-sm-3 order-0 order-sm-0"><b><span class="bi bi-person"></span> <?php echo substr($t['nama'], 0, 8) . '***' ?></b><br><small> Ditulis: <?php echo $t['inserted_at'] ?> </small></div>
            <div class="col-12 col-sm-9 order-1 order-sm-1">
                <p><?php echo $t['komentar'] ?></p>
            </div>
        </div>
    </div>
<?php } ?>

<div class="alert alert-success" role="alert">
    Tambahkan tanggapan anda:
</div>
<form enctype="multipart/form-data" aria-label="form-pertanyaan" id="formAddReply" class="form" role="form" method="post" action="<?php echo site_url('peserta/questions-add-reply') ?>" accept-charset="UTF-8">
    <input type="hidden" name="pertanyaan_id" value="<?php echo $pertanyaan_id?>">
    
    <div class="form-group">
        <label class="sr-only" for="exampleInputPassword2" style="color:#333"></label>
        <textarea class="form-control" name="topik" rows="5" placeholder="Message" required=""></textarea>
    </div>

    <div class="my-3">
        <div class="loading" style="display: none; background: #fff; text-align: center;padding: 15px;">Loading</div>
        <div class="topicadd-error-message" style="display: none; color: #fff; background: #ed3c0d; text-align: left; padding: 15px; font-weight: 600;"></div>
        <div class="topicadd-sent-message" style="display: none; color: #fff; background: #0f5132; text-align: left; padding: 15px; font-weight: 600;">Your message has been sent. Thank you!</div>
    </div>

    <div class="form-group mt-3">
        <button type="submit" class="btn btn-primary btn-block" name="submit">Kirim</button>
    </div>
</form>
