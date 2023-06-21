<?PHP

include("header_guru.php");

if ($_SESSION['tahap'] == 'ADMIN') {
    if (!empty($_POST)) {

        $nama = mysqli_real_escape_string($condb, $_POST["nama_baru"]);
        $nokp = mysqli_real_escape_string($condb, $_POST["nokp_baru"]);
        $katalaluan = mysqli_real_escape_string($condb, $_POST["katalaluan_baru"]);
        $tahap = $_POST["tahap"];

        if (empty($nama) or empty($nokp) or empty($katalaluan)  or empty($tahap)) {
            die("<script>alert('Sila lengkapkan maklumat'); window.history.back();</script>");
        }

        if(!is_numeric($nokp)){
            die("<script>alert('No K/P hanya menerima nombor.'); window.history.back();</script>");
        }else if (strlen($nokp) < 12) {
            die("<script>alert('No K/P kurang daripada 12 angka.'); window.history.back();</script>");
        }else if (strlen($nokp) > 12) {
            die("<script>alert('No K/P terlebih daripada 12 angka.'); window.history.back();</script>");
        }

        $arahan_simpan = "INSERT INTO guru(nama_guru,nokp_guru,katalaluan_guru,tahap) VALUES('$nama', '$nokp', '$katalaluan', '$tahap')";

        if (mysqli_query($condb, $arahan_simpan)) {
            echo ("<script>alert('Pendaftaran BERJAYA'); window.location.href = 'guru_senarai.php';</script>");
        } else {
            echo ("<script>alert('Pendaftaran GAGAL'); window.location.href = 'guru_senarai.php';</script>");
        }
    }

?>

    <div class='w3-center w3-panel'>
        <h3>Senarai Maklumat Guru</h3>
    </div>
    <?PHP include("../butang_saiz_tulisan.php"); ?>
    <div class='w3-reponsive'>
        <table border="1" id="besar" class='w3-table-all w3-margin-top'>
            <tr class='w3-blue'>
                <td>Nama Guru</td>
                <td>No. Kad Pengenalan</td>
                <td>Katalaluan</td>
                <td>Tahap</td>
                <td>Tindakan</td>
            </tr>
            <tr>

                <form action="" method="post">
                    <td><input class="w3-input" type="text" name="nama_baru"></td>
                    <td><input class="w3-input" type="text" name="nokp_baru"></td>
                    <td><input class="w3-input" type="password" name="katalaluan_baru"></td>
                    <td>
                        <select class="w3-select w3-border" name="tahap">
                            <option value selected disabled>Pilih</option>
                            <option value="GURU">GURU</option>
                            <option value="ADMIN">ADMIN</option>
                        </select>
                    </td>
                    <td><input class='w3-block w3-button w3-white w3-border w3-border-red w3-round-large' type='submit' value='simpan'></td>
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
            echo ("<tr><td>" . $data["nama_guru"] . "</td><td>" . $data["nokp_guru"] . "</td><td>" . $data["katalaluan_guru"] . "</td><td>" . $data["tahap"] . "</td><td class='w3-center'> <a href='guru_kemaskini.php?" . http_build_query($data_guru) . "' title='Kemaskini Data'><i class='w3-text-blue w3-xxxlarge fa fa-edit'></i></a>
        <a href='padam.php?jadual=guru&medan=nokp_guru&kp=" . $data['nokp_guru'] . "'onClick=\"return confirm('Sebelum memadam data guru, pastikan beliau tidak mempunyai kelas terlebih dahulu')\" title='Padam Data'><i class='fa fa-trash w3-xxxlarge w3-text-red' aria-hidden='true'></i></a> </td></tr>");
        }
    } else {
        die("<script>alert('Admin sahaja dibenarkan melakukan tindakan tersebut.'); window.location.href='index.php';</script>");
    }
        ?>
    </div>
    </table>