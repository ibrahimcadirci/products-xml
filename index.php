<?php

use xml\xmlFeed;

require_once("xml/xmlFeed.php");
header('Content-type: text/xml');
$xmlFeed = new xmlFeed();

if (isset($_GET['rss']) && $_GET['rss'] == 1) {
    $xmlFeed->setTitle("Example");
    $xmlFeed->setUrl("www.example.com");
    $xmlFeed->setDescription("Example Description");
    $xmlFeed->setLang("tr");
    echo $xmlFeed->run();
}else if (isset($_GET['rss']) && $_GET['rss'] == 2) {
     $xmlFeed->setTitle("Example Home");
     $xmlFeed->setUrl("www.example.com");
     $xmlFeed->setDescription("Example Description");
     $xmlFeed->setLang("tr");
     echo $xmlFeed->run(["ID", "TITLE", "PRICE", "CATEGORY"]);
 }

