<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Detail Data Dokumen Tugas Akhir
				</h3>
			</div>

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
							<thead>
								<tr>
									<th>NIM</th>
									<th>Nama</th>
									<th>Jurusan</th>
									<th>Email</th>
									<th>Judul</th>
									<th>Konsentrasi</th>
									<th>Tahun Lulus</th>
									<th>Dosen Pembimbing1</th>
									<th>Dosen Pembimbing2</th>
								</tr>
							</thead>

							<tbody>
								<td><?php echo $detail->nim; ?></td>
								<td><?php echo $detail->nama; ?></td>
								<td><?php echo $detail->jurusan; ?></td>
								<td><?php echo $detail->email; ?></td>
								<td><?php echo $detail->judulTA; ?></td>
								<td><?php echo $detail->konsentrasi; ?></td>
								<td><?php echo $detail->tahun_pembuatan; ?></td>
								<td><?php echo $dp1->nama; ?></td>
								<td><?php echo $dp2->nama; ?></td>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-sm-2 col-xs-2">
				<a href="<?= base_url('mahasiswa/download_file/'."$username")?>" class="btn btn-info btn-sm">Unduh Berkas <i class="fa fa-download"></i></a>
				<button class="btn btn-danger btn-circle" style="padding-bottom: 5px; padding-top: 5px; padding-right: 27px; padding-left: 27px;" onclick="delete_data(<?= $username ?>)">Hapus <i class="fa fa-trash"></i></button>
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
		              title: 'Hapus data tugas akhir ?',
		              text: "File yang telah dihapus tidak dapat dikembalikan lagi !",
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
		                       window.location = '<?= base_url('Mahasiswa/data_dokumen') ?>';
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
            </script>

</body>
</html>