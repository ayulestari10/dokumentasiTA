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
	                                    $opt = [];
	                                    foreach ( $konsentrasi as $row ) $opt[$row] = $row;
	                                    echo form_dropdown( 'konsentrasi', $opt, $ta->konsentrasi, [ 'id' => 'konsentrasi', 'class' => 'form-control' ] );
	                                ?>
									<!-- <select name="konsentrasi" class="form-control">
					                  <option value="Kecerdasan Buatan">Kecerdasan Buatan</option>
					                  <option value="Basis Data">Basis Data</option>
					                  <option value="Pengolahan Citra">Pengolahan Citra</option>
					                </select> -->
								</div>
								<div class="form-group">
									<label for="Tahun">Tahun<span class="required">*</span></label>
									<?php  
	                                    $opt = [];
	                                    foreach ( $tahun as $row ) $opt[$row] = $row;
	                                    echo form_dropdown( 'tahun', $opt, $ta->tahun_pembuatan, [ 'id' => 'tahun', 'class' => 'form-control' ] );
	                                ?>
								</div>
								<div class="form-group">
									<label for="Dosen Pembimbing 1">Dosen Pembimbing 1 <span class="required">*</span></label>
									<!-- <?php  
	                                    $opt = [];
	                                    foreach ( $dosen1 as $row ) $opt[$row->NIP] = $row->nama;
	                                    echo form_dropdown( 'dosen_pembimbing1', $opt, $ta->dosen_pembimbing1, [ 'id' => 'dosen_pembimbing1', 'class' => 'form-control' ] );
	                                ?> -->
									<select name="dosen_pembimbing1" class="form-control">
										<option value="<?= $ta->dosen_pembimbing1 ?>"> <?= $this->dosen_m->get_row(['NIP' => $ta->dosen_pembimbing1])->nama ?> </option>
					                	<?php foreach($dosen as $row): ?>
					                	<option value="<?= $row->NIP ?>"> <?= $row->nama ?> </option>
					              		<?php endforeach; ?>
					                </select>
								</div>
								<div class="form-group">
									<label for="Dosen Pembimbing 2">Dosen Pembimbing 2 <span class="required">*</span></label>
									<!-- <?php  
	                                    $opt = [];
	                                    foreach ( $dosen2 as $row ) $opt[$row->NIP] = $row->nama;
	                                    echo form_dropdown( 'dosen_pembimbing2', $opt, $ta->dosen_pembimbing2, [ 'id' => 'dosen_pembimbing2', 'class' => 'form-control' ] );
	                                ?> -->
									<select name="dosen_pembimbing2" class="form-control">
										<option value="<?= $ta->dosen_pembimbing2 ?>">  <?= $this->dosen_m->get_row(['NIP' => $ta->dosen_pembimbing2])->nama ?> </option>
					                	<?php foreach($dosen as $row): ?>
					                	<option value="<?= $row->NIP ?>"> <?= $row->nama ?> </option>
					              		<?php endforeach; ?>
					                </select>
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