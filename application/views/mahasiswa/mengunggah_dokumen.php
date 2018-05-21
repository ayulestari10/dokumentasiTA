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
						<?= form_open('mahasiswa/mengunggah-dokumen') ?>
							<div>
								<div class="form-group">
									<label for="NIM">NIM <span class="required">*</span></label>
									<input type="text" class="form-control" name="nim" required>
								</div>
								<div class="form-group">
									<label for="Nama">Nama <span class="required">*</span></label>
									<input type="text" class="form-control" name="nama" required>
								</div>
								<div class="form-group">
									<label for="Jurusan">Jurusan <span class="required">*</span></label>
									<input type="text" class="form-control" name="jurusan" required>
								</div>
								<div class="form-group">
									<label for="Email">Email <span class="required">*</span></label>
									<input type="text" class="form-control" name="email" required>
								</div>
								<div class="form-group">
									<label for="Judul">Judul <span class="required">*</span></label>
									<textarea class="form-control" name="judul" required></textarea>
								</div>
								<div class="form-group">
									<label for="Konsentrasi">Konsentrasi <span class="required">*</span></label>
									<input type="text" class="form-control" name="konsentrasi" required>
								</div>
								<div class="form-group">
									<label for="Tahun">Tahun <span class="required">*</span></label>
									<input type="text" class="form-control" name="tahun" required>
								</div>
								<div class="form-group">
									<label for="Dosen Pembimbing 1">Dosen Pembimbing 1 <span class="required">*</span></label>
									<input type="text" class="form-control" name="dosen_pembimbing1" required>
								</div>
								<div class="form-group">
									<label for="Dosen Pembimbing 2">Dosen Pembimbing 2 <span class="required">*</span></label>
									<input type="text" class="form-control" name="dosen_pembimbing2" required>
								</div>
								<div class="form-group">
									<label for="Upload Dokumen">Unggah Dokumen <span class="required">* .pdf</span></label>
									<input type="file" name="upload" required>
								</div>
								<div class="form-group">
									<label for="Abstrak">Abstrak <span class="required">*</span></label>
									<textarea class="form-control" name="abstrak" required></textarea>
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

            <script>

                function get_data(id_user) {
                  $.ajax({
                      url: '<?= base_url('admin/user') ?>',
                      type: 'POST',
                      data: {
                          id_user: id_user,
                          get: true
                      },
                      success: function(response) {
                          response = JSON.parse(response);
                          $('#edit_username').val(response.username);
                          $('#edit_id_user').val(id_user);
                      },
                      error: function(e) {console.log(e.responseText);}
                  });
                }

                function delete_data(id_user) {
                    $.ajax({
                        url: '<?= base_url('admin/user') ?>',
                        type: 'POST',
                        data: {
                            id_user: id_user,
                            delete: true
                        },
                        success: function() {
                            window.location = '<?= base_url('admin/user') ?>';
                        }
                    });
                }
            </script>