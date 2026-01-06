<?php
require_once 'config.php';

$error = '';

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = escape($_POST['username']);
  $password = $_POST['password'];

  if (empty($username) || empty($password)) {
    $error = "Username dan password wajib diisi!";
  } else {
    // Cek user di database
    $result = query("SELECT * FROM users WHERE username = '$username'");

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();

      // Verifikasi password
      if (password_verify($password, $user['password'])) {
        // Login berhasil, simpan session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

        // Redirect ke home
        header("Location: index.php");
        exit;
      } else {
        $error = "Password salah!";
      }
    } else {
      $error = "Username tidak ditemukan!";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Gaming Center</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
      <div class="col-md-5">
        <div class="card shadow-lg">
          <div class="card-header bg-success text-white text-center">
            <h3>🎮 Login Gaming Center</h3>
          </div>
          <div class="card-body p-4">
            <?php if ($error): ?>
              <div class="alert alert-danger">
                <?php echo $error; ?>
              </div>
            <?php endif; ?>

            <form method="POST" action="">
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
              </div>

              <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                <small class="text-muted">Password default dummy: 12345</small>
              </div>

              <button type="submit" class="btn btn-success w-100">Login</button>
            </form>

            <div class="text-center mt-3">
              <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>