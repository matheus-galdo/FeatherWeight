<?php
namespace FeatherWeight\Database;

use PDO;
use PDOException;

/**
 * Create a database connection with ORM methods
 */
class Database{
	private $server;
	private $databaseName;
	private $charset;
	private $user;
	private $senha;
	private $db;

		
	/**
	 * Return a PDO database connection to MySQL
	 * 
	 * @return Database
	 */
	public function __construct()
	{
		$this->driver = DB_DRIVER;
		$this->server = SERVER_NAME;
		$this->databaseName = DB_NAME;
		$this->charset = DB_CHARSET;
		$this->user = DB_USER;
		$this->senha = DB_PASSWORD;

		$databaseConfig = json_decode(file_get_contents(__DIR__ . '/../../../config/config.json'));
		$this->server = $databaseConfig->server;
		$this->databaseName = $databaseConfig->dbName;
		$this->charset = $databaseConfig->dbCharset;
		$this->user = $databaseConfig->dbUser;
		$this->senha = $databaseConfig->dbPassword;

		try{
			$this->db = new PDO('mysql:host='.$this->server.';dbname='.$this->databaseName.";charset=$this->charset", 
							$this->user,
							$this->senha);
		}
		catch(PDOException $ex){
			if($databaseConfig->enviroment != "production")
			die(json_encode(array(
				'outcome' => false, 
				'message' => 'Unable to connect to database',
				'error' => "$ex"
			)));
		}
		
	}

	public function getDb()
	{
		return $this->db;
	}
	
	/**
	 * Select all items from a given database table and return an array of data
	 * 
	 * @param  mixed $table
	 * @return array
	 */
	public function select(string $table, array $fields = null, $operator = "=")
	{
		$query = "SELECT * FROM $table";
		$isArray = false;
		if (!is_null($fields)) {
			$query .= " where ";
			foreach ($fields as $key => $value) {
				$query .= "$key $operator :$key && ";
			}
			$query = substr($query, 0, -4);
			$isArray = true;
		}

		$prepare = $this->db->prepare($query);
		if ($isArray) {
			foreach ($fields as $key => $value) {
				$prepare->bindValue(":$key", $value);
			}
		}
		$prepare->execute();

		while($row = $prepare->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row;
		}
		
		if(!isset($result)){
			return false;
		}
		if (is_null($fields)) {
			return $result;
		}else {
			return $result[0];
		}
        
	}
	
	/**
	 * Insert a given list of data into a given table
	 * 
	 * @param  mixed $table
	 * @param  mixed $fields
	 * @param  mixed $values
	 * @return bool
	 */
	public function insert(string $table, array $values)
	{
		$fields = "";
		$bindList = "";
		foreach ($values as $key => $value) {
			$fields .= "`$key`, " ;
			$bindList .= ":$key, ";
		}
		$fields = substr($fields, 0, -2);
		$bindList = substr($bindList, 0, -2);
		
		$query = "INSERT INTO `$table` ($fields) VALUES ($bindList)";
		$prepare = $this->db->prepare($query);
		foreach ($values as $key => $value) {
			$prepare->bindValue(":$key", $value);
		}
		$res = $prepare->execute();

		
		return $res;
	}

	public function update(string $table, array $values, string $field, string $search, $operator = "=")
	{
		try {
			$updateValues = "";
			foreach ($values as $key => $value) {
				$updateValues .= "`$key` = :$key, ";
			}
			$updateValues = substr($updateValues, 0, -2);
			$query = "UPDATE `$table` SET $updateValues WHERE $field $operator :search";
			$prepare = $this->db->prepare($query);
			foreach ($values as $key => $value) {
				$prepare->bindValue(":$key", $value);
			}
			$prepare->bindValue(":search", $search);
			$result = $prepare->execute();
		}catch(PDOException $error) {
			$result = 'Error: ' . $error->getMessage();
		}
		
		return $result;
	}

	public function delete(string $table, string $field, string $search, $operator = "=")
	{
		try {
			$query = "DELETE FROM $table where $field $operator :where";
			$prepare = $this->db->prepare($query);
			$prepare->bindValue(":where", $search);
			$prepare->execute();
			
			$result = $prepare->rowCount();
		}catch(PDOException $error) {
			$result = 'Error: ' . $error->getMessage();
		}
		return $result;
	}
}

Referêcia
Referencia do cliente
Abertura
Entrega
Progresso
Status Atual