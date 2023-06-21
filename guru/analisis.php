<?PHP
# Memanggil fall header guru.php
include("header_guru.php");
?>
<!-- sub tajuk laman -->
<div class='w3-center w3-panel w3-leftbar'>
<h3>Analisis Prestasi Murid</h3> </div>

<div class="w3-row">
  <div class="w3-third w3-container">
    
  </div>
  <div class="w3-third w3-container">
    
    <!-- Borang untuk memilih kelas dan set soalan -->
<form class='w3-margin-top' action='' method='POST'>

<!-- Memaparkan senari kelas yang diajar oleh guru yang sedang login -->
<label class='w3-text-blue'><b>Kelas</b></label>
<select class='w3-select w3-border' name='id_kelas'">
        <option value selected disabled>Pilih</option>
    <?PHP
    if($_SESSION['tahap']=='ADMIN')
    {
    # Jika guru yang sedang login adalah admin
    # arahan untuk mencari semua kelas
    $sql="select* from kelas, guru
    where
    kelas.nokp_guru     =       guru.nokp_guru ";
    }
    else
    {
    # Sebaliknya Jika guru yang sedang login bukan admin
    # arahan untuk mencari semua kelas yang diajar oleh guru tersebut saja
    $sql="select* from kelas, guru
    where       
            kelas.nokp_guru     =   guru.nokp_guru
    and     kelas.nokp_guru     =   '".$_SESSION['nokp_guru']."'";
    }

    # Melaksanakan arahan mencari data
    $laksana_arahan_cari=mysqli_query($condb, $sql);

    #pemboleh ubah $rekod mengambil data yang ditemui baris demi baris
    while ($rekod=mysqli_fetch_array($laksana_arahan_cari))
    {
        # memaparkan data yang ditemui dalam elesient coption></option>
        echo "<option value=".$rekod['id_kelas'].">".$rekod['ting']." ".$rekod['nama_kelas']."</option> ";
    }

?>
</select>
<br>
<!-- memaparkan set soalan yang dipunyai oleh guru -->
<label class='w3-text-blue'><b>Topik</b></label>
<select class='w3-border w3-select' name='no_set'>
    <option value selected disabled>Pilih soalan</option>
    <?PHP
    if($_SESSION['tahap']=='ADMIN'){
        # jika admin
        # paparkan semua set soalan
        $sql2="select* from set_soalan, guru
        where
        set_soalan.nokp_guru=guru.nokp_guru ";
    }
    else{
        # jika bukan admin (ataupun JIKA GURU)
        # arahan untuk memparkan set soalan oleh guru tersebut
        $sql2="select* from set_soalan, guru
        where
        set_soalan.nokp_guru=guru.nokp_guru
        and
        set_soalan.nokp_guru='".$_SESSION['nokp_guru']."' ";
    }

    # Melaksanakan arahan mencari data
    $laksana_arahan_cari2=mysqli_query($condb, $sql2);

    # pembolehubah $rekod mengambil data yang ditemui baris demi baris
    while($rekod2=mysqli_fetch_array($laksana_arahan_cari2)){
        # memaparkan data yang ditemui dalam element <option></option>
        echo "<option value=".$rekod2['no_set'].">".$rekod2['topik']."</option>";
    }
    ?>
</select>
<br>
<input class='w3-block w3-center w3-margin-top w3-button w3-white w3-border w3-border-red w3-round-large' type='submit' value='Papar Keputusan'>
</form>

  </div>
  <div class="w3-third w3-container">
    
  </div>
</div>

<?PHP

#------BAHAGIAN MEMAPARKAN SENARAI NAMA MURID, SKOR DAN JUMLAH MARKAH --------------

# menyemak kewujudan data POST (tingkatan dan topik latihan) yang dihantar melalui borang diatas
if(!empty($_POST)){
    # mengambil nilai POST
    $id_kelas=$_POST['id_kelas'];
    $no_set=$_POST['no_set'];

    # Bahagian untuk mendapatkan nama kelas berdasarkan id_kelas
    $arahan_kelas="select* from kelas where id_kelas='$id_kelas'";
    $laksana_kelas      =       mysqli_query($condb, $arahan_kelas);
    $data1              =       mysqli_fetch_array($laksana_kelas);
    $nama_kelas         =       "".$data1['ting']." ".$data1['nama_kelas']."";

    # Bahagian mendapatkan nama kelas berdasarkan id_kelas
    #arahan untuk mencari semua data set_soalan berdasarkan no_set yang dipilih
    $arahan_topik="select* from set_soalan where no_set='$no_set'";

    #melaksanakan arahan untuk mencari di atas
    $laksana_topik=mysqli_query($condb,$arahan_topik);

    #mengambil data set_soalan yang ditemui
    $data2=mysqli_fetch_array($laksana_topik);

    #umpukan data topik
    $nama_topik=$data2['topik'];

    #arahan sql untuk memilih pelajar berdasarkan id_kelas
    $arahan_pilih="select* from murid, kelas
    where murid.id_kelas='$id_kelas'
    and
    kelas.id_kelas='$id_kelas'";

    #melaksanakan arahan untuk memilih pelajar
    $laksana_pilih=mysqli_query($condb, $arahan_pilih);

    #jika bil rekod yang ditemui lebih besar atau sama dengan satu
    if(mysqli_num_rows($laksana_pilih)>=1){
        #papar maklumat carian nama kelas dan topik
        echo "
        <br>Kelas : $nama_kelas
        <br>Topik : $nama_topik
        <br><button onclick='window.print()'><i class='w3-xxxlarge fa fa-print aria-hidden='true'></i></button>";
        include('../butang_saiz_tulisan.php');
        echo"<div class='w3-reponsive'>
             <table border='1' id='besar' class='w3-table-all w3-hoverable w3-margin-top'>
        <tr class='w3-green'>
            <td>Nama Murid</td>
            <td>Nokp Murid</td>
            <td>Skor</td>
            <td>Markah</td>
        </tr>";
    }
    else{
        echo "Tiada data dalam kelas ini.";
    }

# fungsi skor menerima data no_set soalan dan nokp_murid
function skor($no_set,$nokp_murid){
    # memanggil fail connection dari folder luaran
    include('../connection.php');

    # arahan unutk mendapatkan data jawapan murid berdasarkan set_soalan dan nokp_murid
    $arahan_skor="SELECT* FROM jawapan_murid,set_soalan,soalan
    WHERE
            set_soalan.no_set       =       soalan.no_set
    AND     jawapan_murid.no_soalan =       soalan.no_soalan
    AND     jawapan_murid.nokp_murid=       '$nokp_murid'
    AND     set_soalan.no_set       =       '$no_set'
    ";

    # melaksanakan arahan di atas
    $laksana_skor=mysqli_query($condb, $arahan_skor);

    # mengambil bil jawapan yang ditemui
    $bil_jawapan=mysqli_num_rows($laksana_skor);
    $bil_betul=0;

# jika bil jawapan >= 1
if($bil_jawapan>=1){
    #pemboleh ubah rekod mengambil data yang ditemui
    while($rekod=mysqli_fetch_array($laksana_skor)){
        # mengira bil jawapan yang betul
        switch($rekod['catatan']){
            case 'BETUL'        :   $bil_betul++;break;
            default             :   break;
        }
        $topik=$rekod['topik']; #kalau ada error kat line ni, comment semua code kt line ni
    }

    # mengira markah berdasarkan bil jawapan betul
    $markah=$bil_betul/$bil_jawapan*100;

    # memaparkan skor dan jumlah dalam %

    echo"
    <td>".$bil_betul." / ".$bil_jawapan."</td>
    <td>".number_format($markah,0)." %</td>
    ";
}
else
echo "<td>Belum Jawab</td><td></td>";

}

#mengambil data yang ditemui
while($data=mysqli_fetch_array($laksana_pilih)){
    #memaparkan data baris demi baris
    echo "<tr>
    <td>".$data['nama_murid']."</td>
    <td>".$data['nokp_murid']."</td>";

    #memanggil funsi skor di atas
    skor($no_set,$data['nokp_murid']);
echo "</tr>";
}
}
?>
</table>
<?PHP include('footer_guru.php'); ?>