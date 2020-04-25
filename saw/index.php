<!DOCTYPE html>
<html>

<head>
    <title>SAW dengan {JSON}</title>
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
        <a class="active" href="../saw">SAW</a>
        <a href="../wp">WP</a>
        <a href="../ahp">AHP</a>
        <a href="../moora">MOORA</a>
        <a href="../topsis">TOPSIS</a>
        <a href="../electree">ELECTREE</a>
        <a href="../gdss">GDSS</a>
    </div>

    <div class="content">

        <body class="">
            <div>
                <center>
                    <h3>SAW Dengan {Json}</h3>
                </center>
            </div>
            <hr>
            <div>
                <div>
                    <h2>Soal </h2>
                </div>
                <div id="table_soal">
                </div>
            </div>
            <hr>
            <hr>
            <div>
                <h2>Pembahasan</h2>
            </div>
            <div id="table_pembahasan">

            </div>
            <div>
                <h2>Normalisasi</h2>
            </div>
            <div id="table_normalisasi">

            </div>
            <div>
                <h2>Perkalian dengan Bobot</h2>
            </div>
            <div id="table_perkalian_bobot">

            </div>
            <div>
                <h2>Hasil</h2>
            </div>
            <div id="table_hasil">

            </div>
            <div>
                <h3 id="hasil_akhir" style="color:green"></h3>
            </div>
        </body>
    </div>

</body>

</html>


<script>
    $(document).ready(function() {
        var criteriaAll = [];
        var data = [];
        criteriaAll = getCriteria();
        data = getData(criteriaAll);
        soal(data, criteriaAll);
        pembahasan(data, criteriaAll);
        normalisasi(data, criteriaAll);
        perkalian_bobot(data, criteriaAll);
        pembagian_hasil(data, criteriaAll);
        for (var i = 0; i < data.length; i++) {
            $('#sub' + i).html(sumColumn(i + 1))
        }
    });


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


    function getData(criteria) {
        var show = [];
        $.ajax({
            async: false,
            dataType: 'json',
            url: "json/data.json",
            type: 'GET',
            success: function(data) {
                for (var i in data) {
                    show[i] = {
                        code: data[i].code,
                        alternatif: data[i].alternatif,
                        criteria: criteria,
                        value: data[i].value
                    };

                }
            }
        });
        // console.log(show)
        return show;
    }

    function getMax(size) {
        var data = []
        var Blarge = []
        var result = []
        criteriaAll = getCriteria();
        data = getData();
        var watch;
        var jumlahdata = data.length;
        var groupBy = (array, key) => {
            return array.reduce((result, currentValue) => {
                (result[currentValue[key]] = result[currentValue[key]] || []).push(
                    currentValue.value
                );
                return result;
            }, {});
        };
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            for (var i = 0; i < data.length; i++) {
                if (criteriaAll[baris].type == "benefits") {
                    Blarge.push({
                        value: data[i].value[baris],
                        code: criteriaAll[baris].code
                    });

                }
            }
        }
        // console.log(maxx(groupBy(Blarge, 'code')));
        result = maxx(groupBy(Blarge, 'code'));
        return result[size];


    }

    function getMin(size) {
        var data = []
        var Blarge = []
        var result = []
        criteriaAll = getCriteria();
        data = getData();
        var watch;
        var jumlahdata = data.length;
        var groupBy = (array, key) => {
            return array.reduce((result, currentValue) => {
                (result[currentValue[key]] = result[currentValue[key]] || []).push(
                    currentValue.value
                );
                return result;
            }, {});
        };
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            for (var i = 0; i < data.length; i++) {
                if (criteriaAll[baris].type == "cost") {
                    Blarge.push({
                        value: data[i].value[baris],
                        code: criteriaAll[baris].code
                    });

                }
            }
        }
        // console.log(minn(groupBy(Blarge, 'code')));
        result = minn(groupBy(Blarge, 'code'));
        return result[size];
    }

    function getType(status) {
        var data = []
        var Blarge = []
        var result = []
        criteriaAll = getCriteria();
        data = getData();
        var watch;
        var jumlahdata = data.length;
        var groupBy = (array, key) => {
            return array.reduce((result, currentValue) => {
                (result[currentValue[key]] = result[currentValue[key]] || []).push(
                    currentValue.value
                );
                return result;
            }, {});
        };
        var count = 0;
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            if (status == "cost") {
                if (criteriaAll[baris].type == "cost") {
                    count++;
                }
            } else {
                if (criteriaAll[baris].type == "benefits") {
                    count++;
                }
            }
        }
        console.log(count);
        result = count;
        return result;


    }

    function chunkArrayInGroups(arr, size) {
        var result = [];
        var j = 0;
        for (var i = 0; i < Math.ceil(arr.length / size); i++) {
            result[i] = arr.slice(j, j + size);
            j = j + size;
        }
        return result;
    }

    function soal(value, criteria) {
        var criteriaAll = [];
        var data = [];
        criteriaAll = criteria;
        data = value;
        var html = "<table class='table table-bordered'><tr><td></td>";
        // Header
        // alert(data.length);
        for (var i = 0; i < data.length; i++) {
            html += `<td> ${data[i].alternatif} </td>`;
        }
        html += `<td> Jenis Atribut </td>`;
        html += `<td> Bobot </td>`;
        html += "</tr>";
        // body
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            if (baris % 2 == 0) {
                html += `<tr>`;
            }
            html += `<td>${criteriaAll[baris].name}</td>`;
            for (var i = 0; i < data.length; i++) {
                html += `<td>${data[i].value[baris]}</td>`;
            }
            html += `<td>${criteriaAll[baris].type}</td>`;
            html += `<td>${criteriaAll[baris].bobot}</td>`;
            if (baris % 2 == 0) {
                html += `</tr>`;
            }

        }
        html += "</table>";
        document.getElementById("table_soal").innerHTML = html;

    }

    function findMinMax(array) {
        minValue = Math.min(...array);
        maxValue = Math.max(...array);
        return minValue;
    }


    function pembahasan(data, criteriaAll) {
        var html = "<table class='table table-bordered'><tr><td></td>";
        // Header
        for (var i = 0; i < data.length; i++) {
            html += `<td> ${data[i].code} </td>`;
        }
        html += `<td> Jenis Atribut </td>`;
        html += `<td> Bobot </td>`;
        html += "</tr>";
        // body
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            if (baris % 2 == 0) {
                html += `<tr>`;
            }
            html += `<td>${criteriaAll[baris].code}</td>`;
            for (var i = 0; i < data.length; i++) {
                html += `<td>${data[i].value[baris]}</td>`;
            }
            html += `<td>${criteriaAll[baris].type}</td>`;
            html += `<td>${criteriaAll[baris].bobot}</td>`;
            if (baris % 2 == 0) {
                html += `</tr>`;
            }

        }
        html += "</table>";
        document.getElementById("table_pembahasan").innerHTML = html;

    }

    function normalisasi(data, criteriaAll) {
        var html = "<table class='table table-bordered'><tr><td></td>";
        // Header
        for (var i = 0; i < data.length; i++) {
            html += `<td> ${data[i].code} </td>`;
        }
        html += `<td> Jenis Atribut </td>`;
        html += `<td> Bobot </td>`;
        html += "</tr>";
        // body
        var Blarge = [];
        var max = [];
        var b = 0;
        var c = 0;
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            if (baris % 2 == 0) {
                html += `<tr>`;
            }
            html += `<td>${criteriaAll[baris].code}</td>`;
            for (var i = 0; i < data.length; i++) {
                if (criteriaAll[baris].type == "benefits") {
                    html += `<td>${(data[i].value[baris]/getMax(b)).toFixed(2)}</td>`;
                } else if (criteriaAll[baris].type == "cost") {
                    html += `<td>${(getMin(c)/data[i].value[baris]).toFixed(2)}</td>`;
                }
            }
            if (criteriaAll[baris].type == "benefits") {
                b++;
            } else if (criteriaAll[baris].type == "cost") {
                c++;
            }
            html += `<td>${criteriaAll[baris].type}</td>`;
            html += `<td>${criteriaAll[baris].bobot/100}</td>`;
            if (baris % 2 == 0) {
                html += `</tr>`;
            }
        }




        // console.log(`${Math.max(...(groupBy(Blarge, 'code').C3))}`);

        // Math.max(...groupBy(Blarge, 'code').C3)
        html += "</table>";
        document.getElementById("table_normalisasi").innerHTML = html;
    }


    function perkalian_bobot(data, criteriaAll) {
        var html = "<table class='table table-bordered' id='table'><tr><td></td>";
        // Header
        for (var i = 0; i < data.length; i++) {
            html += `<td> ${data[i].code} </td>`;
        }
        html += `<td> Jenis Atribut </td>`;
        html += `<td> Bobot </td>`;
        html += "</tr>";
        // body
        var Blarge = [];
        var max = [];
        var b = 0;
        var c = 0;
        for (var baris = 0; baris < criteriaAll.length; baris++) {
            if (baris % 2 == 0) {
                html += `<tr>`;
            }
            html += `<td>${criteriaAll[baris].code}</td>`;
            for (var i = 0; i < data.length; i++) {
                if (criteriaAll[baris].type == "benefits") {
                    html += `<td>${((data[i].value[baris]/getMax(b)*criteriaAll[baris].bobot/100)).toFixed(2)}</td>`;
                } else if (criteriaAll[baris].type == "cost") {
                    html += `<td>${(getMin(c)/data[i].value[baris]*criteriaAll[baris].bobot/100).toFixed(2)}</td>`;
                }
            }
            if (criteriaAll[baris].type == "benefits") {
                b++;
            } else if (criteriaAll[baris].type == "cost") {
                c++;
            }
            html += `<td>${criteriaAll[baris].type}</td>`;
            html += `<td>${criteriaAll[baris].bobot/100}</td>`;
            if (baris % 2 == 0) {
                html += `</tr>`;
            }
        }

        html += `<tr><td>Total</td>`
        for (var i = 0; i < data.length; i++) {
            html += "<td id='sub" + i + "'>0</td>";
        }
        html += `<td>- </td><td>- </td></tr>`;
        html += "</table>";
        document.getElementById("table_perkalian_bobot").innerHTML = html;
    }

    function pembagian_hasil(data, criteriaAll) {
        var character = [];
        var nilaiakhir = [];
        var html = "<table class='table table-bordered' id='table'><tr><td>Alternatif</td>";
        // Header
        var sumTotalRow = []
        html += `<td>Hasil</td>`;
        for (var i = 0; i < data.length; i++) {
            html += `<tr>`;
            html += `<td> ${data[i].code} </td>`;
            html += `<td> ${sumColumn(i + 1)} </td>`;
            html += `</td>`;
            nilaiakhir.push(sumColumn(i + 1));
        }
        html += "</table>";
        let index = nilaiakhir.indexOf(`${Math.max(...nilaiakhir)}`);
        var hasil_akhir = `Skor tertinggi di dapat oleh ${data[index].alternatif} dengan nilai ${Math.max(...nilaiakhir)}`;
        $('#hasil_akhir').html(hasil_akhir);
        document.getElementById("table_hasil").innerHTML = html;
    }
</script>





<script>
    function sumColumn(index) {
        var total = [];
        $('#table_perkalian_bobot tr').each(function() {
            if (!this.rowIndex) return;
            var customerId = $(this).find("td").eq(index).html();
            total.push(customerId);
        });
        console.log(sum(total))
        return sum(total).toFixed(2)
    }

    function maxx(arr) {
        var max = [];
        $.each(arr, function(key, value) {
            max.push(Math.max(...value));
        });
        return max;
    }

    function minn(arr) {
        var max = [];
        $.each(arr, function(key, value) {
            max.push(Math.min(...value));
        });
        return max;
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