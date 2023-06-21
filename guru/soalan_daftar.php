<?PHP
# memanggil fail header_guru.php
include('header_guru.php');

# BAHAGIAN MENYIMPAN DATA SOALAN BAHARU
# menyemak kewujudan data POST
if(!empty($_POST)) {
    # mengambil data POST
    $soalan            =   ltrim(mysqli_escape_string($condb, $_POST['soalan']));
    $jawapan_a         =   ltrim(mysqli_escape_string($condb, $_POST['jawapan_a']));
    $jawapan_b         =   ltrim(mysqli_escape_string($condb, $_POST['jawapan_b']));
    $jawapan_c         =   ltrim(mysqli_escape_string($condb, $_POST['jawapan_c']));
    $jawapan_d         =   ltrim(mysqli_escape_string($condb, $_POST['jawapan_d']));

    # menguji jika soalan yang dihasilkan mempunyai gambar
    if ($_FILES['gambar']['size'] != 0) {
        # bahagian memuatnaik gamabar soalan
        $timestmp           =   date("Y-m-dhisA");
        $saiz_fail          =   $_FILES['gambar']['size'];
        $nama_fail          =   basename($_FILES["gambar"]["name"]);
        $jenis_gambar       =   pathinfo($nama_fail, PATHINFO_EXTENSION);
        $lokasi             =   $_FILES['gambar']['tmp_name'];
        $nama_baru_gambar   =   "../images/" . $timestmp . "." . $jenis_gambar;
        move_uploaded_file($lokasi, $nama_baru_gambar);

        # arahan untuk menyimpan soalan yang mempunyai gambar
        $arahan_simpan = "insert into soalan
        (no_set,soalan,gambar,jawapan_a,jawapan_b,jawapan_c,jawapan_d)
        values
        ('" . $_GET['no_set'] . "','$soalan','$nama_baru_gambar','$jawapan_a','$jawapan_b','$jawapan_c','$jawapan_d')";
    } else {
        # arahan untuk menyimpan soalan yang tidak mempunyai gambar
        $arahan_simpan = "INSERT INTO soalan
        (no_set,soalan,gambar,jawapan_a,jawapan_b,jawapan_c,jawapan_d)
        VALUES
        ('" . $_GET['no_set'] . "','$soalan',' ','$jawapan_a','$jawapan_b','$jawapan_c','$jawapan_d')";
    }

    # menyemak kewujudan data soalan dan jawapan
    if (empty($soalan) or empty($jawapan_a) or empty($jawapan_b) or empty($jawapan_c) or empty($jawapan_d)) {
        die("<script>alert('Sila lengkapkan maklumat anda');
        window.history.back();</script>");
    }

    # melaksanakan arahan untuk menyimpan soalan
    if (mysqli_query($condb, $arahan_simpan)) {
        # data soalan berjaya disimpan
        echo "<script>alert('Pendaftaran berjaya!');
        window.location.href='soalan_daftar.php?no_set=" . $_GET['no_set'] . "&topik=" . $_GET['topik'] . "';</script>";
    } else {
        # data soalan gagal disimpan
        echo "<script>alert('Pendaftaran tidak berjaya.');
        window.history.back();</script>";
    }
}
?>
<!-- BAHAGIAN MEMAPARKAN SOALAN YANG TELAH DIDAFTARKAN -->
<div class='w3-center w3-panel'>
    <h3>Senarai Soalan</h3>
</div>
<?PHP include("../butang_saiz_tulisan.php"); ?>
<div class='w3-responsive'>
    <table border="1" id="besar" class='w3-table-all w3-margin-top'>
        <tr class='w3-blue'>
            <td>Soalan</td>
            <td>Gambar</td>
            <td>Jawapan A (Betul)</td>
            <td>Jawapan B</td>
            <td>Jawapan C</td>
            <td>Jawapan D</td>
            <td></td>
        </tr>
        <tr>
            <!-- BORANG UNTUK MENDAFTAR SOALAN BAHARU -->
            <form action='' method='POST' enctype='multipart/form-data'>
                <td><textarea name='soalan' rows="4" cols="25"></textarea></td>
                <td><input type='file' name='gambar'></td>
                <td><textarea name='jawapan_a' rows="4" cols="25"></textarea></td>
                <td><textarea name='jawapan_b' rows="4" cols="25"></textarea></td>
                <td><textarea name='jawapan_c' rows="4" cols="25"></textarea></td>
                <td><textarea name='jawapan_d' rows="4" cols="25"></textarea></td>
                <td><input class="w3-input w3-border" type='submit' value='simpan'></td>
            </form>
        </tr>

        <?PHP
        # arahan mencari soalan berdasarkan set soalan
        $arahan_soalan = "select* from soalan
where no_set    =   '" . $_GET['no_set'] . "'
order by no_soalan DESC";

        # laksana arahan mencari soalan berdasarkan set soalan
        $laksana_soalan = mysqli_query($condb, $arahan_soalan);

        # mengambil data soalan yang ditemui
        while ($data = mysqli_fetch_array($laksana_soalan)) {
            # mengumpukkan data soalan
            $data_get = array(
                'no_set'       =>  $data['no_set'],
                'no_soalan'    =>  $data['no_soalan'],
                'topik'        =>  $_GET['topik'],
                'soalan'       =>  $data['soalan'],
                'jawapan_a'    =>  $data['jawapan_a'],
                'jawapan_b'    =>  $data['jawapan_b'],
                'jawapan_c'    =>  $data['jawapan_c'],
                'jawapan_d'    =>  $data['jawapan_d'],
            );

            # memaparkan soalan yang ditemui
            echo "<tr>
            <td>" . $data['soalan'] . "</td>
            <td><img src='" . $data['gambar'] . "' width='50%'></td>
            <td>" . $data['jawapan_a'] . "</td>
            <td>" . $data['jawapan_b'] . "</td>
            <td>" . $data['jawapan_c'] . "</td>
            <td>" . $data['jawapan_d'] . "</td>
            <td class='w3-center'>
                <a href='soalan_kemaskini.php?" . http_build_query($data_get) . "' title='Kemaskini data'><i class='w3-text-blue w3-xxxlarge fa fa-edit' aria-hidden='true'></i></a>
                <a href='padam.php?jadual=soalan&medan=no_soalan&kp=" . $data['no_soalan'] . "'
                onClick=\"return confirm('Anda yakin ingin memadam data ini?')\" title='Padam data'><i class='fa fa-trash w3-xxxlarge w3-text-red' aria-hidden='true'></i></a>
            </td>
          </tr>";
        }
        ?>
    </table>
    </div>
    <?PHP include('footer_guru.php'); ?>