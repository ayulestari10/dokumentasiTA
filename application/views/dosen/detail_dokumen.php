<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3 class="page-header">Detail Data Dokumen Tugas Akhir
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
			<div class="col-md-10 col-sm-10 col-xs-10">
				<div class="x_panel">
					<div class="x_title">
						<div>
							<!-- <h2>Detail Data Dokumen Tugas Akhir</h2> -->
						</div>
						<!-- <ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
							<li><a class="close-link"><i class="fa fa-close"></i></a></li>
						</ul>
						<div class="clearfix"></div> -->
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
									<th>Tahun</th>
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
				<div class="text-center"><h3>Mengunduh Dokumen</h3></div>
				<a href="" class="btn btn-primary" style="margin-left: 5%;"> <i class="fa fa-file-pdf-o" style="font-size: 60px;"></i> Download</a>
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
					<p><?php echo $detail->abstrak; ?></p>
				</div>
			</div>

			<!-- <div class="col-md-12 col-sm-12 col-xs-12 abstrak">
				<object data="<?php echo base_url().$judulTA; ?>" type="application/pdf" width="100%" height="500px" style="margin-top: 3%">
                    <embed src="<?php echo base_url().$judulTA; ?>" type="application/pdf"></embed>
                </object>
			</div> -->

		</div>

	</div>


</div>