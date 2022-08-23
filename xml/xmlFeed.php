<?php

namespace xml;
require_once("xml/xmlFeedInterface.php");

use xml\xmlFeedInterface;

class xmlFeed implements xmlFeedInterface
{
    protected $title = "Example";
    protected $description = "Example Description";
    protected $url = "www.example.com";
    protected $lang = "tr";

    /**
     * Xml title definition function
     * @param $title
     * @return string
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Xml description definition function
     * @param $description
     * @return string
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Xml url definition function
     * @param $url
     * @return string
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Xml language definition function
     * @return string
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Get page title
     * @return
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Get page title
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Get page title
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * Get page title
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * Get page title
     * @param $customFields
     * @return string
     */
    public function run($customFields = null): string
    {
        $html = $this->header() . $this->xmlItems($customFields) . $this->footer();
        return $html;
    }

    /**
     * Function to read data from json file
     * @return bool|array
     */
    protected function getData(): bool|array
    {
        $data = @file_get_contents(__DIR__ . "./../products.json");
        if ($data !== false) {
            $data = json_decode($data, true);
        } else {
            // Logging should be done for the else part.
        }
        return $data;
    }

    /**
     * XML header contents
     * @return string
     */
    protected function header(): string
    {
        $header = '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0"><channel>
                    <title>' . $this->getTitle() . '</title>
                    <link>' . $this->getUrl() . '</link>
                    <description>' . $this->getDescription() . '</description>
                    <language>' . $this->getLang() . ' </language>';
        return $header;
    }

    /**
     * XML footer contents
     * @return string
     */
    protected function footer(): string
    {
        $footer = '</channel></rss>';
        return $footer;
    }

    /**
     * XML data contents
     * @return string
     */
    protected function xmlItems($customFields = null): string
    {
        $items = "";
        $products = $this->getData();
        if ($customFields != null && count($products[1]) == count($customFields)) {
            for ($i = 0; $i < count($products); $i++) {
                $product = $products[$i];
                $items .= '<item>
                      <' . $customFields[0] . '>' . $product['id'] . '</' . $customFields[0] . '>
                      <' . $customFields[1] . '>' . $product['name'] . '</' . $customFields[1] . '>
                      <' . $customFields[2] . '>' . $product['price'] . '</' . $customFields[2] . '>
                      <' . $customFields[3] . '>' . $product['category'] . '</' . $customFields[3] . '>
                    </item>';
            }
        } else {
            foreach ($products as $product) {
                $items .= '<item>
                      <id>' . $product['id'] . '</id>
                      <name>' . $product['name'] . '</name>
                      <price>' . $product['price'] . '</price>
                      <category>' . $product['category'] . '</category>
                    </item>';
            }
        }
        return $items;
    }
}