<!DOCTYPE html>
<html>

<head>
    <title>AHP dengan {JSON}</title>
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
        <a class="active" href="../ahp">AHP</a>
        <a href="../moora">MOORA</a>
        <a href="../topsis">TOPSIS</a>
        <a href="../electree">ELECTREE</a>
        <a href="../gdss">GDSS</a>
    </div>

    <div class="content">

        <body class="">
            <div>
                <div>
                    <center>
                        <h3>AHP Dengan {Json}</h3>
                    </center>
                </div>
                <div id="div_data_criteria" style="display: block"></div>
                <div id="div_data_pangsa" style="display: block"></div>
                <div id="div_data_pendapatan" style="display: block"></div>
                <div id="div_data_infrastruktur" style="display: block"></div>
                <div id="div_data_transportasi" style="display: block"></div>
                <center>
                    <h3>Hasil Akhir</h3>
                </center>
                <div id="hasil_perhitungan">

                </div>

                <div id="hasil_perhitungan_perkalian">

                </div>
                <div>
                    <h1 style="color:green">Hasil Akhir : <label id="done"></label></h1>
                </div>
            </div>

        </body>

</html>

<script>
    var dataCriteria = [];
    var dataAlternatif = [];
    var pwCriteria = [];
    var pwA1 = [];
    var pwA2 = [];
    var pwA3 = [];
    var pwA4 = [];
    var hasilFinal = [];
    var datari = [0.00, 0.00, 0.00, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49, 1, 51]
    $(document).ready(function() {
        // criteria
        var code1 = "criteria";
        div_data(code1);
        var criteriaAll = [];
        criteriaAll = getCriteria("json/criteriaahp.json");
        for (var i = 0; i < criteriaAll.length; i++) {
            dataCriteria.push(criteriaAll[i].name);
        }
        soal(criteriaAll, `table_soal_${code1}`, code1);
        normalisasi(criteriaAll, `table_normalisasi_${code1}`, code1, `table_soal_${code1}`);
        matrix(criteriaAll, `table_matrix_${code1}`, code1);
        perhitungan(criteriaAll, `table_perhitungan_${code1}`, code1);
        var count = 0;
        for (var i = 0; i < criteriaAll.length; i++) {
            $(`#soal_${code1}` + i).html(sumColumn(i + 1, `table_soal_${code1}`))
            count++;
        }
        $(`#mat0_${code1}`).html(sumTable(0), `table_matrix_${code1}`)
        $(`#mat1_${code1}`).html(sumTable(2), `table_matrix_${code1}`)
        sumRow(count, `table_normalisasi_${code1}`, code1);
        sumMatrix(code1, `table_soal_${code1}`);
        // end criteraia

        // start A1
        var code1 = "pangsa";
        div_data(code1);
        var criteriaAll = [];
        criteriaAll = getCriteria("json/criteriaPangsa.json");
        for (var i = 0; i < criteriaAll.length; i++) {
            dataAlternatif.push(criteriaAll[i].name);
        }
        soal(criteriaAll, `table_soal_${code1}`, code1);
        normalisasi(criteriaAll, `table_normalisasi_${code1}`, code1, `table_soal_${code1}`);
        matrix(criteriaAll, `table_matrix_${code1}`, code1);
        perhitungan(criteriaAll, `table_perhitungan_${code1}`, code1);
        var count = 0;
        for (var i = 0; i < criteriaAll.length; i++) {
            $(`#soal_${code1}` + i).html(sumColumn(i + 1, `table_soal_${code1}`))
            count++;
        }
        $(`#mat0_${code1}`).html(sumTable(0), `table_matrix_${code1}`)
        $(`#mat1_${code1}`).html(sumTable(2), `table_matrix_${code1}`)
        sumRow(count, `table_normalisasi_${code1}`, code1);
        sumMatrix(code1, `table_soal_${code1}`);
        // end AI

        // 3
        var code1 = "pendapatan";
        div_data(code1);
        var criteriaAll = [];
        criteriaAll = getCriteria("json/criteriaTingkatPendapatan.json");
        soal(criteriaAll, `table_soal_${code1}`, code1);
        normalisasi(criteriaAll, `table_normalisasi_${code1}`, code1, `table_soal_${code1}`);
        matrix(criteriaAll, `table_matrix_${code1}`, code1);
        perhitungan(criteriaAll, `table_perhitungan_${code1}`, code1);
        var count = 0;
        for (var i = 0; i < criteriaAll.length; i++) {
            $(`#soal_${code1}` + i).html(sumColumn(i + 1, `table_soal_${code1}`))
            count++;
        }
        $(`#mat0_${code1}`).html(sumTable(0), `table_matrix_${code1}`)
        $(`#mat1_${code1}`).html(sumTable(2), `table_matrix_${code1}`)
        sumRow(count, `table_normalisasi_${code1}`, code1);
        sumMatrix(code1, `table_soal_${code1}`);
        // end AI

        // start A3
        var code1 = "infrastruktur";
        div_data(code1);
        var criteriaAll = [];
        criteriaAll = getCriteria("json/criteriaInfrastruktur.json");
        soal(criteriaAll, `table_soal_${code1}`, code1);
        normalisasi(criteriaAll, `table_normalisasi_${code1}`, code1, `table_soal_${code1}`);
        matrix(criteriaAll, `table_matrix_${code1}`, code1);
        perhitungan(criteriaAll, `table_perhitungan_${code1}`, code1);
        var count = 0;
        for (var i = 0; i < criteriaAll.length; i++) {
            $(`#soal_${code1}` + i).html(sumColumn(i + 1, `table_soal_${code1}`))
            count++;
        }
        $(`#mat0_${code1}`).html(sumTable(0), `table_matrix_${code1}`)
        $(`#mat1_${code1}`).html(sumTable(2), `table_matrix_${code1}`)
        sumRow(count, `table_normalisasi_${code1}`, code1);
        sumMatrix(code1, `table_soal_${code1}`);
        // end A3

        // start A4
        var code1 = "transportasi";
        div_data(code1);
        var criteriaAll = [];
        criteriaAll = getCriteria("json/criteriaTransportasi.json");
        soal(criteriaAll, `table_soal_${code1}`, code1);
        normalisasi(criteriaAll, `table_normalisasi_${code1}`, code1, `table_soal_${code1}`);
        matrix(criteriaAll, `table_matrix_${code1}`, code1);
        perhitungan(criteriaAll, `table_perhitungan_${code1}`, code1);
        var count = 0;
        for (var i = 0; i < criteriaAll.length; i++) {
            $(`#soal_${code1}` + i).html(sumColumn(i + 1, `table_soal_${code1}`))
            count++;
        }
        $(`#mat0_${code1}`).html(sumTable(0), `table_matrix_${code1}`)
        $(`#mat1_${code1}`).html(sumTable(2), `table_matrix_${code1}`)
        sumRow(count, `table_normalisasi_${code1}`, code1);
        sumMatrix(code1, `table_soal_${code1}`);
        // end A4

        getAllPw();
        sumRow(count, `hasil_perhitungan_perkalian`, "all");
        // $('#done').html(Math.max(...hasilFinal));
        let index = hasilFinal.indexOf(`${Math.max(...hasilFinal)}`);
        var hasil_akhir = `Skor tertinggi di dapat oleh ${criteriaAll[index-2].name} dengan nilai ${Math.max(...hasilFinal)}`;
        // console.log(index);
        // console.log(hasilFinal);

        $('#done').html(hasil_akhir);
    });


    function getAllPw() {
        // console.log(dataCriteria);
        // console.log(pwA1);
        var table = `<table class="table table-bordered"><tr><td>Kriteria</td>`;
        for (var i = 0; i < dataCriteria.length; i++) {
            table += `<td>${dataCriteria[i]}</td>`;
            if (i == dataCriteria.length) {
                table += `</tr>`;
            }
        };
        table += "<tr><td>Bobot</td>";
        for (var i = 1; i < pwCriteria.length; i++) {
            table += `<td>${pwCriteria[i]}</td>`;
        };
        table += "</tr>";
        for (var i = 0; i < dataAlternatif.length; i++) {
            table += `<tr><td>${dataAlternatif[i]}</td>`;
            for (var b = 0; b < pwA1.length; b++) {
                if (b == 0) {
                    table += `<td>${pwA1[i+1]}</td>`;
                } else if (b == 1) {
                    table += `<td>${pwA2[i+1]}</td>`;
                } else if (b == 2) {
                    table += `<td>${pwA3[i+1]}</td>`;
                } else if (b == 3) {
                    table += `<td>${pwA4[i+1]}</td>`;
                }

            }
            table += `</tr>`;

        };
        table += "</table>";
        $('#hasil_perhitungan').html(table);

        var table2 = `<table class="table table-bordered"><tr><td>Kriteria</td>`;
        for (var i = 0; i < dataCriteria.length; i++) {
            table2 += `<td>${dataCriteria[i]}</td>`;

        };
        table2 += `<td>SUM</td>`;
        table2 += `</tr>`;
        table2 += "<tr><td>Bobot</td>";
        for (var i = 1; i < pwCriteria.length; i++) {
            table2 += `<td>${pwCriteria[i]}</td>`;
        };
        table2 += "</tr>";
        var count = 1;
        for (var i = 0; i < dataAlternatif.length; i++) {
            table2 += `<tr><td>${dataAlternatif[i]}</td>`;
            for (var b = 0; b < pwA1.length; b++) {
                if (b == 0) {
                    table2 += `<td class="combat-all">${(pwA1[i+1]*pwCriteria[count]).toFixed(2)}</td>`;
                } else if (b == 1) {
                    table2 += `<td class="combat-all">${(pwA2[i+1]*pwCriteria[count]).toFixed(2)}</td>`;
                } else if (b == 2) {
                    table2 += `<td class="combat-all">${(pwA3[i+1]*pwCriteria[count]).toFixed(2)}</td>`;
                } else if (b == 3) {
                    table2 += `<td class="combat-all">${(pwA4[i+1]*pwCriteria[count]).toFixed(2)}</td>`;
                }
                count++;
                if (count > (dataCriteria.length)) {
                    count = 1;
                }

            }
            table2 += `<td class="total_akhir"></td>`;
            table2 += `</tr>`;
        };
        table2 += "</table>";
        $('#hasil_perhitungan_perkalian').html(table2);

    }

    function div_data(code) {
        var data = `<hr>
        <center><h1>${code}</h1></center>
        <div>
            <div>
                <h2>Soal ${code}</h2>
            </div>
            <div id="table_soal_${code}">
            </div>
        </div>
        <hr>
        <div>
            <div>
                <h2>Normalisasi </h2>
            </div>
            <div id="table_normalisasi_${code}">
            </div>
        </div>

        <hr>
        <div>
            <div>
                <h2>Matrix </h2>
            </div>
            <div id="table_matrix_${code}">
            </div>
        </div>

        <hr>
        <div>
            <div>
                <h2>Perhitungan </h2>

            </div>
            <div id="table_perhitungan_${code}">
            </div>
        </div>`;
        $('#div_data_' + code).html(data);
    }


    function getCriteria(link) {
        var criteriaAll = [];
        $.ajax({
            async: false,
            dataType: 'json',
            url: link,
            type: 'GET',
            success: function(data) {
                for (var i in data) {
                    criteriaAll[i] = {
                        name: data[i].ctr,
                        value: data[i].value
                    }

                }
            }
        });
        return criteriaAll;
    }










    function soal(criteria, id, code) {
        var criteriaAll = [];
        var data = [];
        criteriaAll = criteria;
        var html = "<table class='table table-bordered'><tr><td>Kriteria</td>";
        // Header
        // alert(data.length);
        for (var i = 0; i < criteriaAll.length; i++) {
            html += `<td> ${criteriaAll[i].name} </td>`;
        }
        html += "</tr>";
        // body
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            if (baris % 2 == 0) {
                html += `<tr>`;
            }
            html += `<td>${criteriaAll[baris].name}</td>`;
            for (var i = 0; i < criteriaAll.length; i++) {
                html += `<td class="data-soal-${code}">${criteriaAll[i].value[baris]}</td>`;
            }
            if (baris % 2 == 0) {
                html += `</tr>`;
            }

        }

        html += `<tr><td>Total</td>`
        for (var i = 0; i < criteriaAll.length; i++) {
            html += `<td id="soal_${code}${i}"'>0</td>`;
        }
        html += "</table>";
        document.getElementById(id).innerHTML = html;

    }




    function normalisasi(criteria, id, code, tableSoal) {
        var criteriaAll = [];
        var data = [];
        criteriaAll = criteria;
        var html = "<table class='table table-bordered'><tr><td>Kriteria</td>";
        // Header
        // alert(data.length);
        for (var i = 0; i < criteriaAll.length; i++) {
            html += `<td> ${criteriaAll[i].name} </td>`;
        }
        html += `<td > Sum </td>`;
        html += `<td> PW </td>`;
        html += "</tr>";
        // body
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            if (baris % 2 == 0) {
                html += `<tr>`;
            }
            html += `<td>${criteriaAll[baris].name}</td>`;
            for (var i = 0; i < criteriaAll.length; i++) {
                var sum = sumColumn(i + 1, tableSoal);
                html += `<td class="combat-${code}">${(criteriaAll[i].value[baris]/sum).toFixed(2)}</td>`;
            }
            html += `<td class="total-combat-${code}"></td>`;
            html += `<td class="total-pw-${code}"></td>`;
            if (baris % 2 == 0) {
                html += `</tr>`;
            }

        }
        html += "</table>";
        document.getElementById(id).innerHTML = html;
    }

    function matrix(criteria, id, code) {
        var criteriaAll = [];
        var data = [];
        criteriaAll = criteria;
        var html = "<table class='table table-bordered'><tr><td>Kriteria</td>";
        html += `<td > Matrix </td>`;
        html += `<td> Matrix / PW </td>`;
        html += "</tr>";
        // body
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            html += `<tr>`;
            html += `<td>${criteriaAll[baris].name}</td>`;
            html += `<td class="total_matrix_${code}_${baris+1}"></td>`;
            html += `<td class="total_matrix_${code}_pw${baris+1}"> </td>`;
            html += `</tr>`;

        }

        html += `<tr><td>Total</td>`
        for (var i = 0; i < criteriaAll.length - 1; i++) {
            html += `<td id='mat${i}_${code}'>0</td>`;
        }

        html += "</table>";
        document.getElementById(id).innerHTML = html;
    }

    function perhitungan(criteria, id, code) {
        var criteriaAll = [];
        var data = [];
        criteriaAll = criteria;
        var html = "<table class='table table-bordered'>";
        html += `<tr><td>Perhitungan</td>`;
        html += `<td >-</td>`;
        html += "</tr>";

        html += `<tr><td>Maks</td>`;
        html += `<td id="maks_${code}">-</td>`;
        html += "</tr>";

        html += `<tr><td>CI</td>`;
        html += `<td id="ci_${code}">-</td>`;
        html += "</tr>";

        html += `<tr><td>CI/RI</td>`;
        html += `<td id="ri_${code}">- </td>`;
        html += "</tr>";

        html += `<tr><td>Hasil</td>`;
        html += `<td id = "hasil_${code}" >- </td>`;
        html += "</tr>";
        // body
        for (var baris = 0; baris < 3; baris++) {

        }

        html += "</table>";
        document.getElementById(id).innerHTML = html;
    }
</script>






<script>
    function sumColumn(index, id) {
        var total = [];
        $('#' + id + " tr").each(function() {
            if (!this.rowIndex) return;
            var customerId = $(this).find("td").eq(index).html();
            total.push(customerId);
        });
        return sum(total).toFixed(2)
    }

    function sumTable(index, id) {
        var total = [];
        var str;
        $('#' + id + " tr").each(function() {
            if (!this.rowIndex) return;
            var customerId = $(this).find("td").eq(1).text();;
            total.push(customerId);
        });
        console.log(total);
        return sum(total).toFixed(2)
    }

    function sumRow(data, id, code) {
        $('#' + id + " tr").each(function() {
            //the value of sum needs to be reset for each row, so it has to be set inside the row loop
            var sum = 0
            //find the combat elements in the current row and sum it 
            $(this).find(`.combat-${code}`).each(function() {
                var combat = $(this).text();
                if (!isNaN(combat) && combat.length !== 0) {
                    sum += parseFloat(combat);
                }
            });
            //set the value of currents rows sum to the total-combat-criteria element in the current row
            // console.log(sum.toFixed(2));
            $(`.total-combat-${code}`, this).html(sum.toFixed(2));
            $(`.total-pw-${code}`, this).html((sum / data).toFixed(2));
            if (code == "criteria") {
                pwCriteria.push((sum / data).toFixed(2));
            } else if (code == "pangsa") {
                pwA1.push((sum / data).toFixed(2));
            } else if (code == "pendapatan") {
                pwA2.push((sum / data).toFixed(2));
            } else if (code == "infrastruktur") {
                pwA3.push((sum / data).toFixed(2));
            } else if (code == "transportasi") {
                pwA4.push((sum / data).toFixed(2));
            } else if (code == "all") {
                $(`.total_akhir`, this).html(sum.toFixed(2));
                hasilFinal.push(sum.toFixed(2));
            }

        });
    }

    function sumMatrix(code, tablesoal) {
        var pw = [];
        var priceEls = document.getElementsByClassName("total-pw-" + code);
        pw.push(0.00);
        for (var i = 0; i < priceEls.length; i++) {
            var price = priceEls[i].innerText;
            pw.push(price);
        }
        // alert(pw.length);
        // console.log("price" + priceEls[0].innerText);
        var semua = 0;
        var semua_pw = 0;
        var total_pw = [];

        // console.log(pw);
        $('#' + tablesoal + " tr").each(function(b) {
            //the value of sum needs to be reset for each row, so it has to be set inside the row loop
            var sum = 0;

            //find the combat elements in the current row and sum it 
            $(this).find(`.data-soal-${code}`).each(function(i) {
                var combat = $(this).text();
                if (!isNaN(combat) && combat.length !== 0) {
                    sum += parseFloat(combat * pw[i + 1]);
                    semua += sum;

                }

            });
            $(`.total_matrix_${code}_${b}`).html(sum.toFixed(2));
            $(`.total_matrix_${code}_pw${b}`).html(parseFloat(sum.toFixed(2) / pw[b]).toFixed(2));
            // console.log(parseFloat(sum.toFixed(2) / pw[i]).toFixed(2));
            total_pw.push(parseFloat(sum.toFixed(2) / pw[b]).toFixed(2));
        });
        $(`#mat0_${code}`).html(semua.toFixed(2));
        $(`#mat1_${code}`).html(sum(total_pw).toFixed(2));
        var maks = (sum(total_pw) / (pw.length - 1)).toFixed(2);
        // - pw.length - 1) / (pw.length - 1)
        var ci = (((sum(total_pw) / (pw.length - 1))) - (pw.length - 1)) / ((pw.length - 1) - 1);
        $(`#maks_${code}`).html(maks);
        $(`#ci_${code}`).html(ci.toFixed(2));
        $(`#ri_${code}`).html((ci / datari[pw.length - 1]).toFixed(2));

        var hasil = (ci / datari[pw.length - 1]).toFixed(2);
        if (hasil <= 0.1) {
            $(`#hasil_${code}`).html("bisa di gunakan");
            $(`#hasil_${code}`).css("color", "green");
        } else {
            $(`#hasil_${code}`).html("tidak bisa di gunakan");
            $(`#hasil_${code}`).css("color", "red");
        }

    }


    function sum(input) {

        if (toString.call(input) !== "[object Array]")
            return false;

        var total = 0;
        for (var i = 0; i < input.length; i++) {
            if (isNaN(input[i])) {
                continue;
            }
            total += Number(input[i]);
        }
        return total;
    }
</script>