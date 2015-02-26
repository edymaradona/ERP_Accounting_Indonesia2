<?php
	$sqlRaw = "
	SELECT r.id,r.email FROM s_user_registration r LEFT JOIN h_applicant h ON r.id = h.id WHERE r.email IS NOT null AND h.t_status IS NULL AND r.id <= 14346 ORDER BY r.id LIMIT 50
	";
	$subject="Agung Podomoro Land - Career. Disain Baru, Navigasi mudah dan Terintegrasi";
	$body  = '<html><body>';
	$email = $row['email'];
	$body .="
		Hi, ".$email."<br/><br/>


		<p>Saat ini Anda telah terdaftar sebagai kandidat yang pernah memasukan data pelamar dalam website PT. Agung Podomoro Land Tbk. di http://www.agungpodomoro-career.com</p>

		<p>Perlu disampaikan bahwa perubahan telah dilakukan pada sistem rekruitmen elektronis kami guna memberikan kemudahan bagi Anda dalam melihat lowongan-lowongan yang tersedia dan memperbaharui data pribadi Anda, antara lain:</p>

		1. Disain baru yang lebih menarik.<br/>

		2. Navigasi yang semakin mudah<br/>

		3. Integrasi dengan sistem seleksi.<br/>


		<p>Kami masih membutuhkan kerjasama Anda untuk melakukan hal-hal berikut:</p>

		<p>1. Login ke dalam aplikasi dengan menggunakan username dan password baru sebagai berikut:</p>

			Username		: ".$email."<br/>
			Password baru	: ".$email.$row['id']."<br/><br/>	


		<p>2. Untuk alasan keamanan sesaat setelah sukses login, lakukan penggantian password di atas:</p>

			a. Klik menu “My Profile” yang muncul di kanan atas Navigation Bar<br/>
			b. Klik tombol “Update Password”<br/>
			c. Masukan password baru pada 2 kotak yang tersedia<br/>
			d. Tekan tombol “Save”<br/><br/>

		<p>3. Lengkapi data Pengalaman Kerja dan Pendidikan Anda. Adalah hal penting buat tim rekrutmen kami untuk menilai Anda berdasarkan pengalaman kerja dan latar pendidikan Anda.</p>

		<p>4. Upload Photo Anda yang terakhir.</p>


		<p>Terima kasih atas kerjasama Anda dan selamat menikmati fitur baru kami. Semoga bermanfaat.</p><br/><br/>



		Salam,<br/><br/>

		Tim Rekrutment PT Agung Podomoro Land Tbk

	";

	$body  .= '</body></html>';

	$sql2 = "UPDATE h_applicant SET t_status = 1 WHERE id = ".$row['id'];
?>
