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
								<th>Tahun Lulus</th>
								<td><?= $dokumen->tahun_pembuatan ?></td>
							</tr>
							<tr>
								<th>Dosen Pembimbing 1</th>
								<td>
								<?php
									if ($dp1 == NULL)
										echo NULL;
								 	else
								 		echo "$dp1->nama"
								?>
								</td>
							</tr>
							<tr>
								<th>Dosen Pembimbing 2</th>
								<td>
								<?php
									if ($dp2 == NULL)
										echo NULL;
								 	else
								 		echo "$dp2->nama"
								?>
								</td>
							</tr>
							<tr>
								<th>Status</th>
								<?php if ($dokumen->status == 'Terverifikasi') {?>
								<td class="verifikasi"><?= "$dokumen->status" ?></td>
								<?php } else {?>
								<td class="bverifikasi"><?= "$dokumen->status" ?></td>
								<?php } ?>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-2 col-sm-2 col-xs-10 col-lg-2">
				<?php if(file_exists('assets/File_TugasAkhir/'.$dokumen->NIM.'.pdf') ): ?> 
					<div style="margin: 0 auto;">
						<div><h3>Mengunduh Dokumen</h3></div>
						<a href="<?= base_url('admin/download/'. $dokumen->NIM) ?>" class="btn btn-primary"> <i class="fa fa-file-pdf-o" style="font-size: 60px;"></i> Download</a>
					</div>
				<?php else: ?>
					<div class="text-center"><h3>Dokumen belum tersedia</h3></div>
					<a href="#" class="btn btn-primary" style="margin-left:30%;"> <i class="fa fa-file-pdf-o" style="font-size: 60px;"></i></a>
				<?php endif; ?>
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

		<?php if(isset($dokumen->abstrak)): ?>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12 abstrak">
				<div class="text-center"><h3><strong>Abstrak</strong></h3></div>
				<hr>

				<div class="konten_abstrak">
					<p><?= $dokumen->abstrak ?></p>
				</div>
			</div>
		</div>

		<?php endif; ?>

	</div>


</div>