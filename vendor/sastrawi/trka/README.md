Sastrawi Trka
=============
[![Build Status](https://travis-ci.org/sastrawi/trka.svg?branch=master)](https://travis-ci.org/sastrawi/trka) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sastrawi/trka/badges/quality-score.png?b=development)](https://scrutinizer-ci.com/g/sastrawi/trka/?branch=development) [![Code Coverage](https://scrutinizer-ci.com/g/sastrawi/trka/badges/coverage.png?b=development)](https://scrutinizer-ci.com/g/sastrawi/trka/?branch=development) [![Latest Stable Version](https://poser.pugx.org/sastrawi/trka/v/stable.svg)](https://packagist.org/packages/sastrawi/trka) [![Total Downloads](https://poser.pugx.org/sastrawi/trka/downloads.svg)](https://packagist.org/packages/sastrawi/trka)

Sastrawi Trka adalah library PHP untuk melakukan deteksi entitas pada tulisan berbahasa Indonesia.


Demo
----
[http://sastrawi.github.io/trka.html](http://sastrawi.github.io/trka.html)


Cara Install
-------------

Sastrawi Trka dapat di-install dengan [Composer](https://getcomposer.org).

1. Buka terminal (command line) dan arahkan ke directory project Anda.
2. [Download Composer](https://getcomposer.org/download/) sehingga file `composer.phar` berada di directory tersebut.
3. Tambahkan Sastrawi Trka ke file `composer.json` Anda :

```bash
php composer.phar require sastrawi/trka:dev-master
```

Jika Anda masih belum memahami bagaimana cara menggunakan Composer, silahkan baca [Getting Started with Composer](https://getcomposer.org/doc/00-intro.md).


Penggunaan
-----------

Copy kode berikut di directory project anda. Lalu jalankan file tersebut.

```php
<?php

// demo.php

// include composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

```

Lisensi
--------

Sastrawi Trka dirilis di bawah lisensi MIT License (MIT).
Library ini memuat daftar singkatan Bahasa Indonesia dengan lisensi [Creative Common BY SA](https://creativecommons.org/licenses/by-sa/3.0/deed.id) yang bersumber dari [http://id.wiktionary.org/wiki/Wiktionary:Daftar_singkatan_dan_akronim_bahasa_Indonesia](http://id.wiktionary.org/wiki/Wiktionary:Daftar_singkatan_dan_akronim_bahasa_Indonesia).

