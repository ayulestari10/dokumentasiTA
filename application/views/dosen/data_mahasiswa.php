<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Data Dokumen Tugas Akhir
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
		
	</div>

		<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<div>
							<!-- <h2>Data Dokumen Tugas Akhir</h2> -->
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
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>No</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Judul</th>
									<th>Tahun</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($data_mhs as $key) {
								 ?>
								<tr>
									<td>1</td>
									<td><?= $key->NIM ?></td>
									<td><?= $key->nama ?></td>
									<td style="text-align: justify; width: 200px;"><?= $key->JudulTA ?></td>
									<td><?= $key->tahun_pembuatan ?></td>
									<td>
										<a href="<?= base_url('dosen/detail-dokumen') ?>" class="btn btn-info"><i class="fa fa-info"></i> Info</a>
									</td>
								</tr>
								<?php 
									}
								 ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

            <script>
                $(document).ready(function() {
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });

                function delete_data(id_user) {
                    $.ajax({
                        url: '<?= base_url('mahasiswa/user') ?>',
                        type: 'POST',
                        data: {
                            id_user: id_user,
                            delete: true
                        },
                        success: function() {
                            window.location = '<?= base_url('mahasiswa/user') ?>';
                        }
                    });
                }
            </script>