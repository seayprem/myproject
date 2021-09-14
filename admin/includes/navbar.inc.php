<nav class="navbar navbar-expand-lg navbar-light bg-is">
	<div class="container">
		<a href="index.php" class="navbar-brand">
			<!-- <img src="public/images/logo/rmuti2.png" height="64" alt=""> -->
			<a href="index.php" class="navbar-brand">ระบบจัดการข้อสอบ</a>
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
				if(isset($_SESSION['officer'])) {
				?>
				<li class="nav-item">
					<a href="#" class="nav-link"><i class="fas fa-user"></i> สวัสดีคุณ <?= $_SESSION['officer']; ?></a>
				</li>
				<li class="nav-item">
					<a href="logout.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> ออกจากระบบ</a>
				</li>
				<?php } else { ?>
					<li class="nav-item">
						<a href="login.php" class="nav-link"><i class="fas fa-sign-in-alt"></i> ลงชื่อเข้าใช้</a>
					</li>
				<?php } ?>
			</ul>
		</div>
		<!-- Menu -->

	</div>
</nav>