
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div class="card" style="padding: 50px; width: 40%; margin: 0 auto; margin-top: 10%;">
	<h3 style="text-align: center;" class="black-text">Login!</h3>
	<form method="POST">
		<div class="input_field">
			<label for="username">Username</label>
			<input id="username" type="text" name="username" required>
		</div>
		<div class="input_field">
			<label for="password">Passowrd</label>
			<input id="password" type="password" name="password" required>
		</div>
		<input type="submit" name="login" value="Login" class="btn btn-secondary" style="width: 100%;">

		Belum Punya Akun ?<a href="#daftarBaru" data-toggle="modal" style="color: #14827d">Daftar Sekarang !</a>

	</form>
</div>

<div id="daftarBaru" class="modal fade">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-header">
	<h5 class="modal-title" id="exampleModalLongTitle">Registrasi</h5>
	<button type="button" class="close" data-dismiss = "modal" aria-label ="close">
		<span aria-hidden = "true">&times;</span>
	</button>	
	</div>
	<div class="modal-body">
		<form method="POST">
				<div class="col s12 input-field">
					<input id="nik" placeholder="NIK" type="number" name="nik">
				</div>
				<div class="col s12 input-field">
					<input id="nama" placeholder="Nama" type="text" name="nama">
				</div>
				<div class="col s12 input-field">		
					<input id="username" placeholder="Username" type="text" name="username"><br><br>
				</div>
				<div class="col s12 input-field">
					<input id="pass" placeholder="Password" type="password" name="pass"><br><br>
				</div>
				<div class="col s12 input-field">
					<input id="telp" placeholder="No.Telp" type="number" name="telp"><br><br>
				</div>
				<div class="col s12 input-field">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss= "modal">Close</button>
					<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
				</div>
				</form>
			<?php 
				if (isset($_POST['simpan'])) {
					$password = md5($_POST['pass']);

					$query = mysqli_query ($koneksi, "INSERT INTO masyarakat VALUES ('".$_POST['nik']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')") OR DIE (mysqli_error($koneksi));

					if ($query) {
						echo "<script>alert('Data Tersimpan')</script>";
						echo "<script>location='location:index.php?p=login';</script>";
								}			}
			 ?>
 	</div>	
	</div>	
	</div>
</div>

<?php 
	if(isset($_POST['login'])){
		$username = mysqli_real_escape_string($koneksi,$_POST['username']);
		$password = mysqli_real_escape_string($koneksi,md5($_POST['password']));

		$sql = mysqli_query($koneksi,"SELECT * FROM masyarakat WHERE username ='$username' AND password='$password' ");
		$cek = mysqli_num_rows($sql);
		$data = mysqli_fetch_assoc($sql);

		$sql2 = mysqli_query($koneksi,"SELECT * FROM petugas WHERE username = '$username' AND password='$password' ");
		$cek2 = mysqli_num_rows($sql2);
		$data2 = mysqli_fetch_assoc($sql2);

		if($cek>0){
			session_start();
			$_SESSION['username']=$username;
			$_SESSION['data']=$data;
			$_SESSION['level']='masyarakat';
			header('location:masyarakat/');
		}
		elseif($cek2>0){
				session_start();
				$_SESSION['username']=$username;
				$_SESSION['data']=$data2;
				$_SESSION['level']='admin';
				header('location:admin/');
			
		}
		else{
			echo "<script>alert('Gagal Login Sob')</script>";
		}

	}
 ?>
