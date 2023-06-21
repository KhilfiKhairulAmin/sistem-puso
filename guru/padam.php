<?PHP
# memulakan fungsi session_start
session_start();

# menyemak kewujudan data GET
if(!empty($_GET))
{
    # memanggil fail connection dari folder utama
    include('../connection.php');

    # mengambil data yang dihantar

    $jadual     =       $_GET['jadual'];
    $medan      =       $_GET['medan'];
    $kp         =       $_GET['kp'];

    # arahan untuk memadam rekod di dalam jadual
    $arahan_padam="delete from $jadual where $medan='$kp'";

    # melaksanakan arahan untuk memadam rekod
    if(mysqli_query($condb, $arahan_padam))
    {
        # data berjaya dipadam
        echo "<script>alert('Data berjaya dipadam!');
        window.history.back(); </script>";
    }
    else
    {
        # data gagal dipadam
        echo "<script>alert('Data tidak berjaya dipadam');
        window.history.back();</script>";
    }
}
else
{
    die("<script>alert('Akses fail tanpa kebenaran');
    window.history.back();</script>");
}
?>