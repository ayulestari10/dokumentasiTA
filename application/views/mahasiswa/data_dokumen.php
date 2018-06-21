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
			<div class="col-md-10 col-sm-10 col-xs-10">
				<div class="x_panel">
					<div class="x_title">
						<div>
							<!-- <h2>Detail Data Dokumen Tugas Akhir</h2> -->
						</div>
					</div>
					<div class="x_content">
						<div>
							<?= $this->session->flashdata('msg') ?>
						</div>
						<table class="table table-striped table-bordered">
							<tr>
								<th style="width: 180px">NIM</th>
								<td><?= $this->session->userdata('username'); ?></td>
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
								<th>Tahun</th>
								<td><?= "$ta->tahun_pembuatan" ?></td>
							</tr>
							<tr>
								<th>Dosen Pembimbing 1</th>
								<td><?= "$dp1->nama" ?></td>
							</tr>
							<tr>
								<th>Dosen Pembimbing 2</th>
								<td><?= "$dp2->nama" ?></td>
							</tr>
							<tr>
								<th>Status</th>
								<td>Terverifikasi</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-sm-2 col-xs-2">
				<!-- <a href="<?= base_url('mahasiswa/detail-dokumen') ?>" class="btn btn-info"><i class="fa fa-info"></i> Info</a> -->
				<button type="button" class="btn btn-info btn-sm" onclick="download_file(<?= $this->session->userdata('username'); ?>)">Unduh Berkas<i class="fa fa-download"></i></button>
				<button type="button" class="btn btn-danger btn-circle" onclick="delete_data(<?= $this->session->userdata('username'); ?>)" >Hapus<i class="fa fa-trash"></i></button>					
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
		              title: 'Apakah Anda ingin menghapus data Tugas Akhir ?',
		              text: "File yang telah dihapus tidak dapat dikembalikan lagi!",
		              type: 'warning',
		              showCancelButton: true,
		              confirmButtonColor: '#3085d6',
		              cancelButtonColor: '#d33',
		              confirmButtonText: 'Yes',
		              cancelButtonText: 'Cancel',
		              confirmButtonClass: 'btn btn-success',
		              cancelButtonClass: 'btn btn-danger',
		              buttonsStyling: false,
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
		                       window.location = '<?= base_url('admin/data_dokumen') ?>';
		                    }
		                });
		              } 

		              else if (result.dismiss === 'cancel') {
		                swal(                   
		                  'Batal',
		                  'Data anda aman :)',
		                  'error'
		                )
		              }
		            })  
        		}

        		function download_file(nim){
                	window.location = '<?= base_url('Mahasiswa/download_file/') ?>' + nim;
            	}
            </script>