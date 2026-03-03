<?php
require_once('../model/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $db->prepare("INSERT INTO users (email, passwordHash) VALUES (?, ?)");
    $stmt->execute([$email, $password]);

    header("Location: login.php");
    exit;
}
?>

<?php include('../view/header.php'); ?>
<main class="auth">
    <h2>Register</h2>
    <form method="post">
    
        <input type="email" name="email" required>
        <input type="password" name="password" required>
        <input type="submit" value="Register">
    </form>
</main>
<?php include('../view/footer.php'); ?>
