<?php
class Database{

  private static $instance = null;
  private $config;
  private $pdo;
  private function __construct(){
    $this->config = parse_ini_file(__DIR__.'./database.ini');
    $this->pdo = new PDO($this->config['engine'].':host='.$this->config['host'].';dbname='.$this->config['database'],
    $this->config['username'],$this->config['password']);
  }

  public static function instance(){
    if(Database::$instance == null){
      Database::$instance = new Database();
    }
    return Database::$instance;
  }

  public function connection(){
    return $this->pdo;
  }
}
?>