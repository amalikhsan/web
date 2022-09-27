<?php
if (isset($_SESSION["login"])) {
    echo "<script>location='?page=home'</script>";
}
?>
<div class="container">
    <div class="row vh-100">
        <div class="col-lg-5 mx-auto my-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header text-center bg-white">
                    <h3>Register</h3>
                </div>
                <div class="card-body text-end">
                    <form action="" method="post">
                        <input type="text" name="username" placeholder="Username" class="form-control mb-3" required>
                        <?php
                        if (isset($_GET['error1'])) {
                            echo "<p class='text-danger text-start'>" . $_GET['error1'] . "</p>";
                        }
                        ?>
                        <input type="email" name="email" placeholder="Email" class="form-control mb-3" required>
                        <?php
                        if (isset($_GET['error9'])) {
                            echo "<p class='text-danger text-start'>" . $_GET['error9'] . "</p>";
                        }
                        ?>
                        <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                        <?php
                        if (isset($_GET['error2'])) {
                            echo "<p class='text-danger text-start'>" . $_GET['error2'] . "</p>";
                        }
                        ?>
                        <input type="password" name="password2" placeholder="Konfirmasi Password" class="form-control mb-3" required>
                        <?php
                        if (isset($_GET['error3'])) {
                            echo "<p class='text-danger text-start'>" . $_GET['error3'] . "</p>";
                        }
                        ?>
                        <button type="submit" name="register" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>