<?php

class Database
{
    public $server;
    public $uname;
    public $password;
    public $db;
    public $tb1;
    public $tb2;

    public function __construct(
        $server = 'sql301.epizy.com',
        $uname = 'epiz_30420621',
        $password = 'mQC1Tza5Ji',
        $db = 'epiz_30420621_squote',
        $tb1 = 'user',
        $tb2 = 'item',
    ) {
        $this->server = $server;
        $this->uname = $uname;
        $this->password = $password;
        $this->db = $db;
        $this->tb1 = $tb1;
        $this->tb2 = $tb2;

        $this->koneksi = mysqli_connect($this->server, $this->uname, $this->password);

        $sql = "CREATE DATABASE IF NOT EXISTS $this->db";
        if (mysqli_query($this->koneksi, $sql)) {
            $this->koneksi = mysqli_connect($this->server, $this->uname, $this->password, $this->db);

            $sql = "CREATE TABLE IF NOT EXISTS $this->tb1(
                    id_user INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    email VARCHAR(50),
                    username VARCHAR(50),
                    pass VARCHAR(255),
                    bio VARCHAR(255),
                    created VARCHAR(50))";

            mysqli_query($this->koneksi, $sql);

            $sql2 = "CREATE TABLE IF NOT EXISTS $this->tb2(
                    id_item INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
                    id_user VARCHAR(100),
                    judul VARCHAR(100),
                    desk VARCHAR(1000),
                    created VARCHAR(50))";

            mysqli_query($this->koneksi, $sql2);
        }
    }
    public function regislogin()
    {
        if (isset($_POST["register"])) {
            $username = htmlspecialchars(strtolower($_POST["username"]));
            if (strlen($username) == 0) {
                $_GET["error1"] = "Masukkan Username";
                return false;
            } else if (strlen($username) < 8) {
                $_GET["error1"] = "Username Minimal 8 Karakter";
                return false;
            } else if (strlen($username) > 16) {
                $_GET["error1"] = "Username Maximal 16 Karakter";
                return false;
            }
            $email = htmlspecialchars(strtolower($_POST["email"]));
            if (strlen($email) == 0) {
                $_GET["error3"] = "Masukkan Email";
                return false;
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_GET["error3"] = "Email Tidak Tervalidasi";
                return false;
            }
            $password = htmlspecialchars($_POST["password"]);
            if (strlen($password) == 0) {
                $_GET["error2"] = "Masukkan Password";
                return false;
            } else if (strlen($password) < 8) {
                $_GET["error2"] = "Password Minimal 8 Karakter";
                return false;
            } else if (strlen($password) > 16) {
                $_GET["error2"] = "Password Maximal 16 Karakter";
                return false;
            }
            $password2 = htmlspecialchars($_POST["password2"]);
            if (strlen($password2) == 0) {
                $_GET["error8"] = "Masukkan Password";
                return false;
            } else if (strlen($password2) < 8) {
                $_GET["error8"] = "Password Minimal 8 Karakter";
                return false;
            } else if (strlen($password2) > 16) {
                $_GET["error8"] = "Password Maximal 16 Karakter";
                return false;
            }
            $created = date("Y-m-d H:i:s");
            $result = mysqli_query($this->koneksi, "SELECT * FROM $this->tb1 WHERE username='$username'");
            if (mysqli_num_rows($result) == 0) {
                if ($password == $password2) {
                    $pw = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO $this->tb1 VALUES(NULL,'$email','$username','$pw',NULL,'$created')";
                    $qry = mysqli_query($this->koneksi, $sql);
                    if ($qry) {
                        echo "<script>alert('Berhasil Mendaftarkan Akun')</script>";
                        echo "<script>location='index.php'</script>";
                        return $qry;
                    }
                } else {
                    echo "<script>alert('Password Konfirmasi Tidak Sesuai')</script>";
                    return false;
                }
            } else {
                echo "<script>alert('Username Telah Digunakan')</script>";
                return false;
            }
        }
        if (isset($_POST["login"])) {
            $username = htmlspecialchars(strtolower($_POST["username"]));
            if (strlen($username) == 0) {
                $_GET["error1"] = "Masukkan Username";
                return false;
            } else if (strlen($username) < 8) {
                $_GET["error1"] = "Username Minimal 8 Karakter";
                return false;
            } else if (strlen($username) > 16) {
                $_GET["error1"] = "Username Maximal 16 Karakter";
                return false;
            }
            $password = htmlspecialchars($_POST["password"]);
            if (strlen($password) == 0) {
                $_GET["error4"] = "Masukkan Password";
                return false;
            } else if (strlen($password) < 8) {
                $_GET["error4"] = "Password Minimal 8 Karakter";
                return false;
            } else if (strlen($password) > 16) {
                $_GET["error4"] = "Password Maximal 16 Karakter";
                return false;
            }
            $result = mysqli_query($this->koneksi, "SELECT * FROM $this->tb1 WHERE username='$username'");
            if (mysqli_num_rows($result) > 0) {
                while ($fetch = mysqli_fetch_assoc($result)) {
                    if ($username == $fetch["username"]) {
                        if (password_verify($password, $fetch["pass"])) {
                            $_SESSION["login"] = $fetch["username"];
                            $_SESSION["id"] = $fetch["id_user"];
                            echo "<script>alert('Berhasil Login')</script>";
                            echo "<script>location='?page=home'</script>";
                        } else {
                            echo "<script>alert('Password Yang Anda Masukkan Salah')</script>";
                            return false;
                        }
                    } else {
                        echo "<script>alert('Username Yang Anda Masukkan Salah')</script>";
                        return false;
                    }
                }
            } else {
                echo "<script>alert('Gagal Login')</script>";
                return false;
            }
        }
    }
    public function kirim($id, $ses)
    {
        if (isset($_POST["kirim"])) {
            $text = htmlspecialchars($_POST["text"]);
            if (strlen($text) == 0) {
                $_GET["error5"] = "Masukkan Text";
                return false;
            } else if (strlen($text) > 1000) {
                $_GET["error5"] = "Text Melebihi Batas";
                return false;
            }
            $created = date("Y-m-d H:i:s");
            $sql = "INSERT INTO $this->tb2 VALUES(NULL,'$id','$ses','$text','$created')";
            $qry = mysqli_query($this->koneksi, $sql);
            if ($qry) {
                return $qry;
            }
        }
    }
    public function get()
    {
        $sql = "SELECT * FROM $this->tb2 ORDER BY RAND()";
        $qry = mysqli_query($this->koneksi, $sql);
        if ($qry) {
            return $qry;
        }
    }
    public function get1($ses)
    {
        $sql = "SELECT * FROM $this->tb1 WHERE username='$ses'";
        $qry = mysqli_query($this->koneksi, $sql);
        if ($qry) {
            return $qry;
        }
    }
    public function get2($id)
    {
        $sql = "SELECT * FROM $this->tb2 WHERE id_user='$id'";
        $qry = mysqli_query($this->koneksi, $sql);
        if ($qry) {
            return $qry;
        }
    }
    public function get6($name)
    {
        $sql = "SELECT * FROM $this->tb2 WHERE judul='$name'";
        $qry = mysqli_query($this->koneksi, $sql);
        if ($qry) {
            return $qry;
        }
    }
    public function get3($id)
    {
        $sql = "SELECT * FROM $this->tb2 WHERE id_item='$id'";
        $qry = mysqli_query($this->koneksi, $sql);
        if ($qry) {
            return $qry;
        }
    }
    public function hapus($id)
    {
        if (isset($_POST["hapus$id"])) {
            $sql = "DELETE FROM $this->tb2 WHERE id_item='$id'";
            $qry = mysqli_query($this->koneksi, $sql);
            if ($qry) {
                echo "<script>location='?page=home'</script>";
            }
        }
    }
    public function edit($id)
    {
        if (isset($_POST["edit$id"])) {
            $text = htmlspecialchars($_POST["text"]);
            if (strlen($text) == 0) {
                $_GET["error7"] = "Masukkan Text";
                return false;
            } else if (strlen($text) > 1000) {
                $_GET["error7"] = "Text Melebihi Batas";
                return false;
            }
            $sql = "UPDATE $this->tb2 SET desk='$text' WHERE id_item='$id'";
            $qry = mysqli_query($this->koneksi, $sql);
            if ($qry) {
                echo "<script>location='?page=home'</script>";
            }
        }
    }
    public function nicetime($date)
    {
        if (empty($date)) {
            return "No date provided";
        }

        $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
        $lengths         = array("60", "60", "24", "7", "4.35", "12", "10");

        $now             = time();
        $unix_date         = strtotime($date);

        // check validity of date
        if (empty($unix_date)) {
            return "Bad date";
        }

        // is it future date or past date
        if ($now > $unix_date) {
            $difference     = $now - $unix_date;
            $tense         = "ago";
        } else {
            $difference     = $unix_date - $now;
            $tense         = "from now";
        }

        for ($j = 0; $difference >= $lengths[$j] && $j < count($lengths) - 1; $j++) {
            $difference /= $lengths[$j];
        }

        $difference = round($difference);

        if ($difference != 1) {
            $periods[$j] .= "s";
        }

        return "$difference $periods[$j] {$tense}";
    }
    public function get4($get)
    {
        $sql = "SELECT * FROM $this->tb1 WHERE username='$get'";
        $qry = mysqli_query($this->koneksi, $sql);
        if ($qry) {
            return $qry;
        }
    }
    public function get5($id)
    {
        $sql = "SELECT * FROM $this->tb1 WHERE id_user='$id'";
        $qry = mysqli_query($this->koneksi, $sql);
        if ($qry) {
            return $qry;
        }
    }
    public function edit2($id, $uname)
    {
        if (isset($_POST["edit$id"])) {
            $text = htmlspecialchars($_POST["text"]);
            if (strlen($text) > 250) {
                $_GET["error10"] = "Text Melebihi Batas";
                return false;
            }
            $sql = "UPDATE $this->tb1 SET bio='$text' WHERE id_user='$id'";
            $qry = mysqli_query($this->koneksi, $sql);
            if ($qry) {
                echo "<script>location='?key=$uname&page=profile'</script>";
            }
        }
    }
}
