<?php
if (!isset($_SESSION["login"])) {
    echo "<script>location='index.php'</script>";
}
$result = $db->get5(@$_GET["id"]);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        if ($_SESSION["login"] != $row["username"]) {
            echo "<script>location='?key=" . $_SESSION['login'] . "&page=profile'</script>";
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto my-5">
            <?php
            $result = $db->get5(@$_GET["id"]);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $db->edit2(@$_GET["id"], $row["username"]);
            ?>
                    <div class="card border-0 shadow-lg px-3">
                        <div class="card-header bg-white pb-0">
                            <h5>Edit profile</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="text-end">
                                <textarea name="text" class="w-100 form-control mb-3" placeholder="Write for your bio" autocomplete="off" autofocus rows="3"><?= $row["bio"] ?></textarea>
                                <?php
                                if (isset($_GET['error10'])) {
                                    echo "<p class='text-danger float-start mb-0 ms-2'>" . $_GET['error10'] . "</p>";
                                }
                                ?>
                                <a href="?key=<?= $row["username"] ?>&page=profile" class="btn btn-sm btn-outline-primary"><i class="bi bi-house me-2"></i>Back</a>
                                <button type="submit" class="btn btn-sm btn-primary" name="edit<?= $_GET["id"] ?>"><i class="bi bi-send me-2"></i>Send</button>
                            </form>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>