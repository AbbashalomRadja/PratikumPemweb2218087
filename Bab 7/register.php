<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'motor_radja');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses registrasi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Simpan ke database
    $sql = "INSERT INTO users (email, username, password) VALUES ('$email', '$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registrasi berhasil";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <link rel="icon" href="assets/icon.png" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Roboto:wght@500;700&display=swap" rel="stylesheet"/>
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
          <li><a href="login.php" class="btn_login">Login</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <div class="center">
        <div class="form-login">
          <h2>Register</h2>
          <form action="register-proses.php" method="post">

            <input class="input" type="email" name="email" placeholder="Enter your email" required />
            <input class="input" type="text" name="username" placeholder="Choose a username" required />
            <input class="input" type="password" name="password" placeholder="Create a password" required />
            <button type="submit" class="btn_login" name="register" id="register">Register</button>
          </form>
          <p>Already have an account? <a href="login.php" class="link-register">Login here</a></p>
        </div>
      </div>
    </main>
    <footer>
      <h4>&copy; Motor Radja</h4>
    </footer>
  </div>
</body>
</html>
