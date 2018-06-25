
<body style="margin-top: 8%;">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left" style="margin-top: -35%;">
						<div class="content">
							<div class="header">
								<!-- <div class="logo text-center"><img src="<?= base_url('assets/login/') ?>assets/img/logo-dark.png" alt="Klorofil Logo"></div> -->
								<h4><strong>Login Dokumentasi TA</strong></h4>
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
									<input type="number" class="form-control" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" >
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Password" value="" >
								</div>
								<div class="form-group">
					                <div style="text-align: left !important;"><h6>Sebagai</h6></div>
					                <select name="role" class="form-control">
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
						<div class="content text">
							<h1 class="heading text-center">Aplikasi Dokumentasi Tugas Akhir</h1>
							<!-- <p>by The Develovers</p> -->
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
