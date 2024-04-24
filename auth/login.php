<?php
//$return = password_verify('minthu789', '$2y$10$2BWXP1MObtiNMQ24MI4jKOPFANm/eSak2OWoet/Ifn0GDpYyKzxO2');
//var_export($return);
session_start();
require "../config/config.php";
$error = '';

if (isset($_SESSION['username'])) {
    header("Location: http://localhost:8000/");
}

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = 'One or more inputs are empty';
        echo "<script>
    alert($error)
</script>";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $login = $conn->query("Select * from Users where email='$email'");
        $login->execute();
        $fetch = $login->fetch(PDO::FETCH_ASSOC);
    }
    if ($login->rowCount() > 0) {
        if (password_verify($password, $fetch['mypassword'])) {
            $_SESSION['username'] = $fetch['username'];
            $_SESSION['email'] = $fetch['email'];
            $_SESSION['user_id'] = $fetch['Id'];
            $_SESSION['image'] = $fetch['image'];
            header("Location: http://localhost:8000/");
        } else {
            echo "<script>alert('email or password is worng')</script>";
        }
    } else {
        echo "<script>alert('email or password is worng')</script>";
    }
}
?>
<?php require "../includes/header.php"; ?>
<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
            <div class="container">
                <h1 class="pt-5">
                    Login Page
                </h1>
                <p class="lead">
                    Save time and leave the groceries to us.
                </p>

                <div class="card card-login mb-5">
                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="login.php">
                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <input class="form-control" type="text" required="" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input class="form-control" type="password" required="" name="password" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12 d-flex justify-content-between align-items-center">
                                    <!-- <div class="checkbox">
                                            <input id="checkbox0" type="checkbox" name="remember">
                                            <label for="checkbox0" class="mb-0"> Remember Me? </label>
                                        </div> -->
                                    <!-- <a href="login.html" class="text-light"><i class="fa fa-bell"></i> Forgot password?</a> -->
                                </div>
                            </div>
                            <div class="form-group row text-center mt-4">
                                <div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Log In</button>
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