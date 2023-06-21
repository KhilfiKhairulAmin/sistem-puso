<?PHP 

session_start();

include("guard_guru.php");
include("../connection.php");

if(empty($_SESSION["tahap"])){

    $arahan_semak_tahap = "SELECT * FROM guru WHERE nokp_guru = '".$_SESSION['nokp_guru']."'LIMIT 1";
    $laksana_semak_tahap = mysqli_query($condb, $arahan_semak_tahap);
    $data = mysqli_fetch_array($laksana_semak_tahap);
    $_SESSION["tahap"] = $data["tahap"];
}
?>

<!doctype HTML>
<html>
  <head>
       <title>Portal Login</title>
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
       <link rel="stylesheet" href="w3.css">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
  <style>
     .w3-tajuk {
           font-family: "Lobster", Sans-serif;
  }
  </style>
  </head>

<body class='w3-pink'> <!-- kalau guna image, pastikan location letak '../' di depan -->

<!-- header -->
<div class='w3-container w3-black'>
<h1 class="w3-tajuk w3-xxxlarge font-effect-shadow-multiple w3-text-teal"><b>
    <i class="fa fa-camera-retro" aria-hidden="true"></i>
    Bahagian Guru / Admin
    <i class="fa fa-book" aria-hidden="true"></i>
</b></h1>
</div>

<!-- menu -->
<div class="w3-bar w3-black">
  <a href="index.php" class="w3-bar-item w3-button">Laman Utama</a>
  <a href="../logout.php" class="w3-bar-item w3-button w3-right">Log Keluar</a>

  <?PHP if($_SESSION['tahap']=='ADMIN'){ ?>
  <div class="w3-dropdown-hover">
    <button class="w3-button">Admin</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="guru_senarai.php" class="w3-bar-item w3-button">Maklumat Guru</a>
      <a href="murid_senarai.php" class="w3-bar-item w3-button">Pengurusan Murid</a>
      <a href="senarai_kelas.php" class="w3-bar-item w3-button">Pengurusan Kelas</a>
    </div>
  </div>
</div>
<?PHP } ?>

<div class="w3-dropdown-hover">
    <button class="w3-button">Guru</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4">
      <a href="soalan_set.php" class="w3-bar-item w3-button">Pengurusan Soalan</a>
      <a href="analisis.php" class="w3-bar-item w3-button">Analisis Prestasi</a>
    </div>
  </div>
</div>

<div class='w3-container'>
    <p>Isi Kandungan</p>
</div>

<?PHP mysqli_close($condb); ?>

</body>
</html>