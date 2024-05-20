<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'motor_radja');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ambil data pengguna dari database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            setcookie('username', $user['username'], time() + 3600, "/"); // Set cookie selama 1 jam
            header('Location: index.html');
            exit;
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <link rel="icon" href="assets/icon.png" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@500;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <div class="container">
    <header>
      <nav>
        <div class="logo">
          <img src="assets/download.png" alt="" />
        </div>
        <input type="checkbox" id="click" />
        <label for="click" class="menu-btn">
          <i class="fas fa-bars"></i>
        </label>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="#">Categories</a></li>
          <?php 
          if(isset($_SESSION['username'])) {
              echo '<li><a href="logout.php">Logout</a></li>';
          } else {
              echo '<li><a href="login.php" class="btn_login">Login</a></li>';
          }
          ?>
        </ul>
      </nav>
    </header>
    <main>
      <div class="center">
        <div class="form-login">
          <h2>Login</h2>
          <form action="login-proses.php" method="post">
            <input class="input" type="text" name="username" placeholder="Enter your username" required />
            <input class="input" type="password" name="password" placeholder="Enter your password" required />
            <button type="submit" class="btn_login" name="login" id="login">Login</button>
          </form>
          <?php 
          if(isset($error)) {
              echo '<p style="color:red;">'.$error.'</p>';
          }
          ?>
          <p>Don't have an account? <a href="register.php" class="link-register">Register here</a></p>
        </div>
      </div>
    </main>
    <footer>
      <h4>&copy; Motor Radja</h4>
    </footer>
  </div>
</body>
</html>
