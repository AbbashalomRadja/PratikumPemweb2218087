<?php
session_start();


// Simulasi database pengguna
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

// Memeriksa apakah pengguna sudah mengirimkan form login
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Memeriksa apakah username dan password cocok dengan data di "database"
    if(array_key_exists($username, $users) && $users[$username] === $password) {
        // Menyimpan username dalam session
        $_SESSION['username'] = $username;
        // Set cookie dengan nama 'username' selama 1 jam
        $_COOKIE['username'] = $username;
        
        // Redirect ke halaman home atau halaman yang diinginkan
        header('Location: index.html');
        exit;
    } else {
        // Jika username atau password tidak cocok, tampilkan pesan error
        $error = "Username or password is incorrect.";
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
        // Menampilkan link login atau nama pengguna jika sudah login
        if(isset($_SESSION['username'])) {
            echo '<li><a href="logout.php">Logout</a></li>';
        } else {
            echo '<li><a href="login.html" class="btn_login">Login</a></li>';
        }
        ?>
	    </ul>
        </nav>
	</header>
	<main>
	  <div class="center">
	    <div class="form-login">
		 <h2>Login</h2>
		 <form action="" method="POST">
		   <input class="input" type="text" name="username"
			    placeholder="Enter your username" />
	         <input class="input" type="password" name="password"
			    placeholder="Enter your password" />
		   <button type="submit" class="btn_login" name="login"  
                      id="login"> Login
		   </button>
		 </form>
         <?php 
         // Menampilkan pesan error jika login gagal
         if(isset($error)) {
             echo '<p style="color:red;">'.$error.'</p>';
         }
         ?>
		 <p>Don't have an account? <a href="register.html" class="link-register">Register here</a></p>
	    </div>
	  </div>
	</main>
	<footer>
	   <h4>&copy; Motor Radja</h4>
      </footer>
   </div>
</body>
</html>
