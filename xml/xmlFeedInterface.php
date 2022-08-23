<?php
namespace xml;


interface xmlFeedInterface
{
    public function setTitle($title);
    public function setDescription($description);
    public function setUrl($url);
    public function setLang($lang);
    public function getTitle() : string;
    public function getDescription() : string;
    public function getUrl() : string;
    public function getLang() : string;
    public function run() : string;
}