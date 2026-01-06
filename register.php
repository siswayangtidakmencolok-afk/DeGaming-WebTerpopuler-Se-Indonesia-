<?php
require_once 'config.php';

$error = '';
$success = '';

// Proses form ketika di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Ambil data dari form
  $username = escape($_POST['username']);
  $email = escape($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $nama_lengkap = escape($_POST['nama_lengkap']);
  $telepon = escape($_POST['telepon']);

  // Validasi input
  if (empty($username) || empty($email) || empty($password) || empty($nama_lengkap)) {
    $error = "Semua field wajib diisi!";
  } elseif ($password !== $confirm_password) {
    $error = "Password dan konfirmasi password tidak cocok!";
  } elseif (strlen($password) < 5) {
    $error = "Password minimal 5 karakter!";
  } else {
    // Cek apakah username/email sudah ada
    $check = query("SELECT * FROM users WHERE username = '$username' OR email = '$email'");

    if ($check->num_rows > 0) {
      $error = "Username atau email sudah terdaftar!";
    } else {
      // Hash password
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);

      // Insert ke database
      $sql = "INSERT INTO users (username, email, password, nama_lengkap, telepon) 
                    VALUES ('$username', '$email', '$hashed_password', '$nama_lengkap', '$telepon')";

      if (query($sql)) {
        $success = "Registrasi berhasil! Silakan login.";
        // Redirect ke login setelah 2 detik
        header("refresh:2;url=login.php");
      } else {
        $error = "Terjadi kesalahan. Silakan coba lagi.";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi - Gaming Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-6">
        <div class="card shadow-lg">
          <div class="card-header bg-primary text-white text-center">
            <h3>🎮 Registrasi Gaming Center</h3>
          </div>
          <div class="card-body p-4">
            <?php if ($error): ?>
              <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
              <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>

            <form method="POST" action="">
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" placeholder="08xxx">
              </div>

              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="confirm_password" class="form-control" required>
              </div>

              <button type="submit" class="btn btn-primary w-100">Daftar</button>
            </form>

            <div class="text-center mt-3">
              <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>