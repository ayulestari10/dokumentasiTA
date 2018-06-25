<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i> <?= $this->session->userdata('username') ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?= base_url('mahasiswa/profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- <li><a href="<?= base_url() ?>"></a></li> -->
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->