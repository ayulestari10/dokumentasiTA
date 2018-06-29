<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Data Dokumen Tugas Akhir
				</h3>
			</div>
		</div>
	<div class="clearfix"></div>
	</div>

		<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-10 col-sm-10 col-xs-10 col-lg-10">
				<div class="x_panel">
					<div class="x_title">
						<div>
							<!-- <h2>Detail Data Dokumen Tugas Akhir</h2> -->
						</div>
					</div>
					<style type="text/css">.bverifikasi{color: #FF0000;}</style>
					<style type="text/css">.verifikasi{color: #0091FF;}</style>
					<div class="x_content">
						<div>
							<?= $this->session->flashdata('msg') ?>
						</div>
						<table id="datatable" class="table table-striped table-bordered table-hover">
							<tr>
								<th style="width: 180px">NIM</th>
								<td><?= $username ?></td>
							</tr>
							<tr>
								<th>Nama</th>
								<td><?= "$individu->nama" ?></td>
							</tr>
							<tr>
								<th>Jurusan</th>
								<td><?= "$individu->jurusan" ?></td>
							</tr>
							<tr>
								<th>Angkatan</th>
								<td><?= "$individu->angkatan" ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?= "$individu->email" ?></td>
							</tr>
							<tr>
								<th>Judul</th>
								<td><?= "$ta->judulTA" ?></td>
							</tr>
							<tr>
								<th>Konsentrasi</th>
								<td><?= "$ta->konsentrasi" ?></td>
							</tr>
							<tr>
								<th>Tahun Lulus</th>
								<td><?= "$ta->tahun_pembuatan" ?></td>
							</tr>
							<tr>
								<th>Dosen Pembimbing 1</th>
								<td><?php
									if ($dp1 == NULL)
										echo NULL;
								 	else
								 		echo "$dp1->nama" ?>
								</td>
							</tr>
							<tr>
								<th>Dosen Pembimbing 2</th>
								<td><?php
									if ($dp2 == NULL)
										echo NULL;
								 	else
								 		echo "$dp2->nama" ?>
								 </td>
							</tr>
							<tr>
								<th>Status</th>
								<?php if ($ta->status == 'Terverifikasi') {?>
								<td class="verifikasi"><?= "$ta->status" ?></td>
								<?php } else {?>
								<td class="bverifikasi"><?= "$ta->status" ?></td>
								<?php } ?>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-sm-2 col-xs-2">
				<?php if (file_exists('assets/File_TugasAkhir/'.$username.'.pdf')) { ?>
				<a href="<?= base_url('mahasiswa/download_file/'."$username")?>" class="btn btn-info btn-md">Unduh Berkas <i class="fa fa-download"></i></a>
				<?php } else { ?>
				<button class="btn btn-info btn-md" disabled>Unduh Berkas <i class="fa fa-download"></i></button>
				<?php } ?>
				
				<?php if($ta->judulTA != NULL && $ta->konsentrasi != NULL && $ta->tahun_pembuatan != NULL || $dp1 != NULL || $dp2 != NULL) {?>
				<button class="btn btn-danger btn-md" style="padding-bottom: 5px; padding-top: 5px; padding-right: 37px; padding-left: 37px;" onclick="delete_data(<?= $username ?>)">Hapus <i class="fa fa-trash"></i></button>
				<?php } else {?>
				<button class="btn btn-danger btn-md" style="padding-bottom: 5px; padding-top: 5px; padding-right: 37px; padding-left: 37px;" disabled>Hapus <i class="fa fa-trash"></i></button>
				<?php } ?>
			</div>
		</div>


		<style type="text/css">
			.abstrak{
				background: #fff;
				padding: 5%;
			}
			.konten_abstrak{
				text-align: justify;
			}
		</style>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 abstrak">
				<div class="text-center"><h3><strong>Abstrak</strong></h3></div>
				<hr>
				<div class="konten_abstrak">
					<p><?= "$ta->abstrak" ?></p>
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

        		function delete_data(id){
					swal({
					  title: 'Apakah anda yakin?',
					  text: 'Data tugas akhir tidak dapat dilihat kembali ! Data profil anda aman !',
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
					  		url: '<?= base_url('Mahasiswa/data_dokumen') ?>',
		                    type: 'POST',
		                    data: {
		                        id: id,
		                        delete: true
		                    },
		                    success: function() {
		                       window.location = '<?= base_url('Mahasiswa/data_dokumen') ?>';
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
          //           $.ajax({
          //               url: '<?= base_url('mahasiswa/data_dokumen') ?>',
          //               type: 'POST',
          //               data: {
          //                   username: username,
          //                   delete: true
          //               },
          //               success: function() {
          //                   window.location = '<?= base_url('mahasiswa/data_dokumen') ?>';
          //               }
          //           });
          //       }
            </script>