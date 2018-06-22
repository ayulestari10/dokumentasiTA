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
								<tr>
									<th style="width: 180px">NIM</th>
									<td><?php echo $detail->nim; ?></td>
								</tr>
								<tr>
									<th>Nama</th>
									<td><?php echo $detail->nama; ?></td>
								</tr>
								<tr>
									<th>Jurusan</th>
									<td><?php echo $detail->jurusan; ?></td>
								</tr>
								<tr>
									<th>Email</th>
									<td><?php echo $detail->email; ?></td>
								</tr>
								<tr>
									<th>Judul</th>
									<td><?php echo $detail->judulTA; ?></td>
								</tr>
								<tr>
									<th>Konsentrasi</th><td><?php echo $detail->konsentrasi; ?></td>

								</tr>
								<tr>
									<th>Tahun Lulus</th>
									<td><?php echo $detail->tahun_pembuatan; ?></td>
								</tr>
								<tr>
									<th>Dosen Pembimbing1</th>
									<td><?php echo $dp1->nama; ?></td>
								</tr>
								<tr>
									<th>Dosen Pembimbing2</th>
									<td><?php echo $dp2->nama; ?></td>
								</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-sm-2 col-xs-2">
				<div class="text-center"><h3>Mengunduh Dokumen</h3></div>
				<a href="<?= base_url('Dosen/download/'."$detail->nim") ?>" class="btn btn-primary" style="margin-left: 5%;"> <i class="fa fa-file-pdf-o" style="font-size: 60px;"></i> Download</a>
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
					<p><?= "$detail->abstrak" ?></p>
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
            </script>

</body>
</html>