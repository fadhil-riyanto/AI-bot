<?php
$a = file_get_contents("http://api.kawalcorona.com/");
$b = json_decode($a);
//var_dump($b);
/*
* Ekspektasi di vardump oke, lanjut ke parse
*/
$kode_negara = "US"; //Amerika

foreach ($b as $b_for) {
    if ($b_for->attributes->Country_Region == $kode_negara) {
        echo $b_for->attributes->Confirmed;
    }
}
/*
== RAW ==
{
    "attributes": {
      "OBJECTID": 179,
      "Country_Region": "US",
      "Last_Update": 1611753738000,
      "Lat": 40,
      "Long_": -100,
      "Confirmed": 25445699,
      "Deaths": 425257,
      "Recovered": null,
      "Active": 25020442
    }
  }

  ekspektasi sesuai seperti keinginan, test script ok!
*/
