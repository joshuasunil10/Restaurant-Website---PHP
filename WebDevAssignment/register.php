<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/login.css">
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <title>Register - NotKFC</title>
</head>
<body>
    <div class="login-container">
        <h2>Register on NotKFC</h2>
        <center><img src="images/favicon.png" style="width: 100px; height: 100px;" alt=""></center>
        <form action="register_process.php" method="post">
            <input type="text" name="full_name" placeholder="Full Name" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <a href="login.php">Have an Account? - Login here</a> 
        <a href="index.php">Back to Home</a> 
    </div>
</body>
</html>
