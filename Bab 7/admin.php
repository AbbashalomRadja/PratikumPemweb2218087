<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'motor_radja');

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tambah motor
if (isset($_POST['add_motor'])) {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "INSERT INTO motorcycles (name, image, description, price) VALUES ('$name', '$image', '$description', '$price')";
    $conn->query($sql);
}

// Edit motor
if (isset($_POST['edit_motor'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $sql = "UPDATE motorcycles SET name='$name', image='$image', description='$description', price='$price' WHERE id='$id'";
    $conn->query($sql);
}

// Hapus motor
if (isset($_GET['delete_motor'])) {
    $id = $_GET['delete_motor'];
    $sql = "DELETE FROM motorcycles WHERE id='$id'";
    $conn->query($sql);
}

// Ambil data motor
$motors = $conn->query("SELECT * FROM motorcycles");

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <link rel="icon" href="assets/icon.png" />
  <link rel="stylesheet" href="css/admin.css" />
  <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Catshop Admin</title>
</head>
<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class="bx bx-category"></i>
      <span class="logo_name">Motor Radja</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="#" class="active">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="categories/categories.html">
          <i class="bx bx-box"></i>
          <span class="links_name">Categories</span>
        </a>
      </li>
      <li>
        <a href="transaction/transaction.html">
          <i class="bx bx-list-ul"></i>
          <span class="links_name">Transaction</span>
        </a>
      </li>
      <li>
        <a href="logout.php">
          <i class="bx bx-log-out"></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class="bx bx-menu sidebarBtn"></i>
      </div>
      <div class="profile-details">
        <span class="admin_name">Radja Admin</span>
      </div>
    </nav>
    <div class="home-content">
      <div class="welcome-text">
        <h1>Selamat Datang Admin</h1>
        <p>Selamat datang di halaman admin Motor Radja. Silakan kelola informasi dan transaksi dari sini.</p>
      </div>
      <div class="motor-section">
        <h2>Manage Motorcycles</h2>
        <form method="POST" action="">
          <input type="hidden" name="id" value="">
          <input type="text" name="name" placeholder="Motor Name" required>
          <input type="text" name="image" placeholder="Image URL" required>
          <textarea name="description" placeholder="Description" required></textarea>
          <input type="number" name="price" placeholder="Price" required>
          <button type="submit" name="add_motor">Add Motor</button>
          <button type="submit" name="edit_motor">Edit Motor</button>
        </form>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Image</th>
              <th>Description</th>
              <th>Price</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($motor = $motors->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $motor['name']; ?></td>
                <td><img src="<?php echo $motor['image']; ?>" alt="<?php echo $motor['name']; ?>" width="100"></td>
                <td><?php echo $motor['description']; ?></td>
                <td><?php echo $motor['price']; ?></td>
                <td>
                  <a href="admin.php?edit_motor=<?php echo $motor['id']; ?>">Edit</a>
                  <a href="admin.php?delete_motor=<?php echo $motor['id']; ?>">Delete</a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
  <script>
    let sidebar = document.querySelector(".sidebar");
    let sidebarBtn = document.querySelector(".sidebarBtn");
    sidebarBtn.onclick = function () {
      sidebar.classList.toggle("active");
      if (sidebar.classList.contains("active")) {
        sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
      } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    };
  </script>
</body>
</html>
