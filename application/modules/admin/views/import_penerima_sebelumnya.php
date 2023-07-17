<div class="card border-primary shadow">
	<div class="card-header bg-primary text-white mb-3">
		Import Data
	</div>
	<div class="card-body">
		<!-- <div class="alert alert-success">Pada form ini anda bisa melakukan import data sesuai dengan contoh format file excel dibawah ini<br>
			<a href="<?php echo base_URL() . 'uploads/data_penerima.xls' ?>">Download Format File</a>
		</div> -->
		<form action="<?php echo site_url('admin/import-penerima-sebelumnya'); ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
			<input type="hidden" name="upload_me" value="">
			<div class="form-group">
				<label for="exampleInputFile">File Data</label>
				<input type="file" id="exampleInputFile" name="userfile">
				<p class="help-block">File berisi data penerima beasiswa sebelumnya</p>
			</div>

			<button type="submit" class="btn btn-success">Import</button>
		</form>
	</div>
</div>

