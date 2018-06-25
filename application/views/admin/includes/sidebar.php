<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?= base_url('') ?>" class="site_title"><i class="fa fa-file-pdf-o"></i> <span>Dokumentasi TA</span></a>
                </div>
                <div class="clearfix"></div>
                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="<?= base_url('assets/foto/admin/'.$username.'.jpg') ?>" alt="User" class="img-circle profile_img" onerror='src="<?= base_url('assets/production/') ?>images/img.jpg"'>
                    </div>
                    <div class="profile_info">
                        <span>Welcome,</span>
                        <h2><?= $username ?></h2>
                    </div>
                </div>
                <!-- /menu profile quick info -->
                <br />
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menu</h3>
                        <ul class="nav side-menu">
                            <li><a href="<?= base_url('admin') ?>"><i class="fa fa-home"></i> Home</a></li>
                            <li><a href="<?= base_url('admin/data-mahasiswa') ?>"><i class="fa fa-users"></i> Data Mahasiswa</a></li>
                            <li><a href="<?= base_url('admin/data-dosen') ?>"><i class="fa fa-users"></i> Data Dosen</a></li>
                            <li><a href="<?= base_url('admin/data-dokumen') ?>"><i class="fa fa-file-pdf-o"></i> Dokumen TA</a></li>
                            <!-- <li><a href="#"><i class="fa fa-th-list"></i> Kriteria</a>
                            <ul class="nav child_menu">
                                 <li><a href="<?= base_url('admin/kriteria') ?>"><i class="fa fa-list"></i> Data Kriteria</a></li>
                            </ul> -->
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>