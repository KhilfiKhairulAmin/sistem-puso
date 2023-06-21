<?PHP
function timer_Ujian($masa)
{
    $jum_masa=$masa*60*1000;
echo"

<!-- Memaparkan count down masa menjawap -->
<script type=\"text/javascript\">
var wait=setTimeout(\"document.soalan_Ujian.submit();\",".$jum_masa.");
</script>
<div>Masa menjawab : <span id=\"time\">".$masa.":00</span> Minit</div>

<script>
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? \"0\" + minutes : minutes;
        seconds = seconds < 10 ? \"0\" + seconds : seconds;

        display.textContent = minutes + \":\" + seconds;

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

window.onload = function () {
    var Minit = 60 * ".$masa.",
        display = document.querySelector('#time');
    startTimer(Minit, display);
};
</script>";
}
?>