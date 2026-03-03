<?php
require_once('../model/database.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['passwordHash'])) {
        $_SESSION['user_id'] = $user['userID'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_email'] = $user['email'];

        header("Location: /Proekt/index.php");
        exit;
    }

    $error = "Invalid credentials";
}
?>

<?php include('../view/header.php'); ?>

<main class="auth">
    <h2>Login</h2>
    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
    <form method="post">
        <input type="email" name="email" required><br><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
            <p style="margin-top:1rem;">
    Don’t have an account?
    <a href="register.php">Register here</a>
    </p>
    </form>


</main>
<?php include('../view/footer.php'); ?>
