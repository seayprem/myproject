<nav class="navbar navbar-expand-lg navbar-light bg-is">
	<div class="container">
		<a href="index.php" class="navbar-brand">
			<!-- <img src="public/images/logo/rmuti2.png" height="64" alt=""> -->
			<a href="index.php" class="navbar-brand">ระบบส่งข้อสอบในสาขา</a>
		</a>
		<!-- responsive -->
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- responsive -->

		<!-- Menu -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto">
				<?php 
				if(isset($_SESSION['login'])) {

				
				?>
				<li class="nav-item">
					<a href="index.php" class="nav-link"><i class="fas fa-home"></i> หน้าหลัก</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link"><i class="fas fa-check-circle"></i> ตรวจสอบการส่งข้อสอบ</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link"><i class="fas fa-user"></i> <?= $_SESSION['login']; ?> </a>
				</li>

				<li class="nav-item">
					<a href="logout.php" id="logout" class="nav-link"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
				</li>
				<?php } else { ?>
				<li class="nav-item">
					<a href="#" class="nav-link"><i class="far fa-file"></i> คู่มือการใช้งาน</a>
				</li>
				<li class="nav-item">
					<a href="login.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> ลงชื่อเข้าใช้</a>
				</li>
				<?php } ?>
			</ul>
		</div>
		<!-- Menu -->

	</div>
</nav>