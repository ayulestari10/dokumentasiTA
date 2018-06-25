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
							<tr>
								<th>NIM</th>
								<td><?= $dokumen->NIM ?></td>
							</tr>
							<tr>
								<th>Nama</th>
								<td><?= $this->mahasiswa_m->get_row(['nim' => $dokumen->NIM])->nama ?></td>
							</tr>
							<tr>
								<th>Jurusan</th>
								<td><?= $this->mahasiswa_m->get_row(['nim' => $dokumen->NIM])->jurusan ?></td>
							</tr>
							<tr>
								<th>Angkatan</th>
								<td><?= $this->mahasiswa_m->get_row(['nim' => $dokumen->NIM])->angkatan ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?= $this->mahasiswa_m->get_row(['nim' => $dokumen->NIM])->email ?></td>
							</tr>
							<tr>
								<th>Alamat</th>
								<td><?= $this->mahasiswa_m->get_row(['nim' => $dokumen->NIM])->alamat ?></td>
							</tr>
							<tr>
								<th>Judul</th>
								<td><?= $dokumen->judulTA ?></td>
							</tr>
							<tr>
								<th>Konsentrasi</th>
								<td><?= $dokumen->konsentrasi ?></td>
							</tr>
							<tr>
								<th>Tahun Pembuatan</th>
								<td><?= $dokumen->tahun_pembuatan ?></td>
							</tr>
							<tr>
								<th>Dosen Pembimbing</th>
								<?php if(isset($dokumen->dosen_pembimbing1, $dokumen->dosen_pembimbing2)): ?>
									<td><?= $this->dosen_m->get_row(['NIP' => $dokumen->dosen_pembimbing1])->nama ?> dan <?= $this->dosen_m->get_row(['NIP' => $dokumen->dosen_pembimbing2])->nama ?></td>
								<?php else: ?>
									<td>Belum ada</td>
								<?php endif; ?>
							</tr>
							<tr>
								<th>Status</th>
								<td><?= $dokumen->status ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-sm-2 col-xs-2">
				<div class="text-center"><h3>Mengunduh Dokumen</h3></div>
				<a href="<?= base_url('admin/download/'. $dokumen->NIM) ?>" class="btn btn-primary" style="margin-left: 5%;"> <i class="fa fa-file-pdf-o" style="font-size: 60px;"></i> Download</a>
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
					<p><?= $dokumen->abstrak ?></p>
				</div>
			</div>
		</div>

	</div>


</div>