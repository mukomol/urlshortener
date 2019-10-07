<?php

class Model
{

  protected $db;


    public function __construct()
    {
        $this->db = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

        $this->createDatabase();
    }

    public function createDatabase()
    {
        $sqlCreateLinks = "CREATE TABLE  IF NOT EXISTS links (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
url VARCHAR(35) NOT NULL,
code VARCHAR(35) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
        $sqlCreateView = 'CREATE TABLE  IF NOT EXISTS links_plus (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
info LONGTEXT NOT NULL,
view_code INT(11) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)';

        if ($this->db->query($sqlCreateView) === TRUE && $this->db->query($sqlCreateLinks) === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}