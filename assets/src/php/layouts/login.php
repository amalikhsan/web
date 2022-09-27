<?php
if (isset($_SESSION["login"])) {
    echo "<script>location='?page=home'</script>";
}
?>
<div class="container">
    <div class="row vh-100">
        <div class="col-lg-5 mx-auto my-auto">
            <div class="card shadow-lg border-0">
                <div class="card-header text-center bg-white">
                    <h3>Login</h3>
                </div>
                <div class="card-body text-end">
                    <form action="" method="post">
                        <input type="username" name="username" placeholder="Username" class="form-control mb-3" required>
                        <?php
                        if (isset($_GET['error3'])) {
                            echo "<p class='text-danger text-start'>" . $_GET['error3'] . "</p>";
                        }
                        ?>
                        <input type="password" name="password" placeholder="Password" class="form-control mb-3" required>
                        <?php
                        if (isset($_GET['error4'])) {
                            echo "<p class='text-danger text-start'>" . $_GET['error4'] . "</p>";
                        }
                        ?>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>