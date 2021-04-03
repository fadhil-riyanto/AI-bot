<?php
require __DIR__  . '/../vendor/autoload.php';

use \Treinetic\ImageArtist\lib\Shapes\Triangle;
use \Treinetic\ImageArtist\lib\Shapes\PolygonShape;
use \Treinetic\ImageArtist\lib\Commons\Node;
use \Treinetic\ImageArtist\lib\Text\Color;
use \Treinetic\ImageArtist\lib\Overlays\Overlay;
use \Treinetic\ImageArtist\lib\Shapes\CircularShape;
use \Treinetic\ImageArtist\lib\Text\TextBox;
use \Treinetic\ImageArtist\lib\Text\Font;

/*
 * Merge images
 * */

$tr1 = new Triangle("./city.jpg");
$tr1->scale(64);
$tr1->setPointA(0, 0, true);
$tr1->setPointB(100, 0, true);
$tr1->setPointC(100, 100, true);
$tr1->build();

$tr2 = new Triangle("./morning.jpeg");
$tr2->scale(60);
$tr2->setPointA(0, 0, true);
$tr2->setPointB(0, 100, true);
$tr2->setPointC(100, 100, true);
$tr2->build();

$tr1->resize($tr1->getWidth(), $tr2->getHeight());

$img = $tr1->merge($tr2, 0, 0);
$img->scale(70);


/* Let's add an overlay to this */
$overlay = new Overlay($img->getWidth(), $img->getHeight(), new Color(0, 0, 0, 80));
$img->merge($overlay, 0, 0);
/* hmmm.. lets add a photo */
$circle = new CircularShape("./person.jpg");
$circle->resize(300, 300);
$circle->build();
$img = $img->merge($circle, ($img->getWidth() - $circle->getWidth()) / 2, ($img->getHeight() - $circle->getHeight()) / 2);
/* I think I should add some Text */
$textBox = new TextBox(310, 40);
$textBox->setColor(Color::getColor(Color::$WHITE));
$textBox->setFont(Font::getFont(Font::$NOTOSERIF_REGULAR));
$textBox->setSize(20);
$textBox->setMargin(2);
$img->setTextBox($textBox, ($img->getWidth() - $textBox->getWidth()) / 2, $img->getHeight() * (5 / 7));

//$img->dump();
$img->convertTo(IMAGETYPE_PNG);
$img->save("./newImage.jpg", IMAGETYPE_PNG);
