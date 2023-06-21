<?PHP
# memanggil fail header.php
include("header.php"); ?>

<head>
    <title>KingQuiz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <style>
        .w3-lobster {
            font-family: "Lobster", Sans-serif;
        }
    </style>
</head>

<body>
    <!-- antara muka untuk daftar masuk / login -->
    <table width="100%">
        <tr>
            <td align="center" width="30%">
                <h3>Maklumat Pengguna</h3>
                <label class="w3-text-blue"><b>No K/P</b></label>
                <form action="daftar_masuk.php" method="POST">
                    <input class="w3-input loginForm" name="nokp" placeholder="123456789012" type="text">

                    <label class="w3-text-blue"><b>Katalaluan</b></label>
                    <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                    <span class="input-group-btn" id="eyeShow" style="display: none;">
                        <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </span>
                    <input class="w3-input loginForm" type="password" name="katalaluan" id="login_password" placeholder="**********">
                    <!-- <input class="w3-input loginForm" type="password" name="katalaluan" id="id_password" placeholder="**********"> -->
                    <!-- <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; position: relative;bottom: 53px;left: 268px;"></i> -->
                    <script>
                        function visibility3() {
                            var x = document.getElementById('login_password');
                            if (x.type === 'password') {
                                x.type = "text";
                                $('#eyeShow').show();
                                $('#eyeSlash').hide();
                            } else {
                                x.type = "password";
                                $('#eyeShow').hide();
                                $('#eyeSlash').show();
                            }
                        }
                    </script>
                    <!-- <script>
                        const togglePassword = document.querySelector('#togglePassword');
                        const password = document.querySelector('#id_password');

                        togglePassword.addEventListener('click', function(e) {
                            // toggle the type attribute
                            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                            password.setAttribute('type', type);
                            // toggle the eye slash icon
                            this.classList.toggle('fa-eye-slash');
                        });
                    </script>
                    -->
                    <style> 
                        ::placeholder {
                            opacity: 0.6;
                        }
                    </style>
                    Kategori
                    <input type="radio" class="w3-radio" name="jenis" value="murid">
                    <label class="w3-text-blue"><b>Murid</b></label>
                    <input type="radio" class="w3-radio" name="jenis" value="guru">
                    <label class="w3-text-blue"><b>Guru</b></label>
                    <br><br>
                    <style>
                        .w3-radio {
                            cursor: pointer;
                        }

                        .loginForm {
                            text-align: center;
                            width: 300px;
                            border-bottom: 2.5px solid #2196F3;
                            opacity: 0.6;
                        }

                        .loginForm:hover,
                        .loginForm:focus {
                            outline: none;
                            opacity: 1;
                        }

                        button,
                        input,
                        select,
                        textarea,
                        optgroup {
                            font: inherit;
                            margin: 7px 0px;
                        }

                        .button {
                            background-color: #213df3 !important;
                            border: none;
                            color: white;
                            padding: 12px 18px;
                            text-align: center;
                            border-radius: 27px;
                            font-size: 16px;
                            opacity: 0.6;
                            transition: 0.3s;
                            display: inline-block;
                            text-decoration: none;
                            cursor: pointer;
                            margin: 4px 2px;
                        }

                        .button:hover {
                            opacity: 1
                        }
                    </style>
                    <input class="button" type="submit" value="Login">
                    <!-- pautan untuk mendaftar murid baru -->
                    <br><a class="button" href="daftar_akaun_baharu.php">Daftar Murid Baharu</a>
                </form>
            </td>
        </tr>
    </table>
    </td>
    </tr>
    <div>
        <td>
            <!--Senarai set latihan terkini -->
            <p class="w3-center">Senarai Set Soalan Terkini</p>
            <table border="1" class='w3-table-all' style="width: 40%; margin: auto;">
                <tr class="w3-blue">
                    <td>Topik</td>
                    <td>Kelas</td>
                    <td>Nama Guru</td>
                    <td class='w3-center'>Tarikh</td>
                </tr>
                <tr>
                    <?PHP

                    include("connection.php");

                    if (mysqli_connect_errno()) {
                        printf("Connect failed: %s\n", mysqli_connect_error());
                        exit();
                    }

                    $arahanLatihan = "SELECT * FROM set_soalan, guru, kelas
                            WHERE set_soalan.nokp_guru = guru.nokp_guru
                            AND kelas.nokp_guru = guru.nokp_guru
                            ORDER BY set_soalan.tarikh DESC LIMIT 10";

                    $laksanaLatihan = mysqli_query($condb, $arahanLatihan);
                    
                    while ($rekod = mysqli_fetch_array($laksanaLatihan)) {
                        $rekod["tarikh"] = date("d/m/Y", strtotime($rekod["tarikh"]));
                        echo ("<tr><td>" . $rekod['topik'] . "</td><td>" . $rekod["ting"] . " " . $rekod["nama_kelas"] . "</td><td>" . $rekod["nama_guru"] . "</td><td>" . $rekod["tarikh"] . "</td></tr>");
                    }

                    mysqli_close($condb);
                    ?>
                </tr>
        </td>
        </table>
    </div>
</body>

<?PHP
# memanggil fail footer.php
// include("footer.php");
?>