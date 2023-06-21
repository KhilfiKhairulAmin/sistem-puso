<?PHP include("header_guru.php"); ?>

<hr>
<div class='w3-center w3-panel'>
    <h3>Senarai Ujian & Latihan Terkini</h3>
</div>

<table border="1" class='w3-table-all w3-margin-top'>
    <tr class="w3-blue">
        <td class='w3-center'>Topik</td>
        <td class='w3-center'>Kelas</td>
        <td class='w3-center'>Nama Guru</td>
        <td class='w3-center'>Tarikh</td>
    </tr>
    <?PHP

    # Arahan untuk mencari data guru, kelas dan set_soalan
    $arahan_latihan = "SELECT* FROM set_soalan, guru, kelas
    WHERE
                set_soalan.nokp_guru        =       guru.nokp_guru
    AND         kelas.nokp_guru             =       guru.nokp_guru
    ORDER BY    set_soalan.tarikh DESC ";

    # Melaksanakan arahan carian di atas
    $laksana_latihan = mysqli_query($condb, $arahan_latihan);

    #mengambil data dan memaparkan semula data tersebut
    while ($rekod = mysqli_fetch_array($laksana_latihan)) {
        $rekod["tarikh"] = date("d/m/Y", strtotime($rekod["tarikh"]));
        echo "
        <tr>
            <td>" . $rekod['topik'] . "</td>
            <td>" . $rekod['ting'] . " " . $rekod['nama_kelas'] . "</td>
            <td>" . $rekod['nama_guru'] . "</td>   
            <td>" . $rekod['tarikh'] . "</td>           
        </tr>";
    }
    ?>
</table>

<?PHP include("footer_guru.php"); ?>