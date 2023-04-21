<div class="card mt-2">
    <div class="card-header">
        Dokumen
    </div>
    <div class="card-body">
        <div class="alert alert-success mt-2" role="alert">
            <h4>Informasi</h4>
            <ul>
                <li>Ekstensi file unggah yang diijinkan : Arsip(zip;rar) - Gambar(jpg;png;bmp) - Dokumen(pdf;doc;docx;xls;xlsx)</li>
                <li>Besar file max 1 MBytes (1024 KB) </li>
                <li>Anda dapat memperbaiki berkas yang sudah terupload dengan mengupload kembali berkas yang baru (Berkas lama otomatis akan tertimpa)</li>
                <li>Mohon lengkapi biodata diatas jika belum</li>
            </ul>
        </div>

        <?php if ($biodata['status_pendaftaran'] !== 'buka') { ?>
            <div class="alert alert-danger" role="alert">
                <h4>Upload berkas ditutup</h4>
                <strong>Batas waktu pengumpulan berkas telah terlampaui !</strong>
            </div>
        <?php } ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Dokumen</th>
                        <th>Unggah</th>
                        <th>Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($dokumen->result_array() as $jd) { ?>
                        <?php if ($jd['user_file_dokumen'] === 'belum' & $jd['verifikasi'] === '-') { ?>
                            <tr class="table-default" id="tr_<?php echo $i ?>" data-bs-toggle="collapse" data-bs-target="#r<?php echo $i ?>">
                            <?php } elseif ($jd['user_file_dokumen'] !== 'belum' & $jd['verifikasi'] === 'belum') { ?>
                            <tr class="table-warning" id="tr_<?php echo $i ?>" data-bs-toggle="collapse" data-bs-target="#r<?php echo $i ?>">
                            <?php } else { ?>
                            <tr class="table-success" id="tr_<?php echo $i ?>" data-bs-toggle="collapse" data-bs-target="#r<?php echo $i ?>">
                            <?php } ?>

                            <th scope="row"><?php echo $i ?></th>
                            <td>
                                <?php echo $jd['nama'] ?>
                                <?php if ($jd['file_template'] !== 'none') { ?>
                                    <br /><a href="<?php echo site_url('uploads/' . $jd['file_template']) ?>">Download template</a>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($jd['user_file_dokumen'] === 'belum') { ?>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-hourglass-split" aria-hidden="true"></i>
                                        &nbsp;Belum diunggah
                                    </span>

                                    <?php if ($biodata['status_pendaftaran'] === 'buka') { ?>
                                        <form class="mt-2" method="post" action="<?php echo site_url('peserta/upload_dokumen') ?>" enctype="multipart/form-data">
                                            <input type="hidden" name="jenis_dokumen_id" value="<?php echo $jd['id'] ?>" />
                                            <input name="file_dokumen" type="file" onchange="form.submit()" />
                                        </form>
                                    <?php } ?>

                                <?php } else { ?>

                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1" aria-hidden="true"></i>
                                        &nbsp;Sudah diunggah
                                    </span> -
                                    <a href="<?php echo site_url('uploads/dokumen/' . $jd['user_file_dokumen']) ?>?random=<?php echo date("YmdHis") ?>" target="_blank">Lihat</a>

                                    <?php if ($biodata['status_pendaftaran'] === 'buka') { ?>
                                        <form style="margin-top:10px" method="post" action="<?php echo site_url('peserta/upload_dokumen') ?>" enctype="multipart/form-data">
                                            <input type="hidden" name="jenis_dokumen_id" value="<?php echo $jd['id'] ?>" />
                                            <input name="file_dokumen" type="file" onchange="form.submit()" />
                                        </form>
                                    <?php } ?>

                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($jd['verifikasi'] === 'ditolak') { ?>
                                    <span class="badge bg-danger"><i class="bi bi-x-circle" aria-hidden="true"></i>&nbsp;DITOLAK <i class="bi bi-chevron-down"></i></span>
                                <?php } elseif ($jd['verifikasi'] === 'diterima') { ?>
                                    <span class="badge bg-success"><i class="bi bi-check-lg" aria-hidden="true"></i>&nbsp;DITERIMA</span>
                                    <script>
                                        const trElement = document.querySelector('#tr_<?php echo $i ?>');
                                        trElement.removeAttribute('data-bs-toggle');
                                    </script>
                                <?php } elseif ($jd['verifikasi'] === 'pending') { ?>
                                    <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split" aria-hidden="true"></i>&nbsp;MENUNGGU</span>
                                    <script>
                                        const trElement = document.querySelector('#tr_<?php echo $i ?>');
                                        trElement.removeAttribute('data-bs-toggle');
                                    </script>
                                <?php } else { ?>
                                    <div>-</div>
                                    <script>
                                        const trElement = document.querySelector('#tr_<?php echo $i ?>');
                                        trElement.removeAttribute('data-bs-toggle');
                                    </script>
                                <?php } ?>
                            </td>
                            </tr>

                            <?php if ($jd['verifikasi'] === 'ditolak') { ?>

                                <tr class="collapse accordion-collapse show table-danger" id="r<?php echo $i; ?>" data-bs-parent=".table">
                                    <td colspan="4" class="link-danger text-center">Alasan penolakan: <?php echo $jd['alasan']; ?></td>
                                </tr>

                            <?php } ?>


                        <?php $i++;
                    } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>