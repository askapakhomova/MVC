<?php
namespace App\Controller;

use Symfony\Component\DomCrawler;

    $html = file_get_contents("https://www.anekdot.ru/");

$crawler = new DomCrawler\Crawler($html);
$parsed = $crawler->filter('.texts .text');

foreach ($parsed as $item) {
    echo $item -> textContent . '<br>';
}

