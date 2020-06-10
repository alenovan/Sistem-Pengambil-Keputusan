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
        <a href="../topsis">TOPSIS</a>
        <a href="../electree">ELECTREE</a>
        <a href="../gdss" class="active">GDSS</a>
    </div>

    <div class="content container">
        <div>
            <div>
                <!-- hasil----------------->
                <center>
                    <h3><b>Hasil Penyelesaian dengan Moora</b>
                </center>
                </h3>
                <div class="row">
                    <div class="col-sm-4">
                        <table class="table table-bordered">
                            <tr>
                                <td>Juri 1</td>
                                <td>Nilai Yi</td>
                                <td>Ranking</td>
                            </tr>
                            <tr>
                                <td>A1</td>
                                <td><?php echo $a1j1 = 0.228 ?></td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>A2</td>
                                <td><?php echo $a2j1 = 0.212 ?></td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td>A3</td>
                                <td><?php echo $a3j1 = 0.216 ?></td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>A4</td>
                                <td><?php echo $a4j1 = 0.184 ?></td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>A5</td>
                                <td><?php echo $a5j1 = 0.249 ?></td>
                                <td>1</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table class="table table-bordered">
                            <tr>
                                <td>Juri 2</td>
                                <td>Nilai Yi</td>
                                <td>Ranking</td>
                            </tr>
                            <tr>
                                <td>A1</td>
                                <td><?php echo $a1j2 = 0.220 ?></td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>A2</td>
                                <td><?php echo $a2j2 = 0.252 ?></td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>A3</td>
                                <td><?php echo $a3j2 = 0.195 ?></td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>A4</td>
                                <td><?php echo $a4j2 = 0.221 ?></td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>A5</td>
                                <td><?php echo $a5j2 = 0.206 ?></td>
                                <td>4</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-sm-4">
                        <table class="table table-bordered">
                            <tr>
                                <td>Juri 3</td>
                                <td>Nilai Yi</td>
                                <td>Ranking</td>
                            </tr>
                            <tr>
                                <td>A1</td>
                                <td><?php echo $a1j3 = 0.230 ?></td>
                                <td>2</td>
                            </tr>
                            <tr>
                                <td>A2</td>
                                <td><?php echo $a2j3 = 0.245 ?></td>
                                <td>1</td>
                            </tr>
                            <tr>
                                <td>A3</td>
                                <td><?php echo $a3j3 = 0.209 ?></td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>A4</td>
                                <td><?php echo $a4j3 = 0.198 ?></td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td>A5</td>
                                <td><?php echo $a5j3 = 0.205 ?></td>
                                <td>4</td>
                            </tr>
                        </table>
                    </div>
                    <center>
                        <h3><b>Bobot Borda</b></h3>
                    </center>
                    <div class="col-sm-6">
                        <table class="table table-bordered">
                            <tr>
                                <td>Ranking 1</td>
                                <td>Ranking 2</td>
                                <td>Ranking 3</td>
                                <td>Ranking 4</td>
                                <td>Ranking 5</td>
                            </tr>
                            <tr>
                                <td><?php echo $bb1 = 5 ?></td>
                                <td><?php echo $bb2 = 4 ?></td>
                                <td><?php echo $bb3 = 3 ?></td>
                                <td><?php echo $bb4 = 2 ?></td>
                                <td><?php echo $bb5 = 1 ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <center>
                    <h3><b>Menghitung Borda</b></h3>
                </center>
                <div class="col-sm-8">
                    <table class="table table-bordered">
                        <tr>
                            <td>Ranking</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>A1</td>
                            <td><?php echo $a1rb1 = 0 * $bb1 ?></td>
                            <td><?php echo $a1rb2 = ($a1j1 + $a1j3) * $bb2 ?></td>
                            <td><?php echo $a1rb3 = $a1j2 * $bb3 ?></td>
                            <td><?php echo $a1rb4 = 0 * $bb4 ?></td>
                            <td><?php echo $a1rb5 = 0 * $bb5 ?></td>
                        </tr>
                        <tr>
                            <td>A2</td>
                            <td><?php echo $a2rb1 = ($a2j2 + $a2j3) * $bb1 ?></td>
                            <td><?php echo $a2rb2 = 0 * $bb2 ?></td>
                            <td><?php echo $a2rb3 = 0 * $bb3 ?></td>
                            <td><?php echo $a2rb4 = $a2j1 * $bb4 ?></td>
                            <td><?php echo $a2rb5 = 0 * $bb5 ?></td>
                        </tr>
                        <tr>
                            <td>A3</td>
                            <td><?php echo $a3rb1 = 0 * $bb1 ?></td>
                            <td><?php echo $a3rb2 = 0 * $bb2 ?></td>
                            <td><?php echo $a3rb3 = ($a3j1 + $a3j3) * $bb3 ?></td>
                            <td><?php echo $a3rb4 = 0 * $bb4 ?></td>
                            <td><?php echo $a3rb5 = $a3j2 * $bb5 ?></td>
                        </tr>
                        <tr>
                            <td>A4</td>
                            <td><?php echo $a4rb1 = 0 * $bb1 ?></td>
                            <td><?php echo $a4rb2 = $a4j2 * $bb2 ?></td>
                            <td><?php echo $a4rb3 = 0 * $bb3 ?></td>
                            <td><?php echo $a4rb4 = 0 * $bb4 ?></td>
                            <td><?php echo $a4rb5 = ($a4j1 + $a4j3) * $bb5 ?></td>
                        </tr>
                        <tr>
                            <td>A5</td>
                            <td><?php echo $a5rb1 = $a5j1 * $bb1 ?></td>
                            <td><?php echo $a5rb2 = 0 * $bb2 ?></td>
                            <td><?php echo $a5rb3 = 0 * $bb3 ?></td>
                            <td><?php echo $a5rb4 = ($a5j2 + $a5j3) * $bb4 ?></td>
                            <td><?php echo $a5rb5 = 0 * $bb5 ?></td>
                        </tr>
                    </table>
                </div>
                <?php
                $pb1 = $a1rb1 + $a2rb1 + $a3rb1 + $a4rb1 + $a5rb1;
                $pb2 = $a1rb2 + $a2rb2 + $a3rb2 + $a4rb2 + $a5rb2;
                $pb3 = $a1rb3 + $a2rb3 + $a3rb3 + $a4rb3 + $a5rb3;
                $pb4 = $a1rb4 + $a2rb4 + $a3rb4 + $a4rb4 + $a5rb4;
                $pb5 = $a1rb5 + $a2rb5 + $a3rb5 + $a4rb5 + $a5rb5;
                $tpb = $pb1 + $pb2 + $pb3 + $pb4 + $pb5;
                ?>
                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <tr>
                            <td>Poin Borda</td>
                            <td>Nilai Borda</td>
                            <td>Ranking</td>
                        </tr>
                        <tr>
                            <td><?php echo $pb1 ?></td>
                            <td><?php echo number_format($pb1 / $tpb, 3, ",", ".") ?></td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td><?php echo $pb2 ?></td>
                            <td><?php echo number_format($pb2 / $tpb, 3, ",", ".") ?></td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td><?php echo $pb3 ?></td>
                            <td><?php echo number_format($pb3 / $tpb, 3, ",", ".") ?></td>
                            <td>4</td>
                        </tr>
                        <tr>
                            <td><?php echo $pb4 ?></td>
                            <td><?php echo number_format($pb4 / $tpb, 3, ",", ".") ?></td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td><?php echo $pb5 ?></td>
                            <td><?php echo number_format($pb5 / $tpb, 3, ",", ".") ?></td>
                            <td>3</td>
                        </tr>
                        <tr>
                            <td><?php echo $tpb ?></td>
                        </tr>
                    </table>
                </div>
                <h3><b>Pilihan yang terpilih adalah Apartemen 2 yaitu Purwanto.,S.Pd</b>
            </div>
        </div>
    </div>
</body>

</html>