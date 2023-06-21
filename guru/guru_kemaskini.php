<?PHP

include("header_guru.php");

if (empty($_GET)) {
    die("<script>alert('Akses tanpa kebenaran.'); window.location.href = 'murid_senarai.php';</script>");
}

if (!empty($_POST)) {

    $nama = mysqli_real_escape_string($condb, $_POST["nama_baru"]);
    $nokp = mysqli_real_escape_string($condb, $_POST["nokp_baru"]);
    $katalaluan = mysqli_real_escape_string($condb, $_POST["katalaluan_baru"]);
    $tahap = $_POST["tahap"];

    if (empty($nama) or empty($nokp) or empty($katalaluan) or  empty($tahap)) {
        die("<script>alert('Sila lengkapkan maklumat'); window.history.back();</script>");
    }

    if (strlen($nokp) != 12 or !is_numeric($nokp)) {
        die("<script>alert('Ralat No K/P.); window.history.back();</script>");
    }

    # arahan untuk mengemaskini data guru
    $arahan_kemaskini = "update guru set
    nama_guru           =   '$nama',
    nokp_guru           =   '$nokp',
    katalaluan_guru     =   '$katalaluan',
    tahap               =   '$tahap'
    where
    nokp_guru           =   '" . $_GET['nokp_guru'] . "'";

    # melaksanakan arahan untuk mengemaskini data guru ke dalam jadual
    if (mysqli_query($condb, $arahan_kemaskini)) {
        # data berjaya dikemaskini
        echo "<script>alert('Kemaskini BERJAYA.');
        window.location.href='guru_senarai.php';</script>";
    } else {
        # data gagal dikemaskini
        echo "<script>alert('Kemaskini GAGAL.');
        window.location.href='guru_senarai.php';</script>";
    }
}

?>

<div class='w3-center w3-panel'>
    <h3>Kemaskini Maklumat Guru</h3>
</div>
<?PHP include("../butang_saiz_tulisan.php"); ?>
<div class='w3-reponsive'>
    <table border="1" id="besar" class='w3-table-all w3-margin-top'>
</div>
<tr class='w3-blue'>
    <td>Nama</td>
    <td>Nokp</td>
    <td>Katalaluan</td>
    <td>Tahap</td>
    <td>Tindakan</td>
</tr>
<tr>
    <form action="" method="post">
        <td><input class='w3-input' type="text" name="nama_baru" value='<?PHP echo $_GET["nama_guru"]; ?>'></td>
        <td><input class='w3-input' type="text" name="nokp_baru" value='<?PHP echo $_GET["nokp_guru"]; ?>'></td>
        <td>
            <!-- <button class="btn btn-default reveal" onclick="visibility3()" type="button" style="position: absolute;"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
            <span class="input-group-btn" id="eyeShow" style="display: none;">
                <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
            </span> -->
            <!-- <input class='w3-input' type="password" name="katalaluan_baru" value="<?PHP echo $_GET['katalaluan_guru']; ?>"> -->
            <input class='w3-input' type="text" name="katalaluan_baru" value="<?PHP echo $_GET['katalaluan_guru']; ?>">
        </td>
        <td>
            <select class='w3-select' name="tahap">
                <option value selected disabled>Pilih</option>
                <option value="GURU">GURU</option>
                <option value="ADMIN">ADMIN</option>
            </select>
        </td>
        <td><input class='w3-block w3-button w3-white w3-border w3-border-red w3-round-large' type="submit" value="kemaskini"></td>
    </form>
</tr>
<?PHP

$arahan_cari_guru = "SELECT * FROM guru ORDER BY tahap ASC";
$laksana_cari_guru = mysqli_query($condb, $arahan_cari_guru);

while ($data = mysqli_fetch_array($laksana_cari_guru)) {

    $data_guru = array(
        "nama_guru" => $data["nama_guru"],
        "nokp_guru" => $data["nokp_guru"],
        "katalaluan_guru" => $data["katalaluan_guru"]
    );

    echo ("<tr><td>" . $data["nama_guru"] . "</td><td>" . $data["nokp_guru"] . "</td><td>" . $data["katalaluan_guru"] . "</td><td>" . $data["tahap"] . "</td><td class='w3-center'> <a href='guru_kemaskini.php?" . http_build_query($data_guru) . "' title='Kemaskini data'><i class='w3-text-blue w3-xxxlarge fa fa-edit'></i></a>
            <a href='padam.php?jadual=guru&medan=nokp_guru&kp=" . $data['nokp_guru'] . "'onClick=\"return confirm('Sebelum memadam data guru, pastikan beliau tidak mempunyai kelas terlebih dahulu')\" title='Padam data'> <i class='fa fa-trash w3-xxxlarge w3-text-red' aria-hidden='true'></i></a> </td></tr>");
}

?>
</table>
</div>