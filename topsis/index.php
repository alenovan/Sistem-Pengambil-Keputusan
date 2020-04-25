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
        <a href="../moora">MOORA</a>
        <a class="active" href="../topsis">TOPSIS</a>
        <a href="../electree">ELECTREE</a>
        <a href="../gdss">GDSS</a>
    </div>

    <div class="content">

        <body class="">
            <div>
                <div>
                    <center>
                        <h3>Topsis Dengan {Json}</h3>
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
                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <center>
                                <h3>Normalisasi </h3>
                            </center>
                        </div>
                        <hr>
                        <div id="preview_normalisasi">

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <center>
                                <h3>Normalisasi Dikalikan Bobot</h3>
                            </center>
                        </div>
                        <hr>
                        <div id="preview_bobot">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <center>
                                <h3>Menentukan Solusi Ideal Positif </h3>
                            </center>
                        </div>
                        <hr>
                        <div id="preview_ideal_positif">

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <center>
                                <h3>Menentukan Solusi Ideal Negatif</h3>
                            </center>
                        </div>
                        <hr>
                        <div id="preview_ideal_negatif">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div>
                            <center>
                                <h3>Menghitung jarak Alternatif dengan ideal Positif </h3>
                            </center>
                        </div>
                        <hr>
                        <div id="preview_hitung_positif">

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <center>
                                <h3>Menghitung jarak Alternatif dengan ideal negatif </h3>
                            </center>
                        </div>
                        <hr>
                        <div id="preview_hitung_negatif">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <center>
                                <h3>Menghitung Skor akhir untuk setiap alternatif </h3>
                            </center>
                        </div>
                        <hr>
                        <div id="preview_skor">

                        </div>
                    </div>
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
    var hasilBobot = [];
    var hasilBobot2 = [];
    var bobot = [];
    var idealPositif = [];
    var idealNegatif = [];
    var hasilakhir = [];
    $(function() {
        soalAlternatif = getalt();
        soalCriteria = getCriteria();
        soalPreview();
        normalisasiPreview();
        bobotPreview();
        solusiIdeal();
        perkalianIdeal();
        hasilAkhir();
    });
</script>
<script>
    function solusiIdeal() {
        var data = chunk(hasilBobot, soalAlternatif.length);
        var tblPositif = "<table class='table table-bordered'>";
        $.each(soalCriteria, function(key, value) {
            tblPositif += `<tr>
                            <td>${value.name}</td>`
            if (value.type == "cost") {
                var ideal = Math.min(...data[key])
            } else {
                var ideal = Math.max(...data[key])
            }
            tblPositif += `<td>${ideal}</td>
                          </tr>`;
            idealPositif.push(ideal);
        });
        tblPositif += `</table>`;
        $('#preview_ideal_positif').html(tblPositif);

        var tblNegatif = "<table class='table table-bordered'>";
        $.each(soalCriteria, function(key, value) {
            tblNegatif += `<tr>
                            <td>${value.name}</td>`
            if (value.type == "cost") {
                var ideal = Math.max(...data[key])
            } else {
                var ideal = Math.min(...data[key])
            }
            tblNegatif += `<td>${ideal}</td>
                          </tr>`;
            idealNegatif.push(ideal);
        });
        tblNegatif += `</table>`;
        $('#preview_ideal_negatif').html(tblNegatif);
        // console.log(idealPositif);
        // console.log(idealNegatif);
    }
</script>

<script>
    function perkalianIdeal() {
        var data = chunk(hasilBobot, soalAlternatif.length);
        var alop = -1;
        var tablePositif = "<table class='table table-bordered'>";
        var tableNegatif = "<table class='table table-bordered'>";
        // positif 
        var akardataPos = [],
            akardataNeg = [],
            objPos,
            objNeg;
        for (var i = 0; i <= soalAlternatif.length - 1; i++) {
            alop++;
            objPos = {};
            objNeg = {};
            for (var b = 0; b <= soalAlternatif.length; b++) {
                objPos[b] = Math.pow((idealPositif[b] - data[b][alop]), 2);
            }
            for (var b = 0; b <= soalAlternatif.length; b++) {
                objNeg[b] = Math.pow((idealNegatif[b] - data[b][alop]), 2);
            }
            akardataPos.push(objPos);
            akardataNeg.push(objNeg);
        }
        for (var i = 0; i <= akardataPos.length - 1; i++) {
            tablePositif += `<tr><td>D${i+1}</td><td>${Math.sqrt(sumArray(akardataPos[i])).toFixed(2)}</td></tr>`
        }
        tablePositif += `</table>`;
        $('#preview_hitung_positif').html(tablePositif);
        for (var i = 0; i <= akardataNeg.length - 1; i++) {
            tableNegatif += `<tr><td>D${i+1}</td><td>${Math.sqrt(sumArray(akardataNeg[i])).toFixed(2)}</td></tr>`
        }
        tableNegatif += `</table>`;
        $('#preview_hitung_negatif').html(tableNegatif);

        // console.log(Math.sqrt(sumArray(akardata[1])));

    }
</script>

<script>
    function hasilAkhir() {
        var data = chunk(hasilBobot, soalAlternatif.length);
        var alop = -1;
        var tableAll = "<table class='table table-bordered'>";
        var character = [];
        // positif 
        var akardataPos = [],
            akardataNeg = [],
            objPos,
            objNeg;
        for (var i = 0; i <= soalAlternatif.length - 1; i++) {
            alop++;
            objPos = {};
            objNeg = {};
            for (var b = 0; b <= soalAlternatif.length; b++) {
                objPos[b] = Math.pow((idealPositif[b] - data[b][alop]), 2);
            }
            for (var b = 0; b <= soalAlternatif.length; b++) {
                objNeg[b] = Math.pow((idealNegatif[b] - data[b][alop]), 2);
            }
            akardataPos.push(objPos);
            akardataNeg.push(objNeg);
        }

        for (var i = 0; i <= soalAlternatif.length - 1; i++) {
            var hitung = Math.sqrt(sumArray(akardataNeg[i])) / (Math.sqrt(sumArray(akardataNeg[i])) + Math.sqrt(sumArray(akardataPos[i])))
            tableAll += `<tr><td>V${i+1}</td><td>${hitung.toFixed(2)}</td></tr>`
            character.push(soalAlternatif[i].alternatif)
            hasilakhir.push(hitung.toFixed(2));
        }
        tableAll += `</table>`;
        let index = hasilakhir.indexOf(`${Math.max(...hasilakhir)}`);
        $('#preview_skor').html(tableAll);
        var hasil_akhir = `Skor tertinggi di dapat oleh ${character[index]} dengan nilai ${Math.max(...hasilakhir)}`;
        $('#hasil_akhir').html(hasil_akhir);

        // console.log(hasilakhir);

    }
</script>


<script>
    function soalPreview() {
        var alternatifSoal = ``;
        var criteriaSoal = `<table class="table table-bordered">
                         <tr>
                        <td>#</td>`;
        $.each(soalAlternatif, function(key, value) {
            criteriaSoal += `<td>${value.alternatif}</td>`;
        });
        criteriaSoal += `</tr>`;
        var b = 0;
        var c = 0;
        $.each(soalCriteria, function(i, data) {
            c++;
            if (c % 5) {
                alternatifSoal += `<tr>`;
            }
            alternatifSoal += `<td>${data.name}</td>`;
            $.each(soalAlternatif, function(b, alt) {
                alternatifSoal += `<td>${alt.value[i]}</td>`
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
                            <td>${key+1}</td>
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
        $.each(soalAlternatif, function(key, value) {
            criteriaSoal += `<td>${value.alternatif}</td>`;
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
        // console.log(akardata)
        $.each(soalCriteria, function(i, data) {
            c++;
            alternatifSoal += `<tr>`;
            alternatifSoal += `<td>${data.name}</td>`;
            $.each(soalAlternatif, function(b, alt) {
                var hasil = alt.value[i] / Math.sqrt(sumArray(akardata[i])).toFixed(2);
                alternatifSoal += `<td>${hasil.toFixed(2)} </td>`
            });
            alternatifSoal += `</tr>`
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
        $.each(soalAlternatif, function(key, value) {
            criteriaSoal += `<td>${value.alternatif}</td>`;
        });
        criteriaSoal += `</tr>`;
        var b = 0;
        var c = 0;
        countAkar = -1;
        var akardata = [],
            obj,
            hasilb;
        for (var i = 0; i < soalCriteria.length; i++) {
            obj = {};
            for (var b = 0; b < soalAlternatif.length; b++) {
                obj[b] = Math.pow(soalAlternatif[b].value[i], 2);
            }
            akardata.push(obj);
        }
        // console.log(akardata)
        $.each(soalCriteria, function(i, data) {
            c++;
            alternatifSoal += `<tr>`;
            alternatifSoal += `<td>${data.name}</td>`;
            hasilb = {};
            $.each(soalAlternatif, function(b, alt) {
                alternatifSoal += `<td>${((alt.value[i]/Math.sqrt(sumArray(akardata[i])))*data.bobot).toFixed(2)} </td>`
                hasilb = ((alt.value[i] / Math.sqrt(sumArray(akardata[i]))) * data.bobot).toFixed(2);
                hasilBobot.push(hasilb);
            });
            alternatifSoal += `</tr>`
        });
        alternatifSoal += `</table>`
        var tableSoal = criteriaSoal + alternatifSoal;
        $('#preview_bobot').html(tableSoal);
        // console.log(chunk(hasilBobot, 3));
    }
</script>
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
<script>
    function chunk(array, size) {
        const chunked_arr = [];
        for (let i = 0; i < array.length; i++) {
            const last = chunked_arr[chunked_arr.length - 1];
            if (!last || last.length === size) {
                chunked_arr.push([array[i]]);
            } else {
                last.push(array[i]);
            }
        }
        return chunked_arr;
    }
</script>