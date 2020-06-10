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
        <a href="../electree" class="active">ELECTREE</a>
        <a href="../gdss">GDSS</a>
    </div>

    <div class="content container">
        <div>
            <?php
            error_reporting(0);
            // Bobot Kriteria
            $bc1 = 3;
            $bc2 = 2;
            $bc3 = 2;
            $bc4 = 2;
            $bc5 = 1;
            // Kriteria A1
            $c1a1 = 2;
            $c2a1 = 4;
            $c3a1 = 2;
            $c4a1 = 3;
            $c5a1 = 3;
            // Kriteria A2
            $c1a2 = 4;
            $c2a2 = 1;
            $c3a2 = 5;
            $c4a2 = 5;
            $c5a2 = 3;
            // Kriteria A3
            $c1a3 = 3;
            $c2a3 = 2;
            $c3a3 = 1;
            $c4a3 = 4;
            $c5a3 = 4;
            ?>
            <!-- Matrix Normalisasi Keputusan----------------->
            <h3><b>Normalisasi Matrix Keputusan</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td></td>
                    <td>C1</td>
                    <td>C2</td>
                    <td>C3</td>
                    <td>C4</td>
                    <td>C5</td>
                </tr>
                <tr>
                    <td>A1</td>
                    <td><?php echo $c1a1 ?></td>
                    <td><?php echo $c2a1 ?></td>
                    <td><?php echo $c3a1 ?></td>
                    <td><?php echo $c4a1 ?></td>
                    <td><?php echo $c5a1 ?></td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td><?php echo $c1a2 ?></td>
                    <td><?php echo $c2a2 ?></td>
                    <td><?php echo $c3a2 ?></td>
                    <td><?php echo $c4a2 ?></td>
                    <td><?php echo $c5a2 ?></td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td><?php echo $c1a3 ?></td>
                    <td><?php echo $c2a3 ?></td>
                    <td><?php echo $c3a3 ?></td>
                    <td><?php echo $c4a3 ?></td>
                    <td><?php echo $c5a3 ?></td>
                </tr>
                <?php
                // Perhitungan matrix R
                // C1
                $rc1a1 = $c1a1 / sqrt(pow($c1a1, 2) + pow($c1a2, 2) + pow($c1a3, 2));
                $rc1a2 = $c1a2 / sqrt(pow($c1a1, 2) + pow($c1a2, 2) + pow($c1a3, 2));
                $rc1a3 = $c1a3 / sqrt(pow($c1a1, 2) + pow($c1a2, 2) + pow($c1a3, 2));
                // C2
                $rc2a1 = $c2a1 / sqrt(pow($c2a1, 2) + pow($c2a2, 2) + pow($c2a3, 2));
                $rc2a2 = $c2a2 / sqrt(pow($c2a1, 2) + pow($c2a2, 2) + pow($c2a3, 2));
                $rc2a3 = $c2a3 / sqrt(pow($c2a1, 2) + pow($c2a2, 2) + pow($c2a3, 2));
                // C3
                $rc3a1 = $c3a1 / sqrt(pow($c3a1, 2) + pow($c3a2, 2) + pow($c3a3, 2));
                $rc3a2 = $c3a2 / sqrt(pow($c3a1, 2) + pow($c3a2, 2) + pow($c3a3, 2));
                $rc3a3 = $c3a3 / sqrt(pow($c3a1, 2) + pow($c3a2, 2) + pow($c3a3, 2));
                // C4
                $rc4a1 = $c4a1 / sqrt(pow($c4a1, 2) + pow($c4a2, 2) + pow($c4a3, 2));
                $rc4a2 = $c4a2 / sqrt(pow($c4a1, 2) + pow($c4a2, 2) + pow($c4a3, 2));
                $rc4a3 = $c4a3 / sqrt(pow($c4a1, 2) + pow($c4a2, 2) + pow($c4a3, 2));
                // C5
                $rc5a1 = $c5a1 / sqrt(pow($c5a1, 2) + pow($c5a2, 2) + pow($c5a3, 2));
                $rc5a2 = $c5a2 / sqrt(pow($c5a1, 2) + pow($c5a2, 2) + pow($c5a3, 2));
                $rc5a3 = $c5a3 / sqrt(pow($c5a1, 2) + pow($c5a2, 2) + pow($c5a3, 2));
                ?>
            </table>
            <!-- Matrix Normalisasi R----------------->
            <h3><b>Matrix Normalisasi R</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td>R</td>
                    <td>C1</td>
                    <td>C2</td>
                    <td>C3</td>
                    <td>C4</td>
                    <td>C5</td>
                </tr>
                <tr>
                    <td>A1</td>
                    <td><?php echo $rc1a1 ?></td>
                    <td><?php echo $rc2a1 ?></td>
                    <td><?php echo $rc3a1 ?></td>
                    <td><?php echo $rc4a1 ?></td>
                    <td><?php echo $rc5a1 ?></td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td><?php echo $rc1a2 ?></td>
                    <td><?php echo $rc2a2 ?></td>
                    <td><?php echo $rc3a2 ?></td>
                    <td><?php echo $rc4a2 ?></td>
                    <td><?php echo $rc5a2 ?></td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td><?php echo $rc1a3 ?></td>
                    <td><?php echo $rc2a3 ?></td>
                    <td><?php echo $rc3a3 ?></td>
                    <td><?php echo $rc4a3 ?></td>
                    <td><?php echo $rc5a3 ?></td>
                </tr>
                <?php
                // Perhitungan matrix V
                // C1
                $vc1a1 = $rc1a1 * $bc1;
                $vc1a2 = $rc1a2 * $bc1;
                $vc1a3 = $rc1a3 * $bc1;
                // C2
                $vc2a1 = $rc2a1 * $bc2;
                $vc2a2 = $rc2a2 * $bc2;
                $vc2a3 = $rc2a3 * $bc2;
                // C3
                $vc3a1 = $rc3a1 * $bc3;
                $vc3a2 = $rc3a2 * $bc3;
                $vc3a3 = $rc3a3 * $bc3;
                // C4
                $vc4a1 = $rc4a1 * $bc4;
                $vc4a2 = $rc4a2 * $bc4;
                $vc4a3 = $rc4a3 * $bc4;
                // C5
                $vc5a1 = $rc5a1 * $bc5;
                $vc5a2 = $rc5a2 * $bc5;
                $vc5a3 = $rc5a3 * $bc5;
                ?>
            </table>
            <!-- Matrix V hasil pembobotan ----------------->
            <h3><b>Matrix V Hasil Pembobotan</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td>V</td>
                    <td>C1</td>
                    <td>C2</td>
                    <td>C3</td>
                    <td>C4</td>
                    <td>C5</td>
                </tr>
                <tr>
                    <td>Bobot</td>
                    <td><?php echo $bc1 ?></td>
                    <td><?php echo $bc2 ?></td>
                    <td><?php echo $bc3 ?></td>
                    <td><?php echo $bc4 ?></td>
                    <td><?php echo $bc5 ?></td>
                </tr>
                <tr>
                    <td>A1</td>
                    <td><?php echo $vc1a1 ?></td>
                    <td><?php echo $vc2a1 ?></td>
                    <td><?php echo $vc3a1 ?></td>
                    <td><?php echo $vc4a1 ?></td>
                    <td><?php echo $vc5a1 ?></td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td><?php echo $vc1a2 ?></td>
                    <td><?php echo $vc2a2 ?></td>
                    <td><?php echo $vc3a2 ?></td>
                    <td><?php echo $vc4a2 ?></td>
                    <td><?php echo $vc5a2 ?></td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td><?php echo $vc1a3 ?></td>
                    <td><?php echo $vc2a3 ?></td>
                    <td><?php echo $vc3a3 ?></td>
                    <td><?php echo $vc4a3 ?></td>
                    <td><?php echo $vc5a3 ?></td>
                </tr>
            </table>
            <!-- Matrix Corcondace ---------------------->
            <h3><b>Concordance Matrix</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td></td>
                    <td>Index Kriteria</td>
                </tr>
                <tr>
                    <td>C12</td>
                    <td>2, 5</td>
                </tr>
                <tr>
                    <td>C13</td>
                    <td>2, 3</td>
                </tr>
                <tr>
                    <td>C21</td>
                    <td>1, 3, 4, 5</td>
                </tr>
                <tr>
                    <td>C23</td>
                    <td>1, 3, 4</td>
                </tr>
                <tr>
                    <td>C31</td>
                    <td>1, 4, 5</td>
                </tr>
                <tr>
                    <td>C32</td>
                    <td>2, 5</td>
                </tr>
                <?php
                // Perhitungan Matrix Concordance C
                $ca1a1 = 0;
                $ca1a2 = $bc2 + $bc5;
                $ca1a3 = $bc2 + $bc3;
                $ca2a1 = $bc1 + $bc3 + $bc4 + $bc5;
                $ca2a2 = 0;
                $ca2a3 = $bc1 + $bc3 + $bc4;
                $ca3a1 = $bc1 + $bc4 + $bc5;
                $ca3a2 = $bc2 + $bc5;
                $ca3a3 = 0;
                // tdreshold Concrodance
                $tc = ($$c1a1 + $ca1a2 + $ca1a3 + $ca2a1 + $ca2a2
                    + $ca2a3 + $ca3a1 + $ca3a2 + $ca3a3) / (3 * (3 - 1));
                ?>
            </table>
            <!-- Matrix Corcondance C -------------------------->
            <h3><b>Matrix Concordance C</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td>C</td>
                    <td>A1</td>
                    <td>A2</td>
                    <td>A3</td>
                </tr>
                <tr>
                    <td>A1</td>
                    <td><?php echo $ca1a1 ?></td>
                    <td><?php echo $ca1a2 ?></td>
                    <td><?php echo $ca1a3 ?></td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td><?php echo $ca2a1 ?></td>
                    <td><?php echo $ca2a2 ?></td>
                    <td><?php echo $ca2a3 ?></td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td><?php echo $ca3a1 ?></td>
                    <td><?php echo $ca3a2 ?></td>
                    <td><?php echo $ca3a3 ?></td>
                </tr>
                <tr>
                    <td>tdreshold Concordance</td>
                    <td><?php echo $tc ?></td>
                </tr>
            </table>
            <!-- Matrix Dominan Corcondance F ----------------------->
            <h3><b>Matrix Dominan Concordance F</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td>F</td>
                    <td>A1</td>
                    <td>A2</td>
                    <td>A3</td>
                </tr>
                <tr>
                    <td>A1</td>
                    <td>
                        <?php
                        if ($ca1a1 > $tc) {
                            echo 1;
                            $fa11 = 1;
                        } else {
                            echo 0;
                            $fa11 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($ca1a2 > $tc) {
                            echo 1;
                            $fa12 = 1;
                        } else {
                            echo 0;
                            $fa12 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($ca1a3 > $tc) {
                            echo 1;
                            $fa13 = 1;
                        } else {
                            echo 0;
                            $fa13 = 0;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td>
                        <?php
                        if ($ca2a1 > $tc) {
                            echo 1;
                            $fa21 = 1;
                        } else {
                            echo 0;
                            $fa21 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($ca2a2 > $tc) {
                            echo 1;
                            $fa22 = 1;
                        } else {
                            echo 0;
                            $fa22 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($ca2a3 > $tc) {
                            echo 1;
                            $fa23 = 1;
                        } else {
                            echo 0;
                            $fa23 = 0;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td>
                        <?php
                        if ($ca3a1 > $tc) {
                            echo 1;
                            $fa31 = 1;
                        } else {
                            echo 0;
                            $fa31 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($ca3a2 > $tc) {
                            echo 1;
                            $fa32 = 1;
                        } else {
                            echo 0;
                            $fa32 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($ca3a3 > $tc) {
                            echo 1;
                            $fa33 = 1;
                        } else {
                            echo 0;
                            $fa33 = 0;
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <!-- Matrix Discordance ------------------------------->
            <h3><b>Discordance Matrix</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td></td>
                    <td>Index Kriteria</td>
                </tr>
                <tr>
                    <td>C12</td>
                    <td>1, 3, 4</td>
                </tr>
                <tr>
                    <td>C13</td>
                    <td>1, 4, 5</td>
                </tr>
                <tr>
                    <td>C21</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>C23</td>
                    <td>2, 5</td>
                </tr>
                <tr>
                    <td>C31</td>
                    <td>2, 3</td>
                </tr>
                <tr>
                    <td>C32</td>
                    <td>1, 3, 4</td>
                </tr>
                <?php
                // Perhitungan Matrix Discordance D
                $da1a1 = 0;
                $da1a2 = max(abs($vc1a1 - $vc1a2), abs($vc3a1 - $vc3a2), abs($vc4a1 - $vc4a2)) /
                    max(
                        abs($vc1a1 - $vc1a2),
                        abs($vc2a1 - $vc2a2),
                        abs($vc3a1 - $vc3a2),
                        abs($vc4a1 - $vc4a2),
                        abs($vc5a1 - $vc5a2)
                    );
                $da1a3 = max(abs($vc1a1 - $vc1a3), abs($vc4a1 - $vc4a3), abs($vc5a1 - $vc5a3)) /
                    max(
                        abs($vc1a1 - $vc1a3),
                        abs($vc2a1 - $vc2a3),
                        abs($vc3a1 - $vc3a3),
                        abs($vc4a1 - $vc4a3),
                        abs($vc5a1 - $vc5a3)
                    );
                $da2a1 = abs($vc2a2 - $vc2a1) /
                    max(
                        abs($vc1a2 - $vc1a1),
                        abs($vc2a2 - $vc2a1),
                        abs($vc3a2 - $vc3a1),
                        abs($vc4a2 - $vc4a1),
                        abs($vc5a2 - $vc5a1)
                    );
                $da2a2 = 0;
                $da2a3 = max(abs($vc2a2 - $vc2a3), abs($vc5a2 - $vc5a3)) /
                    max(
                        abs($vc1a2 - $vc1a3),
                        abs($vc2a2 - $vc2a3),
                        abs($vc3a2 - $vc3a3),
                        abs($vc4a2 - $vc4a3),
                        abs($vc5a2 - $vc5a3)
                    );
                $da3a1 = max(abs($vc2a3 - $vc2a1), abs($vc3a3 - $vc3a1)) /
                    max(
                        abs($vc1a3 - $vc1a1),
                        abs($vc2a3 - $vc2a1),
                        abs($vc3a3 - $vc3a1),
                        abs($vc4a3 - $vc4a1),
                        abs($vc5a3 - $vc5a1)
                    );
                $da3a2 = max(abs($vc1a3 - $vc1a2), abs($vc3a3 - $vc3a2), abs($vc4a3 - $vc4a2)) /
                    max(
                        abs($vc1a3 - $vc1a2),
                        abs($vc2a3 - $vc2a2),
                        abs($vc3a3 - $vc3a2),
                        abs($vc4a3 - $vc4a2),
                        abs($vc5a3 - $vc5a2)
                    );
                $da3a3 = 0;
                // tdreshold Discrodance
                $td = ($da1a1 + $da1a2 + $da1a3 + $da2a1 + $da2a2
                    + $da2a3 + $da3a1 + $da3a2 + $da3a3) / (3 * (3 - 1));
                ?>
            </table>
            <!-- Matrix Discordance D ----------------------------->
            <h3><b>Matrix Discordance D</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td>D</td>
                    <td>A1</td>
                    <td>A2</td>
                    <td>A3</td>
                </tr>
                <tr>
                    <td>A1</td>
                    <td><?php echo $da1a1 ?></td>
                    <td><?php echo $da1a2 ?></td>
                    <td><?php echo $da1a3 ?></td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td><?php echo $da2a1 ?></td>
                    <td><?php echo $da2a2 ?></td>
                    <td><?php echo $da2a3 ?></td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td><?php echo $da3a1 ?></td>
                    <td><?php echo $da3a2 ?></td>
                    <td><?php echo $da3a3 ?></td>
                </tr>
                <tr>
                    <td>tdreshold Discordance</td>
                    <td><?php echo $td ?></td>
                </tr>
            </table>
            <!-- Matrix Dominan Discordance G ----------------------->
            <h3><b>Matrix Dominan Discordance G</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td>G</td>
                    <td>A1</td>
                    <td>A2</td>
                    <td>A3</td>
                </tr>
                <tr>
                    <td>A1</td>
                    <td>
                        <?php
                        if ($da1a1 > $td) {
                            echo 1;
                            $ga11 = 1;
                        } else {
                            echo 0;
                            $ga11 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($da1a2 > $td) {
                            echo 1;
                            $ga12 = 1;
                        } else {
                            echo 0;
                            $ga12 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($da1a3 > $td) {
                            echo 1;
                            $ga13 = 1;
                        } else {
                            echo 0;
                            $ga13 = 0;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td>
                        <?php
                        if ($da2a1 > $td) {
                            echo 1;
                            $ga21 = 1;
                        } else {
                            echo 0;
                            $ga21 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($da2a2 > $td) {
                            echo 1;
                            $ga22 = 1;
                        } else {
                            echo 0;
                            $ga22 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($da2a3 > $td) {
                            echo 1;
                            $ga23 = 1;
                        } else {
                            echo 0;
                            $ga23 = 0;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td>
                        <?php
                        if ($da3a1 > $td) {
                            echo 1;
                            $ga31 = 1;
                        } else {
                            echo 0;
                            $ga31 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($da3a2 > $td) {
                            echo 1;
                            $ga32 = 1;
                        } else {
                            echo 0;
                            $ga32 = 0;
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($da3a3 > $td) {
                            echo 1;
                            $ga33 = 1;
                        } else {
                            echo 0;
                            $ga33 = 0;
                        }
                        ?>
                    </td>
                </tr>
            </table>
            <!-- Matrix Agresi E ----------------------->
            <h3><b>Matrix Agresi E</b></h3>
            <table class="table table-bordered">
                <tr style="">
                    <td>E</td>
                    <td>A1</td>
                    <td>A2</td>
                    <td>A3</td>
                </tr>
                <tr>
                    <td>A1</td>
                    <td><?php echo $fa11 * $ga11 ?></td>
                    <td><?php echo $fa12 * $ga12 ?></td>
                    <td><?php echo $fa13 * $ga13 ?></td>
                </tr>
                <tr>
                    <td>A2</td>
                    <td><?php echo $fa21 * $ga21 ?></td>
                    <td><?php echo $fa22 * $ga22 ?></td>
                    <td><?php echo $fa23 * $ga23 ?></td>
                </tr>
                <tr>
                    <td>A3</td>
                    <td><?php echo $fa31 * $ga31 ?></td>
                    <td><?php echo $fa32 * $ga32 ?></td>
                    <td><?php echo $fa33 * $ga33 ?></td>
                </tr>
            </table>
            <h3><b>Pilihan yang terpilih adalah Apartemen 2 dan Apartemen 3</b></h3>
        </div>
    </div>
</body>

</html>