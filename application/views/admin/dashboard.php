      <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <hr>
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/data-mahasiswa') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count"><?= count($mahasiswa) ?></div>
                    <h3>Data Mahasiswa</h3>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/data-dosen') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-users"></i></div>
                    <div class="count"><?= count($dosen) ?></div>
                    <h3>Data Dosen</h3>
                  </div>
                </a>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= base_url('admin/data-dokumen') ?>">
                  <div class="tile-stats">
                    <div class="icon"><i class="fa fa-file-pdf-o"></i></div>
                    <div class="count"><?= count($tugas_akhir) ?></div>
                    <h3>Dokumen TA</h3>
                  </div>
                </a>
              </div>
              
            </div>
          </div>
        </div>
        <!-- /page content -->