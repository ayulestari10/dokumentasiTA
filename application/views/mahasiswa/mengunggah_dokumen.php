	<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Unggah Dokumen Tugas Akhir
				</h3>
			</div>
			<!-- <div class="title_right">
				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Go!</button>
						</span>
					</div>
				</div>
			</div> -->
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<div>
							<!-- <h2>Unggah Dokumen Tugas Akhir</h2> -->
						</div>
						<div class="clearfix"></div>
					</div>

					<style type="text/css">.required{color: #a94442;}</style>
					<div class="x_content">
						<div>
							<?= $this->session->flashdata('msg') ?>
						</div>
						<?= form_open_multipart('mahasiswa/unggah-dokumen') ?>
							<div>
								<div class="form-group">
									<label for="NIM">NIM <span class="required">*</span></label>
									<input type="text" value="<?= $this->session->userdata('username') ?>" class="form-control" name="nim" disabled>
								</div>
								<div class="form-group">
									<label for="Judul">Judul <span class="required">*</span></label>
									<textarea class="form-control" name="judul" required><?= $ta->judulTA ?></textarea>
								</div>
								<div class="form-group">
									<label for="Konsentrasi">Konsentrasi <?= $ta->konsentrasi ?> <span class="required">*</span></label>
									<?php 
										if($ta->konsentrasi == NULL){
											$opt_konsentrasi = ['' => 'Pilih Konsentrasi'];
		                                    foreach ( $konsentrasi as $row ) $opt_konsentrasi[$row] = $row;
		                                    echo form_dropdown( 'konsentrasi', $opt_konsentrasi, $ta->konsentrasi, [ 'id' => 'konsentrasi', 'class' => 'form-control' ] );
										}
										else{  
		                                    $opt_konsentrasi = [];
		                                    foreach ( $konsentrasi as $row ) $opt_konsentrasi[$row] = $row;
		                                    echo form_dropdown( 'konsentrasi', $opt_konsentrasi, $ta->konsentrasi, [ 'id' => 'konsentrasi', 'class' => 'form-control' ] );
		                                } 
		                            ?>
								</div>
								<div class="form-group">
									<label for="Tahun">Tahun<span class="required">*</span></label>
									<?php 
										if($ta->tahun_pembuatan == NULL){
											$opt_tahun = ['' => 'Pilih Tahun'];
		                                    foreach ( $tahun as $row ) $opt_tahun[$row] = $row;
		                                    echo form_dropdown( 'tahun', $opt_tahun, $ta->tahun_pembuatan, [ 'id' => 'tahun', 'class' => 'form-control' ] );
										}
										else{  
		                                    $opt_tahun = [];
		                                    foreach ( $tahun as $row ) $opt_tahun[$row] = $row;
		                                    echo form_dropdown( 'tahun', $opt_tahun, $ta->tahun_pembuatan, [ 'id' => 'tahun', 'class' => 'form-control' ] );
		                                } 
		                            ?>
								</div>
								<div class="form-group">
									<label for="Dosen Pembimbing 1">Dosen Pembimbing 1 <span class="required">*</span></label>
									<?php if($ta->dosen_pembimbing1 == NULL): ?>
										<?php  
		                                    $opt_dosen_1 = ['' => 'Pilih Dosen Pembimbing 1'];
		                                    foreach ( $dosen as $row ) $opt_dosen_1[$row->NIP] = $row->nama;
		                                    echo form_dropdown( 'dosen_pembimbing1', $opt_dosen_1, $ta->dosen_pembimbing1, [ 'id' => 'dosen_1', 'class' => 'form-control' ] );
		                                ?>
									<?php else: ?>
									<?php  
	                                    $opt_dosen1 = [];
	                                    foreach ( $dosen as $row ) $opt_dosen1[$row->NIP] = $row->nama;
	                                    echo form_dropdown( 'dosen_pembimbing1', $opt_dosen1, $ta->dosen_pembimbing1, [ 'id' => 'dosen1', 'class' => 'form-control' ] );
	                                ?>
		                            <?php endif; ?>
								</div>
								<div class="form-group">
									<label for="Dosen Pembimbing 2">Dosen Pembimbing 2 <span class="required">*</span></label>
									<?php if($ta->dosen_pembimbing2 == NULL): ?>
										<?php  
		                                    $opt_dosen_2 = ['' => 'Pilih Dosen Pembimbing 2'];
		                                    foreach ( $dosen as $row ) $opt_dosen_2[$row->NIP] = $row->nama;
		                                    echo form_dropdown( 'dosen_pembimbing2', $opt_dosen_2, $ta->dosen_pembimbing2, [ 'id' => 'dosen_2', 'class' => 'form-control' ] );
		                                ?>
									<?php else: ?>
									<?php  
	                                    $opt_dosen2 = [];
	                                    foreach ( $dosen as $row ) $opt_dosen2[$row->NIP] = $row->nama;
	                                    echo form_dropdown( 'dosen_pembimbing2', $opt_dosen2, $ta->dosen_pembimbing2, [ 'id' => 'dosen2', 'class' => 'form-control' ] );
	                                ?>
		                            <?php endif; ?>
								</div>
								<div class="form-group">
									<label for="Upload Dokumen">Unggah Dokumen <span class="required">* .pdf</span></label>
									<?php if(!file_exists('assets/File_TugasAkhir/'.$this->session->userdata('username').'.pdf')): ?>
									<input type="file" name="upload" required>
									<?php else: ?>
									<input type="file" name="upload">
									<?php endif; ?>
								</div>
								<div class="form-group">
									<label for="Abstrak">Abstrak <span class="required">*</span></label>
									<textarea class="form-control" name="abstrak" required><?= $ta->abstrak ?></textarea>
								</div>

								<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
							</div>
						<?= form_close() ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	
</div>

<script type="text/javascript">
	$(document).ready(function(){

		  let opt = <?= json_encode($ta->dosen_pembimbing1 ? $opt_dosen1 : $opt_dosen_1) ?>;
		  let keys = Object.keys(opt);
		  
		  $('#dosen1').on('change', function() {
		   let dosen1 = $(this).val();
		   let dosen2 = $('#dosen2').val();
		   let html = '';
		   for (let i = 0; i < keys.length; i++) {
		    if (dosen1 != keys[i] && dosen2 != keys[i]) {
		     html += '<option value="' + keys[i] + '">' + opt[keys[i]] + '</option>';
		    }
		   }
		   $('#dosen2')
		    .html('<option value="' + dosen2 + '">' + opt[dosen2] + '</option>')
		    .append(html);
		  });

		  $('#dosen2').on('change', function() {
		   let dosen2 = $(this).val();
		   let dosen1 = $('#dosen1').val();
		   let html = '';
		   for (let i = 0; i < keys.length; i++) {
		    if (dosen1 != keys[i] && dosen2 != keys[i]) {
		     html += '<option value="' + keys[i] + '">' + opt[keys[i]] + '</option>';
		    }
		   }
		   $('#dosen1')
		    .html('<option value="' + dosen1 + '">' + opt[dosen1] + '</option>')
		    .append(html);
		  });
	});

</script>