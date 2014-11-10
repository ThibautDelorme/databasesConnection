<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 10/11/14
 * Time: 00:13
 */

include ("Drivers.php");

class Databases {

    /**
     * @param $host
     * @param $dbname
     * @param $port
     * @param $login
     * @param $pwd
     * @param $socket
     * @param $driver : prefer use constant in class Drivers.
     */
    function __construct($host, $dbname, $port, $login, $pwd ,$socket,$driver) {
        $d = new Drivers($driver);
        $d->buildDrivers($host, $dbname, $port, $login, $pwd, $socket);
    }

} 