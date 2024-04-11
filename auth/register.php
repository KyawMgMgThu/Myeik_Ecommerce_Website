<?php
session_start();
require "../config/config.php";
$error = '';
if (isset($_SESSION['username'])) {
    header("Location: http://localhost:8000/");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['username'])) {
        $error = 'One or more inputs are empty';
        echo "<script>alert($error)</script>";
    } elseif ($_POST['password'] != $_POST['confirm_password']) {
        $error = 'Passwords do not match';
        echo "<script>alert($error)</script>";
    } else {
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $image = "logo.png";

        $insert = $conn->prepare("INSERT INTO Users (fullname, email, username, mypassword, image) 
                                  VALUES (:fullname, :email, :username, :password, :image)");

        $insert->bindParam(":fullname", $fullname);
        $insert->bindParam(":email", $email);
        $insert->bindParam(":username", $username);
        $insert->bindParam(":fullname", $fullname);
        $insert->bindParam(":password", $hashed_password);
        $insert->bindParam(":image", $image);

        if ($insert->execute()) {
            echo "<script>alert('Registration successful')</script>";
            header("Location: http://localhost:8000/auth/login.php");
            exit();
        } else {
            echo "<script>alert('Error registering user')</script>";
        }
    }
}
?>

<?php require "../includes/header.php"; ?>

<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
            <div class="container">
                <h1 class="pt-5">
                    Register Page
                </h1>
                <p class="lead">
                    Save time and leave the groceries to us.
                </p>

                <div class="card card-login mb-5">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="register.php">
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input class="form-control" name="fullname" type="text" required="" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input class="form-control" name="email" type="email" required="" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input class="form-control" name="username" type="text" required="" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input class="form-control" type="password" name="password" required="" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input class="form-control" type="password" name="confirm_password" required="" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <input id="checkbox0" type="checkbox" name="terms">
                                        <label for="checkbox0" class="mb-0">I Agree with <a href="terms.html" class="text-light">Terms & Conditions</a> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row text-center mt-4">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "../includes/footer.php"; ?>