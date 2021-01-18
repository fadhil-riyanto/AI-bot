Sastrawi String Span
====================
[![Build Status](https://travis-ci.org/sastrawi/string-span.svg?branch=master)](https://travis-ci.org/sastrawi/string-span) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sastrawi/string-span/badges/quality-score.png?b=development)](https://scrutinizer-ci.com/g/sastrawi/string-span/?branch=development) [![Code Coverage](https://scrutinizer-ci.com/g/sastrawi/string-span/badges/coverage.png?b=development)](https://scrutinizer-ci.com/g/sastrawi/string-span/?branch=development) [![Latest Stable Version](https://poser.pugx.org/sastrawi/string-span/v/stable.png)](https://packagist.org/packages/sastrawi/string-span) [![Total Downloads](https://poser.pugx.org/sastrawi/string-span/downloads.png)](https://packagist.org/packages/sastrawi/string-span)


Sastrawi String Span adalah library span yang digunakan oleh library NLP (Natural Language Processing) Sastrawi lainnya. API yang digunakan terinspirasi oleh Apache NLP Span.


Cara Install
-------------

Sastrawi String Span dapat diinstall dengan [Composer](https://getcomposer.org).

```bash
php composer.phar require sastrawi/string-span:~1
```


Penggunaan
-----------
```php
<?php

// demo.php

// include composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// create span
$span = new \Sastrawi\String\Span\Span(0, 5);
$text = 'Saya belajar NLP Bahasa Indonesia.';

echo $span->getCoveredText($text) . "\n"; // Saya
```


Lisensi
--------

Sastrawi String Span dirilis di bawah lisensi MIT License (MIT).
