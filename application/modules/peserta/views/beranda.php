<div class="panel panel-default">
   <div class="panel-heading">
      Dashboard
   </div>
   <div class="panel-body">

     <?php if($biodata['status_akhir'] === 'diterima'){ ?>
       <div class="alert alert-success" role="alert">
         <h4 style="text-align:center">SELAMAT ! Anda lulus tahap Akhir seleksi beasiswa</h4>
         <!-- <h4 style="text-align:center">Silahkan download dan cetak bukti lulus tahap akhir seleksi yang telah kami kirimkan via email,<br /> atau download di <a href="<?php echo site_url('peserta/download-bukti-lulus-tahap-akhir')?>">sini</a></h4> -->
         <h4 style="text-align:center">Silahkan download dan cetak bukti lulus tahap akhir seleksi dengan menekan tombol "Cetak Bukti Lolos Tahap II"</a></h4>
       </div>
     <?php } ?>

     <?php if($biodata['status'] === 'diterima'){ ?>
       <div class="alert alert-info" role="alert">
         <h4 style="text-align:center">SELAMAT ! Anda lulus tahap seleksi berkas</h4>
         <!-- <h4 style="text-align:center">Silahkan download dan cetak bukti lulus tahap seleksi berkas yang telah kami kirimkan via email,<br /> atau download di <a href="<?php echo site_url('peserta/download-bukti-lulus-verifikasi')?>">sini</a></h4> -->
         <h4 style="text-align:center">Silahkan download dan cetak bukti lulus tahap seleksi berkas dengan menekan tombol "Cetak Bukti Lolos Tahap I"</a></h4>
       </div>
     <?php } ?>

     <?php if($biodata['status'] === 'ditolak'){ ?>
       <div class="alert alert-danger" role="alert">
         <h4 style="text-align:center">Maaf , Anda belum lulus seleksi beasiswa kali ini</h4>         
       </div>
     <?php } ?>



      <div class="panel panel-primary">
         <div class="panel-heading">
            <h3 class="panel-title">Biodata</h3>
         </div>
         <div class="panel-body">
           <form action="<?php echo site_url('peserta/update_biodata')?>" method="post" enctype="multipart/form-data">
             <div class="form-group">
               <label for="exampleInputEmail1">NIK (Nomor Induk kependudukan)</label>
               <input type="text" class="form-control" name="nik" placeholder="NIK (Nomor Induk Kependudukan)" value="<?php echo $biodata['nik']?>" required>
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">Email</label>
               <input type="email" class="form-control" name="email" placeholder="Alamat Email" value="<?php echo $biodata['email']?>" required>
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">Kabupaten / Kota</label>
               <input type="text" class="form-control" name="kab_kota"  placeholder="kabupaten / Kota" value="<?php echo $biodata['kab_kota']?>" required>
             </div>
             <div class="form-group">
               <label for="akreditasi">Akreditasi program studi</label>
               <select name="akreditasi" class="form-control" data-validation="required">
                 <option value="">Pilih akreditasi</option>
         <?php   $akreditasi = explode(',',$biodata['akreditasi_prog_studi']);
                 foreach ($akreditasi as $akr) { ?>
                 <option <?php echo $biodata['akreditasi'] === $akr ? 'selected' : ''?> value="<?php echo $akr;?>"><?php echo $akr;?></option>
         <?php   } ?>
               </select>
             </div>

            <div class="form-group">
              <label for="semester">Semester</label>
              <select name="semester" class="form-control" data-validation="required">
                <option value="">Pilih semester</option>
        <?php   $semester = explode(',',$biodata['semester_kategori']);
                foreach ($semester as $smt) { ?>
                <option <?php echo $biodata['semester'] === $smt ? 'selected' : ''?> value="<?php echo $smt;?>"><?php echo ucfirst(terbilang($smt));?></option>
        <?php   } ?>
              </select>
            </div>


             <div class="form-group">
               <label for="ip_semester">Index Prestasi (IP) Semester *</label>
         <?php if($biodata['strict_ip_minimal'] === 'N'){ ?>
               <input type="text" name="ip_semester" class="form-control" placeholder="Indeks Prestasi (IP) Semester" tabindex="6" data-validation="number" data-validation-allowing="range[1.0;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IP tidak valid" data-validation-help="pisahkan desimal dengan koma (',')" value="<?php echo str_replace('.',',',$biodata['ip_semester'])?>">
               <p class="help-block"><?php echo "* IP Semester minimal untuk beasiswa ini adalah " . $biodata['ip_minimal'] . " , namun jika anda memiliki prestasi non akademik, anda dapat memasukkan nilai dibawah itu (lihat persyaratan & ketentuan diatas)"?></p>
         <?php }else{ ?>
               <input type="text" name="ip_semester" class="form-control" placeholder="Indeks Prestasi (IP) Semester" tabindex="6" data-validation="number" data-validation-allowing="range[<?php echo $biodata['ip_minimal']?>;4.0],float" data-validation-decimal-separator="," data-validation-error-msg="Nilai IP tidak valid atau dibawah ketentuan" data-validation-help="pisahkan desimal dengan koma (',')" value="<?php echo str_replace('.',',',$biodata['ip_semester'])?>">
               <p class="help-block"><?php echo "* IP Semester minimal untuk beasiswa ini adalah " . $biodata['ip_minimal'] ?></p>
         <?php } ?>
             </div>
             <!-- <div class="form-group">
               <?php if(empty($biodata['file_foto'])){ ?>
               <img src="<?php echo site_url('uploads/foto/nofoto.jpg')?>" alt="No-Foto" height="42" width="42">
               <br />
               <?php }else{ ?>
               <a href="<?php echo site_url('uploads/foto/' . $biodata['file_foto'])?>" target="_blank">
                 <img src="<?php echo site_url('uploads/foto/' . $biodata['file_foto'])?>" alt="File foto" height="42" width="42">
               </a>
               <br />
               <?php } ?>

               <label for="exampleInputFile">File foto</label>
               <input type="file" name="file_foto" id="exampleInputFile">
               <p class="help-block">Ukuran maks. file :512KB ; Jenis file :jpg</p>
             </div> -->
             <button type="submit" class="btn btn-success">Simpan</button>
           </form>
         </div>
      </div>
      <div class="alert alert-success" role="alert">
        <h4>Informasi</h4>
        <ul>
          <li>Ekstensi file unggah yang diijinkan : zip;rar;jpg;pdf;doc;docx;xls;xlsx</li>
          <li>Besar file dokumen max 1 MBytes (1024 KB) </li>
          <li>Mohon lengkapi biodata diatas jika belum</li>
        </ul>
      </div>
      <?php if($biodata['status_pendaftaran'] !== 'buka'){ ?>
        <div class="alert alert-danger" role="alert">
          <h4>Upload berkas ditutup</h4>
          <strong>Batas waktu pengumpulan berkas telah terlampaui !</strong>
        </div>
      <?php } ?>

      <table class="table">
         <thead>
            <tr>
               <th>NO</th>
               <th>Dokumen Persyaratan</th>
               <th>Status Unggah</th>
               <th>Status Verifikasi</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $i = 1;
               foreach ($dokumen->result_array() as $jd) { ?>
            <?php if($jd['user_file_dokumen'] === 'belum' & $jd['verifikasi'] === '-'){ ?>
            <tr class="default">
               <?php }elseif($jd['user_file_dokumen'] !== 'belum' & $jd['verifikasi'] === 'belum'){ ?>
            <tr class="warning">
               <?php }else{ ?>
            <tr class="success">
               <?php } ?>
               <th scope="row"><?php echo $i?></th>
               <td>
                  <?php echo $jd['nama']?>
                  <?php if($jd['file_template'] !== 'none'){ ?>
                  <br /><a href="<?php echo site_url('uploads/' . $jd['file_template'])?>">Download template</a>
                  <?php } ?>
               </td>
               <td>
                  <?php if($jd['user_file_dokumen'] === 'belum'){ ?>
                  belum

                  <?php if($biodata['status_pendaftaran'] === 'buka'){ ?>
                  <form method="post" action="<?php echo site_url('peserta/upload_dokumen')?>" enctype="multipart/form-data">
                     <input type="hidden" name="jenis_dokumen_id" value="<?php echo $jd['id']?>"/>
                     <input name="file_dokumen" type="file" onchange="form.submit()" />
                  </form>
                  <?php } ?>

                  <?php }else{ ?>
                  <span class="label label-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;SUDAH</span> - <a href="<?php echo site_url('uploads/dokumen/' . $jd['user_file_dokumen'])?>?random=<?php echo date("YmdHis")?>" target="_blank">Lihat</a>

                  <?php if($biodata['status_pendaftaran'] === 'buka'){ ?>
                  <form  style="margin-top:10px" method="post" action="<?php echo site_url('peserta/upload_dokumen')?>" enctype="multipart/form-data">
                     <input type="hidden" name="jenis_dokumen_id" value="<?php echo $jd['id']?>"/>
                     <input name="file_dokumen" type="file" onchange="form.submit()" />
                  </form>
                  <?php } ?>

                  <?php } ?>
               </td>
               <td>
                 <?php if($jd['verifikasi'] === 'ditolak'){ ?>
                 <span class="label label-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>&nbsp;DITOLAK</span>
                 <?php }elseif($jd['verifikasi'] === 'diterima'){ ?>
                 <span class="label label-success"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;DITERIMA</span>
                 <?php }elseif($jd['verifikasi'] === 'pending'){ ?>
                 <span class="label label-warning"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"></span>&nbsp;MENUNGGU</span>
                 <?php }else{ ?>
                 -
                 <?php } ?>
               </td>
            </tr>
            <?php $i++;} ?>
         </tbody>
      </table>
   </div>
</div>
