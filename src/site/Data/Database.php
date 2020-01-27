<?php


namespace ilsur\data;


use PDO;

class Database
{
    private $link;
    private $dsn, $username, $password;

    /**
     * Database constructor.
     * @param $dsn
     * @param $username
     * @param $password
     */
    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        $this->link = new PDO($this->dsn, $this->username, $this->password);

        //$this->connect();
    }

    /**
     * @return $this
     */
    private function connect(){
        $this->link = new PDO($this->dsn, $this->username, $this->password);

        return $this;
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function execute($sql){
        $sth = $this->link->prepare($sql);
        return $sth->execute();
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function query($sql){
        $exe = $this->execute($sql);
        return $exe->fetchAll(PDO::FETCH_ASSOC);
    }
}