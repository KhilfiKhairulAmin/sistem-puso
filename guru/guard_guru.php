<?PHP
# Menyemak kewujudan data pada pembolehubah session
if(empty($_SESSION['nama_guru']))
{
    # menghentikan sistem dan terus ke fail index.php
    die("<script>alert('Akses tanpa kebenaran. Sila login');
         window.location.href='../index.php';</script>
        ");
}
