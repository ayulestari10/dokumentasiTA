<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Data Dosen <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button>
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
							<h2>Data Dosen</h2>
						</div>
						<ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div>
							<?= $this->session->flashdata('msg') ?>
						</div>
						<table width="100%" id="dataTables-example"class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Username</th>
									<th>Nama</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($dosen as $row): ?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $row->username ?></td>
									<td><?= $this->dosen_m->get_row(['NIP' => $row->username])->nama ?></td>
									<td>
										<button class="btn btn-primary" data-toggle="modal" data-target="#edit" onclick="get_data('<?= $row->username ?>')"><i class="fa fa-pencil-square"> Edit</i></button>
										<button class="btn btn-danger" onclick="delete_data('<?= $row->username ?>')"><i class="fa fa-trash"> Hapus</i></button>
									</td>
								</tr>
								<?php $i++; endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<style type="text/css">.required{color: #a94442;}</style>
	<div class="modal fade" tabindex="-1" role="dialog" id="add">
		<div class="modal-dialog" role="document">
			<?= form_open_multipart('admin/tambah-dosen') ?>
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Data Dosen</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="Username">Username <span class="required">* NIP/NIPUS</span></label>
						<input type="text" class="form-control" name="username" required>
					</div>
					<div class="form-group">
						<label for="Nama">Nama <span class="required">*</span></label>
						<input type="text" class="form-control" name="nama" required>
					</div>
					<div class="form-group">
						<label for="Password">Password <span class="required">*</span></label>
						<input type="password" class="form-control" name="password1" required>
					</div>
					<div class="form-group">
						<label for="Konfirmasi Password">Konfirmasi Password <span class="required">*</span></label>
						<input type="password" class="form-control" name="password2" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
				<?= form_close() ?>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" tabindex="-1" role="dialog" id="edit">
		<div class="modal-dialog" role="document">
			<?= form_open('admin/edit-dosen') ?>
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Data Dosen</h4>
				</div>
				<input type="hidden" name="username_lama" id="edit_username_lama_hidden">
				<div class="modal-body">
					<div class="form-group">
						<label for="Username">Username <span class="required">* NIP/NIPUS</span></label>
						<input type="text" class="form-control" name="edit_username" id="edit_username_lama" disabled>
					</div>
					<div class="form-group">
						<label for="Nama">Nama <span class="required">*</span></label>
						<input type="text" class="form-control" name="edit_nama" id="edit_nama" required>
					</div>
					<div class="form-group">
						<label for="Password">Password <span class="required">*</span></label>
						<input type="password" class="form-control" name="password1" required>
					</div>
					<div class="form-group">
						<label for="Konfirmasi Password">Konfirmasi Password <span class="required">*</span></label>
						<input type="password" class="form-control" name="password2" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" name="edit" value="Edit" class="btn btn-primary">
				</div>
				<?= form_close() ?>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

</div>

            <script>
            	
                $(document).ready(function() {
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });

                function get_data(username) {

                  $.ajax({
                      url: '<?= base_url('admin/data-dosen') ?>',
                      type: 'POST',
                      data: {
                          username: username,
                          get: true
                      },
                      success: function(response) {
                      		console.log(response);
                          response = JSON.parse(response);
                          $('#edit_username_lama, #edit_username_lama_hidden').val(response.nip);
                          $('#edit_nama').val(response.nama);
                      },
                      error: function(e) {console.log(e.responseText);}
                  });
                }

                function delete_data(id){
					swal({
					  title: 'Apakah anda yakin?',
					  text: 'Data mahasiswa tidak dapat dilihat kembali !',
					  type: 'warning',
					  showCancelButton: true,
					  confirmButtonText: 'Hapus',
					  cancelButtonText: 'Batal',
					  cancelButtonColor: '#d33',
					  confirmButtonClass: 'btn btn-success',
					  cancelButtonClass: 'btn btn-danger',
					  reverseButtons: true
					}).then((result) => {
					  if (result.value) {
					  	$.ajax({
					  		url: '<?= base_url('admin/data-dosen') ?>',
		                    type: 'POST',
		                    data: {
		                        id: id,
		                        delete: true
		                    },
		                    success: function() {
		                       window.location = '<?= base_url('admin/data-dosen') ?>';
		                    }
					  	});
					  } else if (result.dismiss === 'cancel') {
					    swal(
					      'Batal',
					      'Data aman :)',
					      'error'
					    )
					  }
					})  
        		}
                
                // function delete_data(username) {
                //     $.ajax({
                //         url: '<?= base_url('admin/data-dosen') ?>',
                //         type: 'POST',
                //         data: {
                //             username: username,
                //             delete: true
                //         },
                //         success: function() {
                //             window.location = '<?= base_url('admin/data-dosen') ?>';
                //         }
                //     });
                // }
            </script>