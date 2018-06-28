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
            <?= form_open_multipart('Home/search') ?>
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" class="form-control form-control-lg" name="keyword" placeholder="Masukkan Kata Kunci...">
                </div>
                <div class="col-12 col-md-3">
                  <button type="submit" class="btn btn-block btn-lg btn-primary" name="cari"><i class="fa fa-search"> Cari</i></button>
                </div>
             <?= form_close() ?>
          </div>
        </div>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container" style="margin-top: 3%;">

      <div class="row">

        <div class="col-lg-3">
          <div class="row">
            <div class="col-md-10">
                <h5 class="my-4">Tahun</h5>
                <div class="input-group">
                  <select class="form-control" name="tahun" id="tahun">
                    <?php
                      $thn_skr = date('Y');
                      for ($x = $thn_skr; $x >= 2013; $x--) {
                    ?>
                      <option value="<?= $x ?>"><?= $x ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <span class="input-group-addon btn btn-primary" id="search"><i class="fa fa-search"></i></span>     
                </div>
            </div>
          </div>

          <div class="row" style="margin-top: 15%;">
            <div class="col-md-10">
              <h5 class="my-4">Konsentrasi</h5>
              <div class="list-group">
                <a href="<?php echo base_url('Home/konsentrasi/Semua') ?>" class="list-group-item" name="Semua">Semua Konsentrasi</a>
                <a href="<?php echo base_url('Home/konsentrasi/Kecerdasan_Buatan') ?>" class="list-group-item" name="keyword">Kecerdasan Buatan</a>
                <a href="<?php echo base_url('Home/konsentrasi/Basis_Data') ?>" class="list-group-item" nama="Basis Data">Basis Data</a>
                <a href="<?php echo base_url('Home/konsentrasi/Citra') ?>" class="list-group-item" name="keyword" value="citra">Citra</a>
              </div>
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
           <?= $this->session->flashdata('message') ?>
          </div>
          
          <div id="result-container">
  
          </div>
          
          <div id="hasil-dokumen">
            <?php 
              foreach ($dokumenTA as $key ) {             
             ?>
            <div class="card mt-4">
              <div class="card-body">
                <h5 class="card-title"><?php echo $key->judulTA; ?></h5>
                <div class="authors">
                  <ul id="myUL" style="list-style: none; margin-left: -5%;">
                    <li>Penulis : <?php echo $key->nama; ?></li>
                    <li>Konsentrasi : <?php echo $key->konsentrasi; ?></li>
                    <li>Tahun : <?php echo $key->tahun_pembuatan; ?></li>
                  </ul>
                </div>
                <div>
                  <a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample_<?= $key->NIM ?>" aria-expanded="false" aria-controls="collapseExample_<?= $key->NIM ?>">Abstrak</a>
                  <a href="<?php echo base_url('Home/download/'."$key->NIM") ?>" class="btn btn-success"><i class="fa fa-download"></i></a>
                  <a href="<?php echo base_url('Home/tampil_pdf/'."$key->NIM") ?>" class="btn btn-success">View</a>

                  <div class="collapse" id="collapseExample_<?= $key->NIM ?>">
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

    <script type="text/javascript">
      $(document).ready(function() {
        
        $('#search').on('click', function() {
          console.log($('#tahun').val());
          $.ajax({
            url: '<?= base_url('home/tahun-pembuatan') ?>',
            type: 'POST',
            data: {
              cari: true,
              tahun: $('#tahun').val()
            },
            success: function(response) {
              $('#hasil-dokumen').hide();
              $('#result-container').html('');
              var html = '';
              var json = $.parseJSON(response);
              var tahun = $('#tahun').val();

              if(json.result.length == undefined || json.result.length <= 0){
                console.log('undefined jok');
                html += '<div class="alert alert-warning alert-dismissable"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Dokumen tidak ada!</div>';
              }
              else{
                console.log('berhasil jok');
                for (var i = 0; i < json.result.length; i++) {
                  html += '<div class="card mt-4">'+
                            '<div class="card-body">'+
                              '<h5 class="card-title">'+ json.result[i].judulTA +'</h5>'+
                              '<div class="authors">'+
                                '<ul id="myUL" style="list-style: none; margin-left: -5%;">'+
                                  '<li>Penulis : '+ json.result[i].nama +'</li>'+
                                  '<li>Konsentrasi : '+ json.result[i].konsentrasi +'</li>'+
                                  '<li>Tahun : '+ json.result[i].tahun_pembuatan +'</li>'+
                                '</ul>'+
                              '</div>'+
                              '<div>'+
                                '<a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample_<?= $key->NIM ?>" aria-expanded="false" aria-controls="collapseExample_<?= $key->NIM ?>">Abstrak</a>'+
                                '<a href="<?= base_url('Home/download/') ?>' + json.result[i].NIM +'" class="btn btn-success"><i class="fa fa-download"></i></a>'+
                                '<a href="<?= base_url('Home/tampil_pdf/') ?>' + json.result[i].NIM +'" class="btn btn-success">View</a>'+

                                '<div class="collapse" id="collapseExample_<?= $key->NIM ?>">'+
                                  '<div class="well">'+
                                    '<p class="card-text konten">'+
                                      json.result[i].abstrak +
                                    '</p>'+
                                  '</div>'+
                                '</div>'+
                              '</div>'+
                            '</div>'+
                          '</div>';
                }
              }

              $('#result-container').html(html);
            },
            error: function(err) {
              console.error(err.responseText);
            }
          });
        });
      });
    </script>

