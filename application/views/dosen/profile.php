	<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Profile
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
						<?= form_open_multipart('dosen/profile') ?>
							<div>
								<input type="hidden" name="nip" value="<?= $data->NIP ?>">
								<div class="form-group">
									<label for="NIP">NIP</label>
									<input type="text" value="<?= $data->NIP ?>" class="form-control" disabled>
								</div>
								<div class="form-group">
									<label for="Nama">Nama <span class="required">*</span></label>
									<input type="text" class="form-control" name="nama" value="<?= $data->nama ?>" required>
								</div>
								<div class="form-group">
									<label for="Email">Email <span class="required">*</span></label>
									<input type="text" class="form-control" name="email" value="<?= $data->email ?>" required>
								</div>
								<div class="form-group">
									<label for="Alamat">Alamat <span class="required">*</span></label>
									<textarea class="form-control" name="alamat" required><?= $data->alamat ?></textarea>
								</div>
								<div class="form-group">
									<label for="Foto">Unggah Foto <span class="required">*</span></label><br>
									<img src="<?= base_url('assets/foto/dosen/'.$username.'.jpg') ?>" alt="User" onerror='src="<?= base_url('assets/production/') ?>images/img.jpg"' style="width: 200px; height: 250px;">
									<input type="file" name="foto">
								</div>

								<div style="margin-top: 3%;">
									<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
								</div>
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