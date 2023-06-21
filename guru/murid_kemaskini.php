<?PHP
# memanggil file header guru
include('header_guru.php');

# menyemak kewujudan data GET untuk mengelakkan fail diakses tanpa GET
if (empty($_GET)) {
    die("<script>alert('Akses tanpa kebenaran.');
    window.location.href='murid_senarai.php';</script>");
}

if (!empty($_POST)) {
    # mengambil data baru yang diubah suai melalui borang di bawah
    $nama       =   mysqli_real_escape_string($condb, $_POST['nama_baru']);
    $nokp       =   mysqli_real_escape_string($condb, $_POST['nokp_baru']);
    $katalaluan =   mysqli_real_escape_string($condb, $_POST['katalaluan_baru']);
    $id_kelas   =   $_POST['id_kelas'];

    # menyemak kewujudan data yang diambil
    if (empty($nama) or empty($nokp) or empty($katalaluan) or empty($id_kelas)) {
        # data tidak wujud. aturcara tamat di sini.
        die("<script>alert('Sila lengkapkan maklumat');
        window.history.back();</script>");
    }

    # Has atas & bawah, pengesahan data bagi nokp_murid
    if (strlen($nokp) != 12 or !is_numeric($nokp)) {
        die("<script>alert('No KP anda mengandungi kesilapan. Tolong isikan semula.');
        window.history.back();</script>");
    }

    # arahan untuk mengemaskini data murid
    $arahan_kemaskini = "update murid set
    nama_murid      =   '$nama',
    nokp_murid      =   '$nokp',
    katalaluan_murid=   '$katalaluan',
    id_kelas        =   '$id_kelas'
    where
    nokp_murid      =   '" . $_GET['nokp_murid'] . "' ";

    # melaksanakan arahan untuk menyimpan data murid ke dalam jaduan
    if (mysqli_query($condb, $arahan_kemaskini)) {
        # data berjaya dikemaskini
        echo "<script>alert('Data telah dikemaskini');
        window.location.href='murid_senarai.php';</script>";
    } else {
        # data gagal dikemaskini
        echo "<script>alert('Kemaskini GAGAL');
        window.location.href='murid_senarai.php';</script>";
    }
}
?>

<!-- Bahagian memaparkan Senarai Murid -->
<div class='w3-center w3-panel '>
    <h3>Senarai Murid</h3>
</div>
<!-- membesarkan tulisan pengguna -->
<?PHP include("../butang_saiz_tulisan.php"); ?>
<!-- link untuk memuat naik fail data murid-->
<br>
<br>
<a class='w3-left w3-button w3-white w3-border w3-border-red w3-round-large' href='murid_upload.php'>[+] Upload Data Murid</a>
<br><br>
<div class='w3-reponsive'>
    <table border="1" id="besar" class='w3-table-all w3-margin-top'>
        <tr class='w3-blue'>
            <td>Nama Murid</td>
            <td>NoKP murid</td>
            <td>Katalaluan murid</td>
            <td>Kelas</td>
            <td>Tindakan</td>
        </tr>
        <tr>
            <!-- borang untuk mendaftar murid baru -->
            <form action='' method='POST'>
                <td><input class='w3-input' type='text' name='nama_baru' value='<?PHP echo $_GET['nama_murid']; ?>'></td>
                <td><input class='w3-input' type='text' name='nokp_baru' value='<?PHP echo $_GET['nokp_murid']; ?>'></td>
                <td><input class='w3-input' type='password'  name='katalaluan_baru' value='<?PHP echo $_GET['katalaluan_murid']; ?>'></td>
                <!-- borang untuk mendaftar murid baharu -->
                <form action='' method='POST'>
                    <!-- RECHECK DI SINI -->

                    <td>
                        <select class="w3-select" name='id_kelas'>
                            <option value selected disable>Pilih</option>
                            <?PHP
                            # arahan untuk mencari semua data dari jadual kelas
                            $sql = "select* from kelas";

                            # Melaksanakan arahan mencari data
                            $laksana_arahan_cari = mysqli_query($condb, $sql);

                            # pemboleh ubah $rekod_bilik mengambil data yang ditemui baris demi baris
                            while ($rekod_bilik = mysqli_fetch_array($laksana_arahan_cari)) {
                                # memaparkan data yang ditemui dalam element <option></option>
                                echo "<option value=" . $rekod_bilik['id_kelas'] . ">
                    " . $rekod_bilik['ting'] . " " . $rekod_bilik['nama_kelas'] . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td><input class='w3-button w3-white w3-border w3-border-red w3-round-large' type='submit' value='simpan'></td>
                </form>
        </tr>

        <?PHP
        # arahan untuk mencari semua data murid yang berdaftar
        $arahan_cari_murid = "select* from murid, kelas
where
murid.id_kelas=kelas.id_kelas
order by kelas.ting, kelas.nama_kelas,murid.nama_murid ASC";

        # melaksanakan arahan untuk mencari
        $laksana_cari_murid = mysqli_query($condb, $arahan_cari_murid);

        # pembolehubah $data mengambil semua data yang ditemui
        while ($data = mysqli_fetch_array($laksana_cari_murid)) {
            # mengumpukan data murid kedalam tatasusunan data_murid
            $data_murid = array(
                'nama_murid'        =>  $data['nama_murid'],
                'nokp_murid'        =>  $data['nokp_murid'],
                'katalaluan_murid'  =>  $data['katalaluan_murid']
            );
            # memaparkan data murid demi baris
            echo "
    <tr>
        <td>" . $data['nama_murid'] . "</td>
        <td>" . $data['nokp_murid'] . "</td>
        <td>" . $data['katalaluan_murid'] . "</td>
        <td>" . $data['ting'] . " " . $data['nama_kelas'] . "</td>
        <td>
        <a href='murid_kemaskini.php?" . http_build_query($data_murid) . "' title='Kemaskini data'><i class='w3-text-blue w3-xxxlarge fa fa-edit' aria-hidden='true'></i> </a>
        <a href='padam.php?jadual=murid&medan=nokp_murid&kp=" . $data['nokp_murid'] . "' title='Padam data'> <i class='fa fa-trash w3-xxxlarge w3-text-red' aria-hidden='true'></i></a> </td></tr>
    </tr>
    ";
        }
        ?>
    </table>
</div>
<?PHP include('footer_guru.php'); ?>