<?PHP
include("header_guru.php");

if (!empty($_POST)) {


    $nama = mysqli_real_escape_string($condb, $_POST['nama_baru']);
    $nokp = mysqli_real_escape_string($condb, $_POST['nokp_baru']);
    $katalaluan = mysqli_real_escape_string($condb, $_POST['katalaluan_baru']);
    $id_kelas = $_POST['id_kelas'];

    if (empty($nama) or empty($nokp) or empty($katalaluan) or empty($id_kelas)) {
        die("<script>alert('Sila lengkapkan maklumat');window.history.back();</script>");
    }
    if (strlen($nokp) != 12 or !is_numeric($nokp)) {
        die("<script>alert('Ralat No K/P.');window.history.back();</script>");
    }
    $arahan_simpan = "INSERT INTO murid (nama_murid, nokp_murid, katalaluan_murid, id_kelas) values('$nama', '$nokp', '$katalaluan', '$id_kelas')";

    if (mysqli_query($condb, $arahan_simpan)) {

        echo ("<script>alert('Pendaftaran BERJAYA');window.location.href='murid_senarai.php';</script>");
    } else {

        echo "<script>alert('Pendaftaran GAGAL.');window.location.href='murid_senarai.php';</script>";
    }
}
?>

<div class='w3-center w3-panel'>
    <h3>Senarai Maklumat Murid</h3>
</div>
<?PHP include("../butang_saiz_tulisan.php"); ?>
<a class='w3-button w3-white w3-border w3-border-red w3-round-large' href='murid_upload.php'>[+] Upload Data Murid</a>
<div class='w3-responsive'>
    <table border="1" id="besar" class='w3-table-all w3-margin-top'>

        <tr class='w3-blue'>
            <td>Nama Murid</td>
            <td>No. Kad Pengenalan</td>
            <td>Katalaluan</td>
            <td>Kelas</td>
            <td>Tindakan</td>
        <tr>

            <form action="" method="POST">

                <td><input class='w3-input' type="text" name='nama_baru'></td>
                <td><input class='w3-input' type="text" name='nokp_baru'></td>
                <td><input class='w3-input' type='password' name="katalaluan_baru"></td>
                <td><select class='w3-select' name="id_kelas">
                        <option value selected disabled>Pilih</option>

                        <?PHP

                        $sql = "SELECT * FROM kelas";

                        $laksana_arahan_cari = mysqli_query($condb, $sql);
                        while ($rekod_bilik = mysqli_fetch_array($laksana_arahan_cari)) {
                            echo "<option value='" . $rekod_bilik['id_kelas'] . "'>" . $rekod_bilik['ting'] . " " . $rekod_bilik['nama_kelas'] . "</option>";
                        }

                        ?>

                    </select>

                </td>

                <td><input class='w3-block w3-button w3-white w3-border w3-border-red w3-round-large' type='submit' value='Simpan'></td>
            </form>

        </tr>

        <?PHP

        $arahan_cari_murid = "SELECT * FROM murid, kelas
    WHERE murid.id_kelas = kelas.id_kelas
    ORDER BY kelas.ting, kelas.nama_kelas, murid.nama_murid ASC";

        $laksana_cari_murid = mysqli_query($condb, $arahan_cari_murid);
        while ($data = mysqli_fetch_array($laksana_cari_murid)) {

            $data_murid = array(

                'nama_murid' => $data['nama_murid'],
                'nokp_murid' => $data['nokp_murid'],
                'katalaluan_murid' => $data['katalaluan_murid']
            );

            echo "
    <tr><td>" . $data['nama_murid'] . "</td>
    <td>" . $data['nokp_murid'] . "</td>
    <td>" . $data['katalaluan_murid'] . "</td>
    <td>" . $data['ting'] . " " . $data['nama_kelas'] . "</td>
    <td class='w3-center'>
    
    <a href='murid_kemaskini.php?" . http_build_query($data_murid) . "' title='Kemaskini data'><i class='w3-text-blue w3-xxxlarge fa fa-edit' aria-hidden='true'></i></a>
    <a href='padam.php?jadual=murid&medan=nokp_murid&kp=" . $data['nokp_murid'] . "' onClick=\"return confirm('Anda pasti anda ingin memadam data ini.')\" title='Padam data'> <i class='fa fa-trash w3-xxxlarge w3-text-red' aria-hidden='true'></i></a></td></tr>
    </td>
    </tr>";
        }
        ?>
    </table>
</div>
<?PHP include('footer_guru.php'); ?>