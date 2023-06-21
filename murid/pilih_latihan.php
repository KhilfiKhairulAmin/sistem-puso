<?PHP
# memanggil fail header.php , guard_murid.php dan fail connection.php
include('../header.php');
include('guard_murid.php');
include('../connection.php');

# fungsi untuk mengira markah berdasarkan noset soalan
function markah($no_set, $bil_soalan)
{
    # memanggil fail connection.php dari folder utama
    include('../connection.php');

    # arahan untuk mendapatkan data jawapan murid
    $arahan_markah = "SELECT * 
    FROM set_soalan,soalan,jawapan_murid
    WHERE
        set_soalan.no_set           =   soalan.no_set
    AND soalan.no_soalan            =   jawapan_murid.no_soalan
    AND set_soalan.no_set           =   '$no_set'
    AND jawapan_murid.nokp_murid    =   '" . $_SESSION['nokp_murid'] . "' ";

    # melaksanakan arahan untuk mendapatkan data jawapan
    $laksana_markah = mysqli_query($condb, $arahan_markah);

    # mengira bilangan jawapan
    $bil_jawapan = mysqli_num_rows($laksana_markah);
    $bil_betul = 0;

    # pembolehubah rekod mengambil data yang ditemui semasa laksanakan arahan
    while ($rekod = mysqli_fetch_array($laksana_markah)) {
        # mengira jawapan yang betul
        switch ($rekod['catatan']) {
            case 'BETUL':
                $bil_betul++;
                break;
            default:
                break;
        }
    }

    # mengira peratus jawapan betul
    $peratus = $bil_betul / $bil_soalan * 100;

    # Memaparkan markah dan markah dalam %
    echo "   <td align='right'>$bil_betul/$bil_soalan</td>
            <td align='right'>" . number_format($peratus, 0) . "%</td>";
    $kumpul = $bil_betul . "|" . $bil_soalan . "|" . $peratus . "|" . $bil_jawapan;
    # memulangankan nilai bil betul, bil soalan, peratus dan bilangan jawapan
    return $kumpul;
}
?>

<?PHP include("../butang_saiz_tulisan.php"); ?>

<table border="1" id="besar" class='w3-table-all w3-margin-top'>
    <tr class='w3-blue'>
        <td class='w3-center'>Bil</td>
        <td class='w3-center'>Topik</td>
        <td class='w3-center'>Jenis Soalan</td>
        <td class='w3-center'>Bil. Soalan</td>
        <td class='w3-center'>Markah</td>
        <td class='w3-center'>Peratus</td>
        <td class='w3-center'>Jawapan</td>
    </tr>

    <?PHP
    # Arahan untuk mendapatkan maklumat murid berdasarkan data session[nokp_murid]
    $arahan_cari = "select*from murid 
where 
nokp_murid='" . $_SESSION['nokp_murid'] . "' ";

    # Laksanakan arahan di atas
    $laksana_cari = mysqli_query($condb, $arahan_cari);

    # Mengambil data yang ditemui
    $data_murid = mysqli_fetch_array($laksana_cari);

    # Arahan untuk mencari data set soalan
    $arahan_pilih_latihan = "SELECT 
set_soalan.no_set,
COUNT(soalan.no_soalan) AS bil_soalan, 
topik, jenis
FROM set_soalan, soalan,guru,kelas
WHERE
            set_soalan.no_set   	=   	soalan.no_set
AND         set_soalan.nokp_guru	=	guru.nokp_guru
AND         kelas.nokp_guru 		= 	guru.nokp_guru
AND         kelas.id_kelas 		= 	'" . $data_murid['id_kelas'] . "'
GROUP BY    topik";

    # Melaksanakan arahan untuk mencari data set soalan
    $laksana = mysqli_query($condb, $arahan_pilih_latihan);
    $i = 0;

    # pembolehubah data mengambil setiap data yang ditemui
    while ($data = mysqli_fetch_array($laksana)) {
        # memaparkan data set soalan yang ditemui
        echo "<tr>
    <td>" . ++$i . "</td>
    <td>" . $data['topik'] . "</td>
    <td>" . $data['jenis'] . "</td>
    <td align='center'>" . $data['bil_soalan'] . "</td> ";

        # Memanggil fungsi markah dengan menghantar no set soalan dan bilangan soalan
        $kumpul = markah($data['no_set'], $data['bil_soalan']);

        # memerima dan memecahkan data yang diterima kembali dari fungsi markah
        $pecahkanbaris = explode("|", $kumpul);

        # umpukkan kepada pembolehubah dibawah
        list($bil_betul, $bil_soalan, $peratus, $bil_jawapan) = $pecahkanbaris;

        # menguji bilangan jawapan yang ditemui
        if ($bil_jawapan <= 0) {
            # jika bil jawapan <=0 bermaksud murid belum menjawap soalan
            echo "<td><a href='arahan_latihan.php?no_set=" . $data['no_set'] . "'>Pilih</a></td>";
        } else {

            # jika tidak, murid hanya boleh mengulangkaji semula soalan yang telah dijawap

            echo "<td><a href='ulangkaji.php?no_set=" . $data['no_set'] . "&topik=" . $data['topik'] . "&kumpul=" . $kumpul . "'>Ulangkaji</a></td>";
        }

        echo "</tr>";
    }
    ?>
</table>