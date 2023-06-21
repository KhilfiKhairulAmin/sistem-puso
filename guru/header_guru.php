<?PHP

session_start();

include("guard_guru.php");
include("../connection.php");

if (empty($_SESSION["tahap"])) {

  $arahan_semak_tahap = "SELECT * FROM guru WHERE nokp_guru = '" . $_SESSION['nokp_guru'] . "'LIMIT 1";
  $laksana_semak_tahap = mysqli_query($condb, $arahan_semak_tahap);
  $data = mysqli_fetch_array($laksana_semak_tahap);
  $_SESSION["tahap"] = $data["tahap"];
}
?>

<!doctype HTML>
<html>

<head>
  <title>BAHAGIAN PENGURUSAN</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="../w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
  <style>
    .w3-tajuk {
      font-family: "Lobster", Sans-serif;
    }
  </style>
</head>

<body class='w3'>
  <!-- kalau guna image, pastikan location letak '../' di depan -->

  <!-- header -->
  <div class="w3-container" style="background-color:#2196F3 !important;">
    <h1 class="w3-xxxlarge w3-text-white" align='center'><b>
        <?PHP if ($_SESSION['tahap'] == 'ADMIN') { ?>
          <a href='guru_senarai.php' style="text-decoration: none"> ADMIN <i class="fa fa-address-book" aria-hidden="true"></i></a>
        <?PHP } ?>
        <?PHP if ($_SESSION['tahap'] == 'GURU') { ?>
          <a href='index.php' style="text-decoration: none"> GURU <i class="fa fa-book" aria-hidden="true"></i> </a>
        <?PHP } ?>
  </div>

  <!-- menu -->
  <div class="w3-bar w3-text-white" style="background-color:#2149f3!important;">
    <?PHP if (!empty($_SESSION) and basename($_SERVER["PHP_SELF"])) { ?>
      <?PHP echo "<a href='index.php' style='text-decoration: none'><span class='w3-bar-item'><i class='fa fa-user-circle w3-large' aria-hidden='true'></i> " . ucwords(strtolower($_SESSION['nama_guru'])) . "</span></a>"; ?>
    <?PHP } ?>
    <a href="index.php" class="w3-bar-item w3-button">UTAMA</a>
    <a href="../logout.php" class="w3-bar-item w3-button w3-right"><b>Daftar Keluar</b> <i class='fa fa-sign-out w3-large' aria-hidden="true"></i></a>

    <?PHP if ($_SESSION['tahap'] == 'ADMIN') { ?>
      <div class="w3-dropdown-hover">
        <button class="w3-button">Admin</button>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href="guru_senarai.php" class="w3-bar-item w3-button">Pengurusan Guru</a>
          <a href="murid_senarai.php" class="w3-bar-item w3-button">Pengurusan Murid</a>
          <a href="senarai_kelas.php" class="w3-bar-item w3-button">Pengurusan Kelas</a>
        </div>
  </div>
<?PHP } ?>
  <div class="w3-dropdown-hover">
    <button class="w3-button">Guru</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="soalan_set.php" class="w3-bar-item w3-button">Pengurusan Soalan</a>
      <a href="analisis.php" class="w3-bar-item w3-button">Analisis Keputusan</a>
    </div>
  </div>
  </div>

</body>

<!-- isi kandungan -->