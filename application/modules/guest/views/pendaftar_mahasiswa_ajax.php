<!-- slow
SELECT a.id,
       CONCAT('tr_', a.id) AS DT_RowId, a.nik,
         a.kategori_id,
  		 UPPER(a.nama_lengkap) AS nama_lengkap,
  		 UPPER(a.kab_kota) AS kab_kota,
  		 UPPER(a.jk) AS jk,
  		 UPPER(a.nama_lembaga) AS nama_lembaga,
  		 UPPER(a.program_studi) AS program_studi,
  		 a.akreditasi,
  		 a.semester,
  		 a.ip_semester,
  		 CONCAT(
         LPAD(CAST(COUNT(distinct b.id) AS UNSIGNED),2,'0') , '-',
         LPAD(CAST(COUNT(distinct c.id) AS UNSIGNED),2,'0') , '-',
         LPAD(CAST(COUNT(distinct d.id) AS UNSIGNED),2,'0')
  		 ) AS dokumen,
  		 a.status,
  		 a.status_akhir,
  		 a.email,
       date_format(a.created_at,'%d-%m-%Y %H:%i:%s') AS `tgl_daftar`
	FROM pendaftar a
	LEFT JOIN dokumen_pendaftar b ON a.id = b.pendaftar_id
	LEFT JOIN dokumen_pendaftar c ON a.id = c.pendaftar_id AND c.verifikasi = "diterima"
	LEFT JOIN dokumen_pendaftar d ON a.id = d.pendaftar_id AND d.verifikasi = "ditolak"
GROUP BY a.id
-->

<!-- optimized
SELECT a.id,
       CONCAT('tr_', a.id) AS DT_RowId, a.nik,
       a.kategori_id,
		 UPPER(a.nama_lengkap) AS nama_lengkap,
		 UPPER(a.kab_kota) AS kab_kota,
		 UPPER(a.jk) AS jk,
		 UPPER(a.nama_lembaga) AS nama_lembaga,
		 UPPER(a.program_studi) AS program_studi,
		 a.akreditasi,
		 a.semester,
		 a.ip_semester,

		 CONCAT(
		 	'upload:', CAST(IFNULL(b.cnt,0) AS CHAR), '-',
			'diterima:', CAST(IFNULL(c.cnt,0) AS CHAR), '-',
			'ditolak:', CAST(IFNULL(d.cnt,0) AS CHAR)
		 ) AS dokumen,
		 a.status,
		 a.email
	FROM pendaftar a
	LEFT JOIN (SELECT pendaftar_id , COUNT(DISTINCT id) AS cnt FROM dokumen_pendaftar GROUP BY pendaftar_id  ) b ON a.id = b.pendaftar_id
	LEFT JOIN (SELECT pendaftar_id , COUNT(DISTINCT id) AS cnt FROM dokumen_pendaftar WHERE verifikasi = 'diterima' GROUP BY pendaftar_id  ) c ON a.id = c.pendaftar_id
	LEFT JOIN (SELECT pendaftar_id , COUNT(DISTINCT id) AS cnt FROM dokumen_pendaftar WHERE verifikasi = 'ditolak' GROUP BY pendaftar_id  ) d ON a.id = d.pendaftar_id
GROUP BY a.id
-->
<style>
   .modal-dialog { width: 60%;  height: 60%; padding: 0; margin: 0; }
   .modal-content { height: 100%; min-height: 100%;  height: auto; border-radius: 0; }
   .modal .modal-body { /*max-height: 520px;*/ /*max-width: 900px;*/ overflow-y: auto; }
   .vertical-alignment-helper { display:table; height: 100%; width: 100%; pointer-events:none;   }
   .vertical-align-center { /* To center vertically */ display: table-cell; vertical-align: middle; pointer-events:none;  }
   .modal-content { width:inherit; height:inherit; margin: 0 auto; pointer-events:all; }
   img.displayed { display: block; margin-left: auto; margin-right: auto }
   div.dataTables_processing { z-index: 9999; }
</style>

<link href="https://cdn.datatables.net/fixedcolumns/3.2.2/css/fixedColumns.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/fixedcolumns/3.2.2/js/dataTables.fixedColumns.min.js"></script>
<div class="panel panel-default" id="panel_example">
   <div class="panel-heading">
      <?php echo $page_title?>
      <!-- Single button -->
      <div class="btn-group pull-right">
         <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Export Data<span class="caret"></span>
         </button>
         <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('guest/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/semua'))?>">Semua pendaftar (*.pdf)</a></li>
            <li><a href="<?php echo site_url('guest/export_data/' . base64url_encode('pdf/' . $this->uri->segment(3) . '/terpilih'))?>">Pendaftar diterima (*.pdf)</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo site_url('guest/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/semua'))?>">Semua pendaftar (*.xls)</a></li>
            <li><a href="<?php echo site_url('guest/export_data/' . base64url_encode('excel/' . $this->uri->segment(3) . '/terpilih'))?>">Pendaftar diterima (*.xls)</a></li>
            <!-- <li><a href="#">Something else here</a></li> -->
            <!-- <li role="separator" class="divider"></li>
               <li><a href="#">Separated link</a></li> -->
         </ul>
      </div>
   </div>
   <div class="panel-body">
      <table id="example" class="display nowrap" cellspacing="0" width="100%">
         <thead>
            <tr>
               <!-- <th></th> -->
               <!-- <th>NIK</th> -->
               <th>Nama Lengkap</th>
               <th>Kab / Kota</th>
               <th>Jenis Kelamin</th>
               <th>Perguruan Tinggi</th>
               <th>Program Studi</th>
               <th>Akreditasi</th>
               <th>Semester</th>
               <th>IP Semester</th>
               <th>Dokumen</th>
               <!-- <th>Status</th> -->
               <!--<th>Status Tahap Akhir</th>-->
               <!-- <th>Ubah Email</th> -->
               <!-- <th>Tgl Daftar</th> -->
               <!-- <th>Hapus</th> -->

            </tr>
         </thead>
         <tbody>

         </tbody>
      </table>
   </div>
</div>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
   <div class="vertical-alignment-helper">
      <div class="modal-dialog vertical-align-center">
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Detail Data Diri</h4>
            </div>
            <div class="modal-body">
               <form>
                 <img class="displayed" id="file_foto" src="" alt="" src="" width="170px" height="170px">
                  <div id="form-part">
                     <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" class="form-control" readonly>
                     </div>
                     <div class="form-group">
                        <label for="nama_lengkap">Nama lengkap (Beserta gelar jika ada)</label>
                        <input type="text" class="form-control" id="nama_lengkap">
                     </div>
                     <div class="form-group">
                        <label for="alamat_rumah">Alamat rumah</label>
                        <input type="text" class="form-control" id="alamat_rumah">
                     </div>
                     <div class="form-group">
                        <label for="jk">Jenis kelamin</label>
                        <input type="text" class="form-control" id="jk">
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="kota_lahir">Kota lahir</label>
                              <input type="text" id="kota_lahir" class="form-control">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="tgl_lahir">Tanggal lahir</label>
                              <input id="tgl_lahir" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="no_hp">Nomor handphone</label>
                              <input type="text" id="no_hp" class="form-control">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" id="email" class="form-control">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="nama_lembaga">Perguruan tinggi</label>
                        <input type="text" id="nama_lembaga" class="form-control">
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="program_studi">Program studi</label>
                              <input type="text" id="program_studi" class="form-control">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="akreditasi">Akreditasi</label>
                              <input type="text" class="form-control" id="akreditasi">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <label for="semester">Semester</label>
                              <input type="text" class="form-control" id="semester">
                           </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                           <div class="form-group">
                              <div class="form-group">
                                 <label for="ip_semester">Index Prestasi (IP) Semester</label>
                                 <input type="text" class="form-control" id="ip_semester">
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalDokumen" role="dialog">
   <div class="vertical-alignment-helper">
     <div class="vertical-align-center" style="width: 60%;  height: 80%; padding: 0; margin: 0;">
        <!-- Modal content-->
        <div class="modal-content" style="height: 60%; min-height: 80%;  height: auto; border-radius: 0; ">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Dokumen</h4>
            </div>
            <div class="modal-body" id="modalDokumenBody">

            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
         </div>
      </div>
   </div>
</div>

<script>

      function base64url_encode( data){
        var str = base64.encode(data);
        str = str.replace('+','-');
        str = str.replace('==','');

        return str.replace('/','_');
      }

      var datatable = $('#example').dataTable({
              "processing": true,
              "serverSide": true,
              "scrollX": true,
              "bSort" : true,
              "pageLength" : 10,
              "fixedColumns" : {
                leftColumns: 1
              },
              ajax: {
                "url"  : "<?php echo base_url(); ?>guest/pendaftar_ajax",
                "type" : "POST",
                "data" : {slug: "<?php echo $this->uri->segment(3)?>"}
              },

              "oLanguage": {
                 "sProcessing": "Memproses Data....."
               },

              "columns": [
                // { "data": "nik"},
                { "data": "nama_lengkap"},
                { "data": "kab_kota" },
                { "data": "jk" },
                { "data": "nama_lembaga" },
                { "data": "program_studi" },
                { "data": "akreditasi"},
                { "data": "semester"},
                { "data": "ip_semester"},
                { "data": "dokumen"}
              ],
               "columnDefs": [
                 {
                   //<a href="#" class="detail" id="1671070911900008" onclick="show_detail('1671070911900008')">BELA RONALDOE</a>
                   "render": function(data,type,row){
                     return '<a href="#" class="detail" id="' + row['nik'] + '" onclick="show_detail(\'' + row['nik'] + '\')">' + data +  '</a>';
                   },
                   "targets" : 0
                 },
                 {
                    "render": function(data,type,row){
                      var dok_count = data.split('-');
                      var jml_upload = '<span class="label label-default">' + dok_count[0] + '</span>&nbsp';
                      var jml_diterima = '<span class="label label-success">' + dok_count[1] + '</span>&nbsp';
                      var jml_ditolak = '<span class="label label-danger">' + dok_count[2] + '</span>';

                      if(dok_count[0] === '00'){
                        return '<span class="label label-default">Belum ada dokumen yang diunggah</span>';
                      }else{
                        return '<a onclick="load_dokumen(' + row['id'] +')" class="btn btn-default">' + jml_upload + jml_diterima + jml_ditolak + '</a>';
                      }

                    },
                    "targets" : 8
                 }

              ] ,
              "fnDrawCallback": function() {

              },
          });




    $('#example')
    .on( 'processing.dt', function ( e, settings, processing ) {
      //  $('#processingIndicator').css( 'display', processing ? 'block' : 'none' );
      if(processing){
        $('#panel_example').block( {
            message: "",
            css: { width: '100px', left:'50%' },
            centerX: false,
          });
      }else{
        $('#panel_example').unblock( { });
      }
    } )
    .dataTable();

    function load_dokumen(pendaftar_id){
      // alert(pendaftar_id);
      event.preventDefault();
      $.get( "<?php echo site_url('guest/load_dokumen')?>",
        {
          pendaftar_id: pendaftar_id,
          slug : base64url_encode('<?php echo $this->uri->segment(3)?>')
        }
      )
       .done(function( data ) {

         $('#modalDokumenBody').html( data );
         $('#modalDokumen').modal('show');
       })

    }


    function show_detail(nik) {
      //var nik = this.id;
      event.preventDefault();
      $.get( "<?php echo site_url('guest/pendaftar_details')?>", { nik: nik } )
       .done(function( data ) {
         $("#file_foto").attr("src","<?php echo base_url() . 'uploads/foto/'?>" + data.file_foto);
         $('#nik').val(data.nik);
         $('#nama_lengkap').val(data.nama_lengkap);
         $('#alamat_rumah').val(data.alamat_rumah);
         $('#jk').val(data.jk);
         $('#kota_lahir').val(data.kota_lahir);
         $('#tgl_lahir').val(data.tgl_lahir);
         $('#no_hp').val(data.no_hp);
         $('#email').val(data.email);
         $('#nama_lembaga').val(data.nama_lembaga);
         $('#program_studi').val(data.program_studi);
         $('#akreditasi').val(data.akreditasi);
         $('#semester').val(data.semester);
         $('#ip_semester').val(data.ip_semester);

         $('#myModal').modal('show');
       });
    };

    // $('#modalDokumen').on('hidden.bs.modal', function () {
    //   $('#example').DataTable().ajax.reload(null,false)
    // })

</script>
