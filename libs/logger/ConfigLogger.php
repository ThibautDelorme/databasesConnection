<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 14/10/14
 * Time: 19:33
 */

class ConfigLogger {
    private $dateFormat = "";
    private $level = 0;
    private $template = "";
    private $folderPath = "";
    private $filename = "";
    const DATE= "date";
    const LEVEl = "level";
    const TAG = "tag";

    public function __construct() {
        $xml = $this->getXML("../config/config.xml");
        $this->dateFormat = $xml->date_format;
        $this->level = $xml->level;
        $this->template = $xml->template;
        $this->folderPath = $xml->folderpath;
        $this->filename = $xml->filename;
    }

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return $this->dateFormat;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getFolderPath()
    {
        return $this->folderPath;
    }

    private function getXML($filepath){
        return $xml = simplexml_load_file($filepath);
    }

} 