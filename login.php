<?php
session_start();

$users = [
    "admin" => "password123",
    "aflah" => "12345"
];

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION["login"] = true;
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit;
    }
    $error = "Username atau password salah";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login SIM-Barang</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Login SIM-Barang</h1>
  <?php if ($error): ?><p style="color:red"><?= $error ?></p><?php endif; ?>
  <form method="POST" action="login.php">
    <div>
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Masuk</button>
  </form>
</body>
</html>