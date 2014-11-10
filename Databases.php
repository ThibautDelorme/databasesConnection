<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 10/11/14
 * Time: 00:13
 */

include ("Drivers.php");
include ("libs/logger/Logger.php");

class Databases {


    private $connection;
    private $log;

    /**
     * @param $host
     * @param $dbname
     * @param $port
     * @param $login
     * @param $pwd
     * @param $socket
     * @param $driver : prefer use constant in class Drivers.
     */
    public function __construct($host, $dbname, $port, $login, $pwd ,$socket,$driver) {
        $this->log = Logger4Php::getInstance("Databases");
        $d = new Drivers($driver);
        $d->buildDrivers($host, $dbname, $port, $login, $pwd, $socket);
        try{
            switch ($driver) {
                case Drivers::MYSQL_TCP:
                    $this->connection = new PDO( $d->getSelectedDriver(), $login, $pwd );
                    break;
            };
        }
        catch(Exception $e) {
            $this->log->error("an error are occured : ".$e->getMessage());
        }

    }

    /**
     * @param $table : table name
     * @param array $keys : all keys contain in your where clause
     * @param array $values : all values to match with your keys
     * @param array $mode : seperator to your where clause
     * @return mixed (Object containing all rows access in object like $object->columnName)
     */
    public function select($table,$keys=array(),$values=array(),$mode=array()){
        $query = "SELECT * FROM ".$table." WHERE ";
        $maxlines = count($keys);
        $currentline = 0;
        foreach ($keys as $key) {
            if($currentline < ($maxlines-1))
                $query .= $key." = ? ".$mode[$currentline]." ";
            else
                $query .= $key." = ?";
        }

        $statement = $this->connection->prepare($query);
        $statement->execute($values);

        return $statement->fetch(PDO::FETCH_OBJ);
    }

    public function insert($table,$keys=array(),$values=array()) {
        $query = "INSERT INTO ".$table."(";
        foreach( $keys as $key) {
            $query .= $key.", ";
        }
        $query .= ") VALUE (";
    }

    public function update() {

    }

    public function delete() {

    }

} 