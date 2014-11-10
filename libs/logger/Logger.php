<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 14/10/14
 * Time: 19:25
 */
    require("ConfigLogger.php");

    class Logger4Php  {

        private static $_instance = null;
        private $dateformat;
        private $level;
        private $template;
        private $folderPath;
        private $filename;
        private $file;
        private static $tag;
        const _DEBUG = "DEBUG";
        const _INFO = "INFO";
        const _WARN = "WARN";
        const _ERROR = "ERROR";
        const _FATAL = "FATAL";

        private function __construct() {
            $conf = new ConfigLogger();
            $this->dateformat = $conf->getDateFormat();
            $this->level = $conf->getLevel();
            $this->template = $conf->getTemplate();
            $this->folderPath = $conf->getFolderPath();
            $this->filename = $conf->getFilename();
            $this->createFolderAndFileIfNotExist();
        }

        public static function getInstance($tag) {
            if (is_null(self::$_instance)) {
                self::$_instance = new  Logger4Php();
            }
            self::$tag=$tag;
            return self::$_instance;
        }

        public function debug($string) {
           fwrite($this->file,$this->buildSting($string,self::_DEBUG));
        }

        public function info($string) {
            fwrite($this->file,$this->buildSting($string,self::_INFO));
        }

        public  function warn($string) {
            fwrite($this->file,$this->buildSting($string,self::_WARN));
        }

        public  function error($string) {
            fwrite($this->file,$this->buildSting($string,self::_ERROR));
        }

        public function fatal($string) {
            fwrite($this->file,$this->buildSting($string,self::_FATAL));
        }

        private function buildSting ($string,$level) {
            $date = date($this->dateformat);
            $result = $this->template;

            $result = str_replace("/date/",$date, $result);
            $result = str_replace("/level/",$level, $result);
            $result = str_replace("/tag/",self::$tag, $result);

            $result .= $string;
            $result .= PHP_EOL;

            return $result;
        }

        private function createFolderAndFileIfNotExist() {
            if(!file_exists($this->folderPath))
                mkdir($this->folderPath);
            $filepath = $this->folderPath.DIRECTORY_SEPARATOR.$this->filename;

            $this->file = fopen($filepath,"a");
        }

    }


