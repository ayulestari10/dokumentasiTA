<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Data Dokumen Tugas Akhir <!-- <button class="btn btn-success" data-toggle="modal" data-target="#add"><i class="fa fa-plus"></i></button> -->
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
						<table id="datatable" class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>NIM</th>
									<th>Nama</th>
									<th>Judul</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($dokumen as $row): ?>
								<tr>
									<td><?= $i ?></td>
									<td><?= $row->NIM ?></td>
									<td><?= $this->mahasiswa_m->get_row(['nim' => $row->NIM])->nama ?></td>
									<td><p style="text-align: justify;">
										<?=  $row->judulTA; ?>
									</p></td>
									<td id="btn-<?= $row->NIM?>">
                                      
                                      <?php if ($row->status == 'Terverifikasi'): ?>
                                        <button onclick="changeStatus('<?= $row->NIM ?>')" class="btn btn-success"><i class="fa fa-check"></i> Terverifikasi</button>
                                      <?php else: ?>
                                        <button onclick="changeStatus('<?= $row->NIM ?>')" class="btn btn-danger"><i class="fa fa-close"></i> Belum Terverifikasi</button>
                                      <?php endif; ?>
                                    </td>
                                    <td>
                                    	<a href="<?= base_url('admin/detail-dokumen/'.$row->NIM) ?>" class="btn btn-info"><i class="fa fa-info"></i> Detail</a>	
										<button class="btn btn-danger" onclick="delete_data('<?= $row->NIM ?>')"><i class="fa fa-trash"> Hapus</i></button>
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

</div>

            <script>
                $(document).ready(function() {
                    $('#dataTables-example').DataTable({
                        responsive: true
                    });
                });


                function delete_data(NIM) {
                    $.ajax({
                        url: '<?= base_url('admin/data-dokumen') ?>',
                        type: 'POST',
                        data: {
                            NIM: NIM,
                            delete: true
                        },
                        success: function() {
                            window.location = '<?= base_url('admin/data-dokumen') ?>';
                        }
                    });
                }

                function changeStatus(NIM) {
				    $.ajax({
				      url: '<?= base_url('admin/data-dokumen') ?>',
				      type: 'POST',
				      data: {
				        NIM: NIM,
				        status: true
				      },
				      success: function(response) {
				        $('#btn-' + NIM).html(response);
				      },
				      error: function (e) {
				        console.log(e.responseText);
				      }
				    });
				}
            </script>