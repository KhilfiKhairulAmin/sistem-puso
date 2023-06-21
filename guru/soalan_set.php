<?PHP
# Memanggil header_guru.php
include('header_guru.php');

# ----- bahagian untuk menyimpan data set_soalan baru

# Menyemak kewujudan data POST
if (!empty($_POST)) {
    # Mengambil data POST
    $topiks  =   mysqli_real_escape_string($condb, $_POST['topik']);
    $topik = ltrim($topiks);
    $arahans =   mysqli_real_escape_string($condb, $_POST['arahan']);
    $arahan = ltrim($arahans);
    $jenis  =   $_POST['jenis'];
    $tarikh =   $_POST['tarikh'];
    // $wow;
    # Menetapkan masa Ujian
    if ($jenis == 'Latihan') {
        $masa   =   "Tiada";
        // $wow = "<td><input class='w3-input' type='number' name='masa' placeholder='Dalam minit' min='0' disabled></td>";
    } else {
        $masa   =   mysqli_real_escape_string($condb, $_POST['masa']);
        // $wow = "<td><input class='w3-input' type='number' name='masa' placeholder='Dalam minit' min='0'></td>";
    }

    # menyemak kewujudan data yang diambil
    if (empty($topik) or empty($arahan) or empty($jenis) or empty($tarikh) or empty($masa)) {
        #jika terdapat pembolehubah yang tidak mempunyai nilai, aturcara akan dihentikan
        die("<script>alert('Sila lengkapkan maklumat');
        window.location.href='soalan_set.php';</script>");
    }

    # Arahan untuk menyimpan data set_soalan baru
    $arahan_simpan = "insert into set_soalan
        (topik,arahan,jenis,tarikh,masa,nokp_guru)
        values
        ('$topik','$arahan','$jenis','$tarikh','$masa','".$_SESSION['nokp_guru']."')";

    # Melaksanakan arahan untuk menyimpan data
    if (mysqli_query($condb, $arahan_simpan)) {
        # data berjaya disimpan
        echo "<script>alert('Pendaftaran BERJAYA.');
        window.location.href='soalan_set.php';</script>";
    } else {
        # data gagal disimpan
        echo "<script>alert('Pendaftaran GAGAL.');
        window.location.href='soalan_set.php';
        </script>";
    }
}

?>
<!-- BAHAGIAN MEMAPARKAN SENARAI SET SOALAN -->
<div class='w3-center'>
    <h3>Senarai Set Soalan</h3>
</div>
<?PHP include("../butang_saiz_tulisan.php"); ?>
<div class='w3-responsive'>
    <table border="1" id="besar" class='w3-table-all w3-margin-top'>
        <tr class='w3-blue'>
            <td>Topik</td>
            <td>Arahan</td>
            <td>Jenis</td>
            <td class='w3-center'>Tarikh</td>
            <td>Masa</td>
            <td style="padding-right: 150px !important"></td>
        </tr>
        <tr>
            <!-- BAHAGIAN BORANG UNTUK MENDAFTAR SET SOALAN BAHARU -->
            <form action='' method='POST'>
                <td><textarea class='w3-input' name='topik' rows="4" cols="25"></textarea></td>
                <td><textarea class='w3-input' name='arahan' rows="4" cols="25"></textarea></td>
                <td>
                    <select class="w3-select" name='jenis'>
                        <option value selected disabled>Pilih</option>
                        <option value='Latihan'>Latihan</option>
                        <option value='Ujian'>Ujian</option>
                    </select>
                </td>
                <td><input class="w3-input" type='date' name='tarikh'></td>
                <td><input class="w3-input" type='number' name='masa' placeholder='Minit' min="0" onClick=""></td>
                <td><input class="w3-input w3-border" type='submit' name='simpan'></td>
            </form>
        </tr>

        <?PHP
        # arahan untuk memilih data dari jadual set soalan
        $arahan_set     =   "select* from set_soalan where nokp_guru = '".$_SESSION['nokp_guru']."' order by no_set DESC";

        # melaksanakan arahhan untuk memilih data
        $laksana_set    =   mysqli_query($condb, $arahan_set);


        # pembolehubah $data mengambil data yang ditemui
        while ($data = mysqli_fetch_array($laksana_set)) {
            # mengumpukkan data yang ditemui ke dalam tatasusunan $data_get
            $data_get = array(
                'no_set'    =>  $data['no_set'],
                'topik'     =>  $data['topik'],
                'arahan'    =>  $data['arahan'],
                'jenis'     =>  $data['jenis'],
                'tarikh'    =>  $data['tarikh'],
                'masa'      =>  $data['masa'],
                'nokp_guru' =>  $data['nokp_guru']
            );

            $data["tarikh"] = date("d/m/Y", strtotime($data["tarikh"]));

            if ($data["masa"] !== "Tiada") {
                $init = (int)$data['masa'] * 60;
                $hours = floor($init / 3600);
                $minutes = floor(($init / 60) % 60);
                $seconds = $init % 60;
    
                $hours = "$hours jam";
                if ($hours < 1) $hours = "";
                $minutes = "$minutes minit";
                if ($minutes < 1) $minutes = "";
                $data["masa"] = "$hours $minutes";
            }
            # Memaparkan data yang diambil baris demi baris
            echo "<tr>
        <td>    " . $data['topik'] . "  </td>
        <td>    " . $data['arahan'] . " </td>
        <td>    " . $data['jenis'] . "  </td>
        <td>    " . $data['tarikh'] . " </td>
        <td>    " . $data['masa'] . "  </td>
        <td>

<button class='w3-button w3-white w3-border w3-border-red w3-round-large' onclick=\"location.href='soalan_daftar.php?no_set=" . $data['no_set'] . "&topik=" . $data['topik'] . "'\" type='button'>Soalan</button>
<button class='w3-button w3-white w3-border w3-border-red w3-round-large' onclick=\"location.href='soalan_set_kemaskini.php?" . http_build_query($data_get) . "'\" type='button'>Kemaskini</button>
<button class='w3-button w3-white w3-border w3-border-red w3-round-large' onclick=\"location.href='padam.php?jadual=set_soalan&medan=no_set&kp=" . $data['no_set'] . "'; return confirm('Anda pasti anda ingin memadam data ini.')\" type='button'>Padam</button>

        </td> 
    </tr>";
        }
        ?>
    </table>
    <?PHP include('footer_guru.php'); ?>