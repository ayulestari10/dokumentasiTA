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
                        <i class="fa fa-user"></i> <?= $username ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="<?= base_url('admin/profile') ?>"><i class="fa fa-user"></i> Profile</a></li>
                        <?php if(isset($username)):  ?>
                            <li><a href="<?= base_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a></li>
                        <?php else: ?>
                            <li><a href="<?= base_url('login') ?>"><i class="fa fa-sign-in"></i> Login</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!-- <li><a href="<?= base_url() ?>"></a></li> -->
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->