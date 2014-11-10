<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 09/11/14
 * Time: 23:09
 */

include ("libs/Logger/logger/Logger.php");

class Drivers {
    const MYSQL_TCP = 'mysql:host=%host%;dbname=%dbname%';
    const MYSQL_UNIX_SOCKET = 'mysql:unix_socket=%socket%;dbname=%dbname%';
    const ODBC_ALREADY_CAT = 'odbc:%dbname%';
    const ODBC = 'odbc:DRIVER={IBM DB2 ODBC DRIVER};HOSTNAME=%host%;PORT=%port%;"."DATABASE=%dbname%;PROTOCOL=TCPIP;UID=%login%;PWD=%pwd%;';
    const ODBC_SQL_SERVER = 'odbc:Driver={Microsoft Access Driver (*.mdb)};Dbq=%dbname%;Uid=%login%';
    const ORACLE = 'oci:dbname=//%host%:%port%/%dbname%';
    const FIREBIRD = 'firebird:User=%login%;Password=%pwd%;Database=%dbname%;DataSource=%host%;Port=%port%';
    const DB2 = "ibm:DRIVER={IBM DB2 ODBC DRIVER};DATABASE=%dbname%;HOSTNAME=%host%;PORT=%port%;PROTOCOL=TCPIP;";
    const INFORMIX = "informix:host=%host%; service=%port%; database=%dbname%; server=ids_server; protocol=onsoctcp; EnableScrollableCursors=1";
    const PostgreSQL = 'pgsql:host=%host% port=%port% dbname=%dbname% user=%login% password=%pwd%';
    const SQLITE3 = 'sqlite:%dbname%';
    const SQLITE2 = 'sqlite2:%dbname%';

    private $_selectedDriver="";
    private $log;

    /**
     * @return string
     */
    public function getSelectedDriver()
    {
        return $this->_selectedDriver;
    }

    function __construct($driver)
    {
        $this->log = Logger4Php::getInstance("Drivers");
        $this->_selectedDriver = $driver;
    }

    public function buildDrivers ($host, $dbname, $port, $login, $pwd ,$socket) {
        $this->_selectedDriver = str_replace("%host%",$host,$this->_selectedDriver);
        $this->_selectedDriver = str_replace("%dbname%",$dbname,$this->_selectedDriver);
        $this->_selectedDriver = str_replace("%login%",$login,$this->_selectedDriver);
        $this->_selectedDriver = str_replace("%port%",$port,$this->_selectedDriver);
        $this->_selectedDriver = str_replace("%pwd%",$pwd,$this->_selectedDriver);
        $this->_selectedDriver = str_replace("%socket%",$socket,$this->_selectedDriver);

        if (strpos($this->_selectedDriver,'%') !== false) {
            $this->log->error("you need more option in your driver. see your call to buildDrivers($host, $dbname, $port, $login, $pwd ,$socket)");
        }
        else {
            $this->log->info("Drivers are selected !");
        }
    }
} 