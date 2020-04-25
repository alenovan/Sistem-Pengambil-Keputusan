<!DOCTYPE html>
<html>

<head>
    <title>WP dengan {JSON}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            margin: 0;
            font-family: "Lato", sans-serif;
        }

        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #f1f1f1;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        .sidebar a {
            display: block;
            color: black;
            padding: 16px;
            text-decoration: none;
        }

        .sidebar a.active {
            background-color: #4CAF50;
            color: white;
        }

        .sidebar a:hover:not(.active) {
            background-color: #555;
            color: white;
        }

        div.content {
            margin-left: 200px;
            padding: 1px 16px;
            height: 1000px;
        }

        @media screen and (max-width: 700px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .sidebar a {
                float: left;
            }

            div.content {
                margin-left: 0;
            }
        }

        @media screen and (max-width: 400px) {
            .sidebar a {
                text-align: center;
                float: none;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="#home">Home</a>
        <a href="../saw">SAW</a>
        <a href="../wp">WP</a>
        <a href="../ahp">AHP</a>
        <a class="active" href="../moora">MOORA</a>
        <a href="../topsis">TOPSIS</a>
        <a href="../electree">ELECTREE</a>
        <a href="../gdss">GDSS</a>
    </div>

    <div class="content" style="padding: 15px">

        <div>
            <div>
                <center>
                    <h3>Moora Dengan {Json}</h3>
                </center>
                <hr>
            </div>
            <div>
                <center>
                    <h3>Soal</h3>
                </center>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div id="criteria"></div>
                </div>
                <div class="col-sm-6">
                    <div id="preview_soal"></div>
                </div>
            </div>
            <hr>

            <div>
                <center>
                    <h3>Membuat Matrix Normalisasi X*ij</h3>
                </center>
            </div>
            <div id="preview_normalisasi">

            </div>
            <hr>
            <div>
                <center>
                    <h3>Dikalikan Bobot</h3>
                </center>
            </div>
            <div id="preview_kalibobot">

            </div>

            <hr>
            <div>
                <center>
                    <h3>Preview penyelesaian</h3>
                </center>
            </div>
            <div id="preview_penyelesaian">

            </div>
            <hr>
            <div>
                <center>
                    <h3>Hasil Keputusan untuk 5 peserta teratas yang layak sebagai penerima bantuan BPJS untuk masyarakat ekonomi rendah</h3>
                </center>
            </div>
            <div>
                <h3 id="hasil_akhir" style="color:green"></h3>
            </div>
        </div>

</body>

</html>

<script>
    var soalCriteria = [];
    var soalAlternatif = [];
    var bobot = [];
    $(function() {
        soalAlternatif = getalt();
        soalCriteria = getCriteria();
        soalPreview();
        normalisasiPreview();
        bobotPreview();
        penyelesaianPreview();
    });
</script>

<script>
    function soalPreview() {
        var alternatifSoal = ``;
        var criteriaSoal = `<table class="table table-bordered">
                         <tr>
                        <td>#</td>`;
        $.each(soalCriteria, function(key, value) {
            criteriaSoal += `<td>${value.name}</td>`;
        });
        criteriaSoal += `</tr>`;
        var b = 0;
        var c = 0;
        $.each(soalAlternatif, function(i, data) {
            c++;
            // console.log(c);
            if (c % 5) {
                alternatifSoal += `<tr>`;
            }
            alternatifSoal += `<td>${data.alternatif}</td>`;
            $.each(soalCriteria, function(b, criteria) {
                alternatifSoal += `<td>${data.value[b]}</td>`
            });
            if (c % 5) {
                alternatifSoal += `</tr>`
            }
        });
        alternatifSoal += `</table>`
        var tableSoal = criteriaSoal + alternatifSoal;
        $('#preview_soal').html(tableSoal);

        var tblBobot = `<table class="table table-bordered">
                        <tr><td>No</td><td>Criteria</td><td>Bobot</td></tr>`;
        $.each(soalCriteria, function(key, value) {
            bobot.push(value.bobot);
            tblBobot += `<tr>
                            <td>${value.code}</td>
                            <td>${value.name}</td>
                            <td>${value.bobot}</td>
                          </tr>`;
        });
        tblBobot += `</table>`;
        $('#criteria').html(tblBobot);
    }
</script>

<script>
    function normalisasiPreview() {
        var alternatifSoal = ``;
        var criteriaSoal = `<table class="table table-bordered">
                         <tr>
                        <td>#</td>`;
        $.each(soalCriteria, function(key, value) {
            criteriaSoal += `<td>${value.name}</td>`;
        });
        criteriaSoal += `</tr>`;
        var b = 0;
        var c = 0;
        countAkar = -1;
        var akardata = [],
            obj;
        for (var i = 0; i < soalCriteria.length; i++) {
            obj = {};
            for (var b = 0; b < soalAlternatif.length; b++) {
                obj[b] = Math.pow(soalAlternatif[b].value[i], 2);
            }
            akardata.push(obj);
        }
        $.each(soalAlternatif, function(i, data) {
            c++;
            // console.log(c);
            if (c % 5) {
                alternatifSoal += `<tr>`;
            }
            alternatifSoal += `<td>${data.alternatif}</td>`;
            $.each(soalCriteria, function(b, criteria) {
                alternatifSoal += `<td>${(data.value[b]/Math.sqrt(sumArray(akardata[b]))).toFixed(3)}</td>`
            });
            if (c % 5) {
                alternatifSoal += `</tr>`
            }
        });
        alternatifSoal += `</table>`
        var tableSoal = criteriaSoal + alternatifSoal;
        $('#preview_normalisasi').html(tableSoal);
    }
</script>

<script>
    function bobotPreview() {
        var alternatifSoal = ``;
        var criteriaSoal = `<table class="table table-bordered">
                         <tr>
                        <td>#</td>`;
        $.each(soalCriteria, function(key, value) {
            criteriaSoal += `<td>${value.name}</td>`;
        });
        criteriaSoal += `</tr>`;
        var b = 0;
        var c = 0;
        countAkar = -1;
        var akardata = [],
            obj;
        for (var i = 0; i < soalCriteria.length; i++) {
            obj = {};
            for (var b = 0; b < soalAlternatif.length; b++) {
                obj[b] = Math.pow(soalAlternatif[b].value[i], 2);
            }
            akardata.push(obj);
        }
        $.each(soalAlternatif, function(i, data) {
            c++;
            // console.log(c);
            if (c % 5) {
                alternatifSoal += `<tr>`;
            }
            alternatifSoal += `<td>${data.alternatif}</td>`;
            $.each(soalCriteria, function(b, criteria) {
                alternatifSoal += `<td>${((data.value[b]/Math.sqrt(sumArray(akardata[b]))) * bobot[b]).toFixed(3)}</td>`
            });
            if (c % 5) {
                alternatifSoal += `</tr>`
            }
        });
        alternatifSoal += `</table>`
        var tableSoal = criteriaSoal + alternatifSoal;
        $('#preview_kalibobot').html(tableSoal);
    }
</script>

<script>
    function penyelesaianPreview() {
        var alternatifSoal = ``;
        var criteriaSoal = `<table class="table table-bordered">
                         <tr>
                        <td>#</td>
                        <td>Max(Benefits)</td>
                        <td>Min(Cost)</td>
                        <td>Nilai</td>`;

        criteriaSoal += `</tr>`;
        var b = 0;
        var c = 1;
        countAkar = -1;
        var totalCost = [];
        var totalBenefits = [];
        var countB = -1;
        var countC = 0;
        var bc = -1,
            cb = 0;
        var akardata = [],
            obj,
            objBen,
            objCost;
        for (var i = 0; i < soalCriteria.length; i++) {
            obj = {};
            if (soalCriteria[i].type == "benefits") {
                countB++;
            } else {
                countC++;
            }
            for (var b = 0; b < soalAlternatif.length; b++) {
                obj[b] = Math.pow(soalAlternatif[b].value[i], 2);
            }
            akardata.push(obj);
        }
        // console.log(akardata);
        for (var b = 0; b < soalAlternatif.length; b++) {
            objBen = {};
            objCost = {};
            for (var i = 0; i < soalCriteria.length; i++) {
                if (soalCriteria[i].type == "benefits") {
                    bc++;
                    objBen[bc] = (((soalAlternatif[b].value[i] / Math.sqrt(sumArray(akardata[i]))) * bobot[i])).toFixed(3);
                } else {
                    cb++;
                    objCost[cb] = (((soalAlternatif[b].value[i] / Math.sqrt(sumArray(akardata[i]))) * bobot[i])).toFixed(3);
                }
                if (bc == countB) {
                    bc = 0;
                }
                if (cb == countC) {
                    cb = 0;
                }
            }
            totalBenefits.push(objBen);
            totalCost.push(objCost);
        }
        console.log(totalBenefits);
        alternatifSoal += ``;
        var sort = [];
        var nilai = [];
        var characters = [];
        for (var i = 0; i < totalBenefits.length; i++) {
            alternatifSoal += `<tr><td>${soalAlternatif[i].alternatif}</td>`;
            alternatifSoal += `<td>${totalBenefits[i][i]}</td>`;
            alternatifSoal += `<td>${sumArrayC(totalCost[i],countC).toFixed(3)}</td>`;
            alternatifSoal += `<td>${(totalBenefits[i][i]-sumArrayC(totalCost[i],countC)).toFixed(3)}</td></tr>`;
            characters.push(`${soalAlternatif[i].alternatif}`);
            sort.push((totalBenefits[i][i] - sumArrayC(totalCost[i], countC)).toFixed(3));
            nilai.push((totalBenefits[i][i] - sumArrayC(totalCost[i], countC)).toFixed(3));
        }


        var hasil_akhir = "<table class='table table-bordered'><tr>";
        alternatifSoal += `</table>`
        var topValues = sort.sort((a, b) => b - a).slice(0, 5);
        var tableSoal = criteriaSoal + alternatifSoal;
        $.each(topValues, function(i, data) {
            let index = nilai.indexOf(`${data}`);
            hasil_akhir += `<td>Peseta terpilih nomor ${i+1} adalah ${characters[index]} dengan nilai <br><div style="color:orange">${nilai[index]}</div></td>`;
        });
        $('#preview_penyelesaian').html(tableSoal);
        $('#hasil_akhir').html(hasil_akhir + "</tr>" + "</table>");
    }

    function sortNumber(a, b) {
        return a - b;
    }
</script>




<!-- Library  -->
<script>
    function getCriteria() {
        var criteriaAll = [];
        $.ajax({
            async: false,
            dataType: 'json',
            url: "json/criteria.json",
            type: 'GET',
            success: function(data) {
                for (var i in data) {
                    criteriaAll[i] = {
                        name: data[i].name,
                        bobot: data[i].bobot,
                        type: data[i].type,
                        code: data[i].code
                    }

                }
            }
        });
        return criteriaAll;
    }
</script>

<script>
    function getalt() {
        var altAll = [];
        $.ajax({
            async: false,
            dataType: 'json',
            url: "json/data.json",
            type: 'GET',
            success: function(data) {
                for (var i in data) {
                    altAll[i] = {
                        code: data[i].code,
                        alternatif: data[i].alternatif,
                        criteria: data[i].criteria,
                        value: data[i].value
                    }

                }
            }
        });
        return altAll;
    }
</script>

<script>
    function sumArray(a) {
        var total = 0;
        for (var i in a) {
            total += a[i];
        }
        return total;
    }

    function sumArrayC(a, count) {
        var total = 0;
        for (i = 1; i <= count; i++) {
            total += parseFloat(a[i]);
            // console.log(parseFloat(a[i]));
        }
        return total;
    }
</script>