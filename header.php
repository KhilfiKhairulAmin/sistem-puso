<?PHP
#memulakan fungsi session_start bagi emmbolehkan pembolehubah super global
#session digunakan
session_start();
?>

<head>
    <!-- Tajuk Sistem -->
    <title>Daftar Akaun</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
</head>
<div class="w3-container" style="background-color:#2196F3 !important;">
    <h1 class="w3-xxxlarge w3-text-white" align='center'><b>
            
            <?PHP if (basename($_SERVER["PHP_SELF"]) != "index.php") { ?>
                <a href="index.php" style="text-decoration: none">MURID <i class='fa fa-graduation-cap' aria-hidden='true'></i></a>
            <?PHP } else { ?>
                <a href="index.php" style="text-decoration: none"><img src='Logo1.png' alt='LOGO SISTEM' width='200' ></a>
            <?PHP } ?>
</div>

<!-- menu -->
<div class="w3-bar w3-text-white" style="background-color:#2149f3!important;">

    <!-- Menu Bahagian Murid-->
    <?PHP if (basename($_SERVER["PHP_SELF"]) == "daftar_akaun_baharu.php") { ?>
        <span class='w3-bar-item'>Daftar sebagai murid baharu dalam PUSO</span>
    <?PHP } else if (!empty($_SESSION) and basename($_SERVER["PHP_SELF"]) != "index.php") { ?>
        <?PHP echo "<span class='w3-bar-item'><a style='text-decoration: none' href='pilih_latihan.php'><i class='fa fa-user-circle-o w3-large' aria-hidden='true'></i> " . ucwords(strtolower($_SESSION['nama_murid'])) . "</a></span>"; ?>
        <?PHP
        // include("../connection.php");
        // $arahan_cari_kelas = "select* from kelas, murid
        //         where
        //         kelas." . $_SESSION['nokp_murid'] . "        =   murid." . $_SESSION['nokp_murid'];

        // # melaksanakan arahan untuk mencari data
        // $laksana_cari_kelas = mysqli_query($condb, $arahan_cari_kelas);

        // while ($rekod = mysqli_fetch_array($laksana_cari_kelas)) {
        //     echo "<span class='w3-bar-item'>Nama Kelas : " . $rekod["nama_kelas"]. "</span>";
        // }
        ?>
        <!--<a class="w3-bar-item w3-button" href='pilih_latihan.php'></a>-->
        <a class="w3-bar-item w3-button w3-right" href='../logout.php'>Daftar Keluar <i class='fa fa-sign-out' aria-hidden='true'></i></a>
    <?PHP } else
        echo "<span class =' w3-bar-item'>Selamat datang ke sistem Pengurusan Ujian Sekolah Online (PUSO)</span>";
    ?>
</div>
<hr>

<style>
    html {
        overflow: overlay;
    }

    ::-webkit-scrollbar {
        width: 7px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
        border-radius: 7px;
        /* box-shadow: inset 0 0 6px rgba(0,0,0,0.25);  */
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /*
</style>