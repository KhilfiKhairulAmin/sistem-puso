<?PHP
    include("../header.php");
    include("../connection.php");

    if(empty($_GET)){
        die("<script>alert('Akses tanpa kebenaran');
        window.location.href = 'pilih_latihan.php';</script>");
    }

    $arahan_pilih_set = "SELECT * FROM set_soalan WHERE no_set='".$_GET["no_set"]."'";
    $laksana = mysqli_query($condb, $arahan_pilih_set);
    $data = mysqli_fetch_array($laksana);
?>

<div class="w3-row w3-margin-top">
  <div class="w3-quarter w3-container">
  </div>
  <div class="w3-half w3-container w3-center w3-card">
    <!-- Memaparkan arahan untuk menjawab soalan -->
    <h3>Arahan</h3>
    <hr>
    <?PHP echo $data["arahan"]; ?><br>
    <!-- <a class='w3-margin-bottom w3-button w3-white w3-border w3-border-red w3-round-large w3-block' href='jawab_soalan.php.php?no_set=<?PHP echo $_GET['no_set']; ?> &masa=<?PHP echo $data['masa']; ?>&jenis = <?PHP echo $data['jenis']; ?>'>Mula</a> -->
    <a class='w3-margin-bottom w3-button w3-white w3-border w3-border-red w3-round-large w3-block' href='jawab_soalan.php?no_set=<?PHP echo $_GET['no_set']; ?>&masa=<?PHP echo $data['masa']; ?>&jenis=<?PHP echo $data['jenis']; ?>'>Mula</a>

  </div>
  <div class="w3-quarter w3-container">
  </div>
</div>
