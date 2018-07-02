<!--  -->
<body style="margin-top: 8%;">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content" style="width: 95% !important;">
							<div class="header text-center">
								<h4><strong>Login Dokumentasi TA</strong></h4>
								<div class="logo"><img src="<?= base_url('assets/logo.png') ?>" alt="Logo" style="width: 50px; height: 50px;"></div>
								<p>Oleh Kelompok 6</p>
							</div>
							<div>
								<?= $this->session->userdata('msg') ?>
							</div>
							<div >
					          <?php echo validation_errors(); ?>
					        </div>
							<?= form_open('Login') ?>
								<div class="form-group">
									<label for="signin-username" class="control-label sr-only">Username</label>
									<input type="number" class="form-control" name="username" required placeholder="Username" value="<?php echo set_value('username'); ?>">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Password" value="" required>
								</div>
								<div class="form-group">
					                <div style="text-align: left !important;"><h6>Sebagai</h6></div>
					                <select name="role" class="form-control" required>
					                  <option value="mahasiswa">Mahasiswa</option>
					                  <option value="dosen">Dosen</option>
					                  <option value="admin">Admin</option>
					                </select>
					              </div>
								<!-- <div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label>
								</div> -->
								<input name="login-submit" type="submit" class="btn btn-primary btn-lg btn-block" value="Login">
								<!-- <div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Forgot password?</a></span>
								</div> -->
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text text-center">
							<h1 class="heading">Aplikasi Dokumentasi Tugas Akhir</h1>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
