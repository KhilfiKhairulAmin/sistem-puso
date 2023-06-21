<?PHP

    if(empty($_SESSION["nama_murid"])){
        die("<script>alert('Akses tanpa kebenaran. Sila login');
        window.location.href='../index.php';</script>
        ");
    }

?>