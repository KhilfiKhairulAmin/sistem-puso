<?PHP

include("header.php");
include("connection.php");

if (!empty($_POST)) {
    $nama = ltrim(mysqli_real_escape_string($condb, $_POST["nama"]));
    $nokp = ltrim(mysqli_real_escape_string($condb, $_POST["nokp"]));
    $katalaluan = ltrim(mysqli_real_escape_string($condb, $_POST["katalaluan"]));
    $id_kelas = $_POST["id_kelas"];

    if (empty($nama)) {
        die("<script>alert('Sila masukkan nama'); window.history.back();</script>");
    }

    if (empty($nokp)) {
        die("<script>alert('Sila masukkan No K/P'); window.history.back();</script>");
    }

    if (empty($katalaluan)) {
        die("<script>alert('Sila masukkan katalaluan'); window.history.back();</script>");
    }

    if (empty($id_kelas)) {
        die("<script>alert('Sila pilih kelas'); window.history.back();</script>");
    }

    if (!is_numeric($nokp)) {
        die("<script>alert('No K/P hanya menerima nombor.'); window.history.back();</script>");
    } else if (strlen($nokp) < 12) {
        die("<script>alert('No K/P kurang daripada 12 angka.'); window.history.back();</script>");
    } else if (strlen($nokp) > 12) {
        die("<script>alert('No K/P terlebih daripada 12 angka.'); window.history.back();</script>");
    }

    $arahan_simpan = "INSERT INTO murid (nama_murid, nokp_murid, katalaluan_murid, id_kelas) VALUES ('$nama', '$nokp', '$katalaluan', '$id_kelas')";
    $sql_arahan = mysqli_query($condb, $arahan_simpan);

    // $result = $condb->query($arahan_simpan);

    // if ($result->num_rows == 0) {
    //     die("Wrong passwords");
    // } else if ($result->num_rows > 1) {
    //     die("Duplicate user accounts!");
    // } else {
    //     die("Welcome");
    // }

    if ($sql_arahan) {
        echo ("<script>alert('Pendaftaran BERJAYA.'); window.location.href = 'index.php';</script>");
    } else {
        echo ("<script>alert('Pendaftaran GAGAL.'); window.history.back();</script>");
    }
}

?>

<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lobster&effect=shadow-multiple">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<table width="100%">
    <tr>
        <td align="center" width="30%">
            <h3>Pendaftaran Murid Baru</h3>
            <form action="" method="post">
                <label class="w3-text-blue"><b>Nama Murid</b></label>
                <form action="daftar_masuk.php" method="POST">
                    <input class="w3-input loginForm" name="nama" placeholder="Nama penuh" type="text">
                    <label class="w3-text-blue"><b>No K/P Murid</b></label>
                    <input class="w3-input loginForm" type="text" name="nokp" placeholder="(tanpa '-')">
                    <label class="w3-text-blue"><b>Katalaluan</b></label>
                    <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                    <span class="input-group-btn" id="eyeShow" style="display: none;">
                        <button class="btn btn-default reveal" onclick="visibility3()" type="button"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </span>
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
                    <input class="w3-input loginForm" id="login_password" type="password" name="katalaluan" placeholder="***********">
                    <!-- <input class="w3-input loginForm" type="password" name="katalaluan" id="id_password" placeholder="**********"> -->
                    <!-- <i class="far fa-eye" id="togglePassword" style="margin-left: -30px; cursor: pointer; position: relative;bottom: 207px;left: 334px;"></i> -->
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
                    </script> -->
                    <!-- <link rel="stylesheet" type="text/css" href="password_style.css">
                    <script type="text/javascript" src="js/jquery.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#pass").keyup(function() {
                                check_pass();
                            });
                        });

                        function check_pass() {
                            var val = document.getElementById("pass").value;
                            var meter = document.getElementById("meter");
                            var no = 0;
                            if (val != "") {
                                // If the password length is less than or equal to 6
                                if (val.length <= 6) no = 1;

                                // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
                                if (val.length > 6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))) no = 2;

                                // If the password length is greater than 6 and contain alphabet,number,special character respectively
                                if (val.length > 6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))) no = 3;

                                // If the password length is greater than 6 and must contain alphabets,numbers and special characters
                                if (val.length > 6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) no = 4;

                                if (no == 1) {
                                    $("#meter").animate({
                                        width: '50px'
                                    }, 300);
                                    meter.style.backgroundColor = "red";
                                    document.getElementById("pass_type").innerHTML = "Very Weak";
                                }

                                if (no == 2) {
                                    $("#meter").animate({
                                        width: '100px'
                                    }, 300);
                                    meter.style.backgroundColor = "#F5BCA9";
                                    document.getElementById("pass_type").innerHTML = "Weak";
                                }

                                if (no == 3) {
                                    $("#meter").animate({
                                        width: '150px'
                                    }, 300);
                                    meter.style.backgroundColor = "#FF8000";
                                    document.getElementById("pass_type").innerHTML = "Good";
                                }

                                if (no == 4) {
                                    $("#meter").animate({
                                        width: '200px'
                                    }, 300);
                                    meter.style.backgroundColor = "#00FF40";
                                    document.getElementById("pass_type").innerHTML = "Strong";
                                }
                            } else {
                                meter.style.backgroundColor = "white";
                                document.getElementById("pass_type").innerHTML = "";
                            }
                        }
                    </script>
                    </head>
                        <label class="w3-text-blue"><b>Katalaluan</b></label>
                        <input class="w3-input w3-border w3-round-large" id="pass" type="password" name="katalaluan" placeholder="**********" style="width:36%!important">
                        <div id="meter_wrapper">
                            <div id="meter"></div>
                        </div>
                        <br>

                        <span id="pass_type"></span> -->
                    <!-- <label class="w3-text-blue"><b>Kelas</b></label>
        <input class="w3-input w3-border w3-round-large" type="password" name="katalaluan" placeholder="**********" style="width:36%!important"> -->
                    <style>
                        /* #pass {
                            margin-left: 25%;
                            height: 45px;
                            width: 500px;
                            border-radius: 3px;
                            border: 1px solid grey;
                            padding: 10px;
                            font-size: 18px;
                        } */

                        /* #meter_wrapper {
                            border: 1px solid grey;
                            margin-left: 38%;
                            margin-top: 20px;
                            width: 200px;
                            height: 35px;
                            border-radius: 3px;
                        } */

                        /* #meter {
                            width: 0px;
                            height: 35px;
                        } */

                        /* #pass_type {
                            font-size: 20px;
                            margin-top: 20px;
                            margin-left: 45%;
                            text-align: center;
                            color: grey;
                        } */

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

                        ::placeholder {
                            opacity: 0.6;
                        }

                        /* the container must be positioned relative: */
                        .custom-select {
                            position: absolute;
                            font-family: Arial;
                            margin-left: auto;
                            position: absolute;
                            margin-right: auto;
                            left: 0;
                            right: 0;
                        }

                        .custom-select select {
                            display: none;
                            /*hide original SELECT element:*/
                        }

                        .select-selected {
                            background-color: #7a8bf8;
                            border-radius: 8px;
                        }

                        /*style the arrow inside the select element:*/
                        .select-selected:after {
                            position: absolute;
                            content: "";
                            left: 90%;
                            top: 60%;
                            border: 6px solid transparent;
                            border-color: #fff transparent transparent transparent;
                        }

                        /*point the arrow upwards when the select box is open (active):*/
                        .select-selected.select-arrow-active:after {
                            border-color: transparent transparent #fff transparent;
                            top: 27px;
                            border-radius: none !important;
                        }

                        /*style the items (options), including the selected item:*/
                        .select-items div,
                        .select-selected {
                            color: #ffffff;
                            padding: 8px 16px;
                            border: 1px solid transparent;
                            border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
                            cursor: pointer;
                            user-select: none;
                            background-color: #213df3;
                            opacity: 0.6;
                        }

                        /*style items (options):*/
                        .select-items {
                            z-index: 99;
                            max-height: 90px;
                            overflow: overlay;
                            margin-top: 5px;
                            border-radius: 10px 5px 5px 10px;
                        }

                        /*hide the items when the select box is closed:*/
                        .select-hide {
                            display: none;
                        }

                        .select-items div:hover,
                        .same-as-selected,
                        .select-selected:hover {
                            opacity: 1;
                            transition: 0.3s;
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
                            margin: 160px 7px 2px 7px !important;
                        }

                        .button:hover {
                            opacity: 1
                        }
                    </style>
                    <div class="custom-select" id="custom-select" style="width:200px;">
                        <label class="w3-text-blue kelas"><b>Kelas </b></label>
                        <select name="id_kelas" id="id_kelas">
                            <option value selected disable>Pilih</option>
                            <!-- </div> -->
                            <?PHP

                            $sql = "SELECT * FROM kelas";
                            $laksana_arahan_cari = mysqli_query($condb, $sql);

                            while ($rekod_bilik = mysqli_fetch_array($laksana_arahan_cari)) {
                                echo ("<option value =" . $rekod_bilik['id_kelas'] . ">" . $rekod_bilik['ting'] . " " . $rekod_bilik['nama_kelas'] . "</option>");
                            }

                            ?>
                        </select><br>
                    </div>

                    <input class="button" type="submit" value="Daftar">
                    <a class="button" href="index.php">Kembali ke Laman Log Masuk</a>
                </form>

                <?PHP

                mysqli_close($condb);
                include("footer.php");

                ?>
        </td>
    </tr>
</table>

<script>
    var x, i, j, l, ll, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
            /*for each option in the original select element,
            create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function(e) {
                /*when an item is clicked, update the original select box,
                and the selected item:*/
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function(e) {
            /*when the select box is clicked, close any other select boxes,
            and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }

    function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
        except the current select box:*/
        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }
    /*if the user clicks anywhere outside the select box,
    then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);
</script>