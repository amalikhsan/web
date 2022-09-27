<?php
if (!isset($_SESSION["login"]) || !isset($_GET["key"])) {
    echo "<script>location='index.php'</script>";
}
?>
<div class="container py-5">
    <div class="row">
        <?php
        $result = $db->get4(@$_GET["key"]);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
        ?>
            <div class="col-lg-8 mx-lg-auto">
                <div class="card border-0 shadow-lg mb-3 px-3">
                    <div class="card-header bg-white pb-0">
                        <h3>Profile</h3>
                    </div>
                    <div class="card-body py-4">
                        <div class="row text-center text-sm-start">
                            <div class="col-12 col-sm-3 mb-3 mb-sm-0">
                                <div class="position-relative mx-auto mx-sm-0" style="width:100px;">
                                    <img class="rounded-circle bg-primary shadow-lg" width="100px" height="100px">
                                    <div class="position-absolute top-50 start-50 translate-middle">
                                        <p class="display-3 fw-normal mb-2 text-white text-uppercase"><?= $row["username"][0] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-9">
                                <h4><?= ucwords($row["username"]) ?><?php if ($_GET["key"] == $_SESSION["login"]) { ?><a href="?page=editprofile&id=<?= $row["id_user"] ?>" class="bg-transparent text-dark ms-3" title="Edit"><i class="bi bi-gear-fill"></i></a><?php } ?></h4>
                                <?php
                                $result = $db->get6($_GET["key"]);
                                $rowss = mysqli_num_rows($result);
                                echo "<p class='mb-2'><b>" . $rowss . "</b> Post</p>";
                                ?>
                                <p><?= ucwords($row["bio"]) ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="card border-0 shadow-lg mb-3 px-3">
                            <div class="card-header bg-white pb-0">
                                <?php
                                if ($_SESSION["login"] == $row["judul"]) {
                                    $db->hapus($row["id_item"]); ?>
                                    <form action="" method="post">
                                        <button type="submit" name="hapus<?= $row["id_item"] ?>" class="bg-transparent text-dark border-0 float-end ms-2" onclick="return confirm('Apakah anda yakin ingin menghapus postingan ini?');if(confirm) return true;else return false;" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                <?php } ?>
                                <?php
                                if ($_SESSION["login"] == $row["judul"]) {
                                ?>
                                    <a href="?page=edit&id=<?= $row["id_item"] ?>" class="bg-transparent text-dark float-end ms-3" title="Edit"><i class="bi bi-gear-fill"></i></a>
                                <?php } ?>
                                <a href="https://wa.me/?text=@<?= $row["judul"] ?> : <?= $row["desk"] ?>%0A%0AMau buat kata juga? cek link berikut ini <?= "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>" class="bg-transparent text-dark float-end ms-3" title="Share"><i class="bi bi-share-fill"></i></a>
                                <p class="float-end mb-0"><?= $db->nicetime($row["created"]); ?></p>
                                <h5><?php if ($_SESSION["login"] == $row["judul"]) {
                                        echo "You";
                                    } else {
                                        echo ucwords($row["judul"]);
                                    } ?></h5>
                            </div>
                            <div class="card-body">
                                <p><?= ucwords(nl2br($row["desk"])) ?></p>
                            </div>
                        </div>
                <?php }
                } ?>
            </div>
        <?php
        } else { ?>
            <div class="col-lg-8 mx-lg-auto">
                <div class="card border-0 shadow-lg mb-3 px-3">
                    <div class="card-header bg-white pb-0">
                        <h3>Sorry</h3>
                    </div>
                    <div class="card-body">
                        <p>Not found</p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>