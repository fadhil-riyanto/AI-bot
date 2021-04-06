<?php
$getQuotesJSONsax = file_get_contents(__DIR__ . '/json_data/fiturTambahan/quot.json');
$getQuotesJSONsaxDec = json_decode($getQuotesJSONsax);
$jumlah =  count($getQuotesJSONsaxDec);

$qout =  $getQuotesJSONsaxDec[random_int(0, $jumlah)]->quotes;

function random_color_part()
{
    return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
}

function random_color()
{
    return random_color_part() . random_color_part() . random_color_part();
}

$colors =  random_color();
?>

<html>

<head>
    <title><?php echo $_SERVER['SERVER_NAME']; ?></title>

    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <style>
        body {
            background-color: #<?php echo $colors; ?>;
            color: bisque;
            font: small-caps lighter 21px/150% "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
        }

        #Fadhils {
            color: azure;
            font-size: 0.33em;
            font-style: unset;
        }

        #waktusekaranghehe {
            font: small-caps lighter 43px/150% "Segoe UI", Frutiger, "Frutiger Linotype", "Dejavu Sans", "Helvetica Neue", Arial, sans-serif;
            text-align: left;
            width: 80%;
            margin: 40px auto;
            color: #fff;
            border-left: 3px solid #a54bed;
            padding: 20px;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            background-color: #<?php echo $colors; ?>;
            text-decoration: none;
            font-weight: 700;
            font-display: auto;
            font-family: arial;
        }

        .logo__mark {
            margin-right: 5px;
        }

        .logo__text {
            font-size: 1.125rem;
            text-transform: uppercase;
        }

        .logo__cursor {
            display: inline-block;
            width: 10px;
            height: 1rem;
            background: #ed1f24;
            margin-left: 5px;
            border-radius: 1px;
            animation: cursor 1s infinite;
        }

        @media (prefers-reduced-motion: reduce) {
            .logo__cursor {
                animation: none;
            }
        }

        @keyframes cursor {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        input.MyButton {
            width: 125px;
            padding: 5px;
            cursor: pointer;
            /* font-weight: bold; */
            font-size: 70%;
            background: #091c42;
            color: #fff;
            border: 1px solid #3366cc;
            border-radius: 10px;
        }

        input.MyButton:hover {
            color: #ffff00;
            background: #000;
            border: 1px solid #fff;
        }

        .button {
            /* display: inline-block; */
            padding: 5px;
            text-align: center;
            text-decoration: none;
            color: #ffffff;
            background-color: #26454f;
            border-radius: 6px;
            outline: none;
        }

        .button:hover {
            color: #ffff00;
            background: #000;
            border: 1px solid #fff;
        }
    </style>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    </meta>
</head>

<body onLoad="initClock()">
    <div class="logo">
        <span class="logo__mark"> </span>
        <span class="logo__text"> <?php echo $qout; ?></span>
        <span class="logo__cursor"></span>
    </div>
    <div id="waktusekaranghehe">
        <a id="d">1</a>
        <a id="mon">January</a>
        <a id="y">0</a><br />
        <a id="h">12</a> :
        <a id="m">00</a>:
        <a id="s">00</a>:
        <a id="mi">000</a>
        <div id="Fadhils">(c)
            <?php echo $_SERVER['SERVER_NAME']; ?>
        </div>
    </div>
    <script>
        Number.prototype.pad = function(n) {
            for (var r = this.toString(); r.length < n; r = 0 + r);
            return r;
        };

        function updateClock() {
            var now = new Date();
            var milli = now.getMilliseconds(),
                sec = now.getSeconds(),
                min = now.getMinutes(),
                hou = now.getHours(),
                mo = now.getMonth(),
                dy = now.getDate(),
                yr = now.getFullYear();
            var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "Nopember", "Desember"];
            var tags = ["mon", "d", "y", "h", "m", "s", "mi"],
                corr = [months[mo], dy, yr, hou.pad(2), min.pad(2), sec.pad(2), milli];
            for (var i = 0; i < tags.length; i++)
                document.getElementById(tags[i]).firstChild.nodeValue = corr[i];
        }

        function initClock() {
            updateClock();
            window.setInterval("updateClock()", 1);
        }

        // END CLOCK SCRIPT
    </script>
</body>

</html>