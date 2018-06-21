<!-- Masthead -->
    <header class="masthead text-white text-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">Dokumentasi Tugas Akhir</h1>
            <h3 class="mb-5">Mencari Tugas Akhir? Masukan Judul atau Kata Kunci yang Ada!</h3>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form>
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" class="form-control form-control-lg" placeholder="Masukkan Kata Kunci...">
                </div>
                <div class="col-12 col-md-3">
                  <button type="submit" class="btn btn-block btn-lg btn-primary"><i class="fa fa-search"> Cari</i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container" style="margin-top: 3%;">

      <div class="row">

        <div class="col-lg-3">
          <div>
            <h5 class="my-4">Tahun</h5>
            <select class="form-control">
              <?php
                $thn_skr = date('Y');
                for ($x = $thn_skr; $x >= 2013; $x--) {
              ?>
                <option value="<?php echo $x ?>"><?php echo $x ?></option>
              <?php
                }
              ?>
            </select>
          </div>

          <div>
            <h5 class="my-4">Konsentrasi</h5>
            <div class="list-group">
              <a href="#" class="list-group-item">Kecerdasan Buatan</a>
              <a href="#" class="list-group-item">Basis Data</a>
              <a href="#" class="list-group-item">Citra</a>
            </div>
          </div>

        </div>
        <!-- /.col-lg-3 -->

        <style type="text/css">
          .konten{
            padding: 2%;
            text-align: justify;
          }
        </style>

        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
          <div>
            <?php 
              foreach ($dokumenTA as $key ) {
                # code...
              
             ?>
            <div class="card mt-4">
              <div class="card-body">
                <h5 class="card-title"><?php echo $key->judulTA; ?></h5>
                <div class="authors">
                  <ul style="list-style: none; margin-left: -5%;">
                    <li>Penulis : <?php echo $key->nama; ?></li>
                    <li>Jurusan : <?php echo $key->jurusan; ?></li>
                    <li>Konsentrasi : <?php echo $key->konsentrasi; ?></li>
                    <li>Tahun : <?php echo $key->tahun_pembuatan; ?></li>
                    <li>Email : <?php echo $key->email; ?></li>
                  </ul>
                </div>
                <div>
                  <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Abstrak</a>
                  <a href="<?php echo base_url('Home/download/') ?><?php //echo $key->NIM ?>" class="btn btn-success"><i class="fa fa-download">   </i></a>

                  <div class="collapse" id="collapseExample">
                    <div class="well">
                      <p class="card-text konten">
                        <?php echo $key->abstrak; ?>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- /.card -->

              <?php 
                }
              ?>
          </div>
        </div>
      </div>
    </div>