<?php

class DbClass
{

    private $link;

    /**
     * Database constructor.
     * @param $dsn
     * @param $username
     * @param $password
     */
    public function __construct($dsn, $username, $password)
    {
        try {
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            );
            $this->link = new PDO($dsn, $username, $password, $options);
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Can't connect with Database");
        }
    }

    /**
     * @param $sql
     * @param null $executeParams
     * @return mixed
     */
    public function execute($sql, $executeParams = null)
    {
        $result = null;
        try {
            $sth = $this->link->prepare($sql);
            $result = $sth->execute($executeParams);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    /**
     * @param $sql
     * @param null $executeParams
     * @return mixed
     */
    public function query($sql, $executeParams = null)
    {
        $result = null;
        try {
            $sth = $this->link->prepare($sql);
            $sth->execute($executeParams);
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function lastInsertId()
    {
         return $this->link->lastInsertId();
    }
    /**
     * DB functions
     */
    /**
     * Get all records from file
     *
     * @param string $table Table name
     * @return array Array of data
     */
    public function dbSelectAll($table)
    {
        return $this->query("SELECT * FROM $table");
    }


    /**
     * Find by ID
     *
     * @param string $table Table name
     * @param int $needleId Needle user id
     * @return array Array of data
     */
    public function dbFind($table, $needleId)
    {
        return $this->query("SELECT * FROM $table WHERE id = :id", array(':id' => $needleId));
    }

    /**
     * Find by field
     *
     * @param string $table Table name
     * @param $criteria
     * @return array
     */
    public function dbFindBy($table, $criteria)
    {
        $row = NULL;
        $email = $criteria['email'];
        $password = $criteria['password'];
        if ($email && $password) {
            $row = $this->query("SELECT * FROM $table WHERE email = :email AND password = :password", array(':email' => $email, ':password' => $password));
        } else if ($email) {
            $row = $this->query("SELECT * FROM $table WHERE email = :email", array(':email' => $email));
        } else if ($password) {
            $row = $this->query("SELECT * FROM $table WHERE password = :password", array(':password' => $password));
        }
        return $row;
    }

    /**
     * Add new line to DB
     *
     * @param string $table Table name
     * @param array $data
     */
    public function dbAddUser($table, $data)
    {
        $this->execute("INSERT INTO $table (email, password)
            VALUES (:email, :password)",
            array(
                ':password' => strval($data['password']),
                ':email' => strval($data['email'])
            ));
    }
}