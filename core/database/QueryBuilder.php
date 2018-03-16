<?php // Agradeço a DEUS pelo dom do conhecimento

namespace App\Core\Database;

class QueryBuilder
{
	protected $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	public function select($table, $parameters)
	{
		$sql = sprintf("SELECT %s FROM %s",
			implode(' ,', array_keys($parameters)),
			$table
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($parameters);
			return $statement->fetchAll(\PDO::FETCH_CLASS);
		} catch(\PDOException $e) {
			die($e->getMessage());
		}
	}

	public function selectAll($table)
	{
		$statement = $this->pdo->prepare("SELECT * FROM {$table}");
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_CLASS);
	}

	public function where($table, $attribute, $value)
	{
		$statement = $this->pdo->prepare("SELECT * FROM {$table} WHERE {$attribute} = {$value}");
		$statement->execute();
		return $statement->fetchAll(\PDO::FETCH_CLASS);
	}

	public function insert($table, $parameters)
	{
		$sql = sprintf("INSERT INTO %s (%s) VALUES (%s)",
			$table,
			implode(' ,', array_keys($parameters)),
			':' . implode(', :', array_keys($parameters))
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($parameters);
			#return $statement->rowCount();
		} catch(\PDOException $e) {
			die($e->getMessage());
		}
	}

	public function update($table, $parameters, $id = 0)
	{
		$sql = sprintf("UPDATE %s SET %s WHERE id = :id",
			$table,
			implode(', ', array_map(function ($param) {
					return "{$param} = :{$param} ";
			}, array_keys($parameters)))
		);

		try {
			$statement = $this->pdo->prepare($sql);
			$statement->execute($parameters);
			return $statement->rowCount();
		} catch(\PDOException $e) {
			die($e->getMessage());
		}
	}

	public function delete($table, $id = 0)
	{
		$statement = $this->pdo->prepare("DELETE FROM {$table} WHERE id = {$id}");
		$statement->execute();
		return $statement->rowCount();
	}
}