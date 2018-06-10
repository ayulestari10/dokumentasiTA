<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title><?= $title ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/login/') ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/login/') ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/login/') ?>assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/login/') ?>assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?= base_url('assets/login/') ?>assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="<?= base_url('assets/login/') ?>assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url('assets/login/') ?>assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<!-- <div class="logo text-center"><img src="<?= base_url('assets/login/') ?>assets/img/logo-dark.png" alt="Klorofil Logo"></div> -->
								<h3><strong>Login Dokumentasi TA</strong></h3>
							</div>
							<div>
								<?= $this->session->userdata('msg') ?>
							</div>
							<?= form_open('Login') ?>
								<div class="form-group">
									<label for="signin-username" class="control-label sr-only">Username</label>
									<input type="username" class="form-control" name="username" placeholder="Username">
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input type="password" class="form-control" name="password" placeholder="Password">
								</div>
								<div class="form-group">
					                <div style="text-align: left !important;"><h5>Sebagai</h5></div>
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
