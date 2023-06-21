<br>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<script>
    function resizeText(multiplier) {

        var elem = document.getElementById("besar");
        var currentSize = elem.style.fontSize || 1;

        if (multiplier == 2) {
            elem.style.fontSize = "1em"
        } else {
            elem.style.fontSize = Clamp((parseFloat(currentSize) + (multiplier * 0.1)), 1, 2) + "em";
        }
    }

    function Clamp(value, minValue, maxValue) {
        if (value <= minValue) {
            return minValue;
        } else if (value >= maxValue) {
            return maxValue;
        } else {
            return value;
        }
    }
</script>
<div style='left: 15px; position:relative;'>
    Ubah saiz tulisan
    <input class='w3-button w3-white w3-border w3-border-red w3-round-large' type="button" value="Reset" name="reSize1" onclick="resizeText(2)" />
    <input class='w3-button w3-white w3-border w3-border-red w3-round-large' type="button" value="&nbsp;+&nbsp;" name="reSize" onclick="resizeText(1)" />
    <input class='w3-button w3-white w3-border w3-border-red w3-round-large' type="button" value="&nbsp;-&nbsp;" onclick="resizeText(-1)" />
</div>