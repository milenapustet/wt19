<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style type="text/css">
        table {width:100%;}
        tr, thead {border: 1px solid #000000;}
    </style>
    <title>Aufgabe5</title>
    <?php
        function zufzahl($max, $anzahl, $stellen)
        {
            echo "<table class='table-hover table-responsive-md text-center'>";
            echo "<thead style='background-color: aliceblue'> <tr> <th> Zufallszahl</th>";   //erste Spalte des thead (also erstes th)

            //nächsten Zeilen des thead, Anzahl abh. von $stellen
            for($j=1; $j<=$stellen; $j++)
            {
                echo "<th>gerundet $j</th>";
            }
            echo "</tr></thead><tbody>";

            //Spalten mit Zahlen füllen:
            for($i=0; $i<=$anzahl; $i++)
            {
                $zzahl=rand(1,$max);            //erzeugen einer neuen Zufzahl

                if($zzahl==0) {               
                    echo "<tr style='background-color: antiquewhite'> <td> $zzahl </td>"; //neue Zeile erzeugen mit jew Hintergrundfarbe etc, +Spalte mit jew. Zahl
                }
                elseif ($zzahl<100){
                    echo "<tr style='background-color: darkgoldenrod'> <td> $zzahl </td>";
                }
                elseif ($zzahl<1000){
                    echo "<tr style='background-color: cadetblue'> <td> $zzahl </td>";
                }
                elseif ($zzahl<10000){
                    echo "<tr style='background-color: rosybrown'> <td> $zzahl </td>";
                }
                elseif ($zzahl>=10000){
                    echo "<tr style='background-color: cornflowerblue'> <td> $zzahl </td>";
                }

                for($j=1; $j<=$stellen; $j++)
                {
                    echo "<td>".abschneiden($zzahl, $j)."</td>";
                }
            }
            echo "</tbody></table>";
        }

        function abschneiden($zahl, $stellen=2)
        {
            $base=pow(10, $stellen);
            return $zahl - ($zahl%$base);
        }
    ?>
</head>
<body class="container">
    <h1>Zufallszahlen</h1>
    <section>
        <?php zufzahl(20000, 20, 3); ?>
    </section>
</body>
</html>


