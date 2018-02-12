<?php

namespace P5\managers;
use P5\core\factories\DbFactory;
use P5\managers\ManagerValidator;
use \PDO;



abstract class MainManager
{

	protected $db;
	protected $validator;

	public function __construct()
	{
		$this->validator = new ManagerValidator();
	}

	public function getDb()
	{
  	 	$this->db = new DbFactory();
  	 	return $this->db;
  	 	
	}

	public function getAllBy($table, $orderBy, $limit1 = 0, $limit2 = 20 )
	{

		$req = $this->getDb()->getPdo()->prepare('SELECT * FROM :table ORDER BY :orderBy DESC LIMIT :limit1, :limit2');
		$req->bindparam(':table', $table, PDO::PARAM_STR);
		$req->bindparam(':orderBy', $orderBy, PDO::PARAM_STR);
		$req->bindparam(':limit1', $limit1, PDO::PARAM_INT);
		$req->bindparam(':limit2', $limit2, PDO::PARAM_INT);
		$req->execute();

		$res = $req->fetchAll();

		return $res;

	}

	public function getAllByDate($column, $table, $orderBy, $limit1 = 0, $limit2 = 1000)
	{

		$req = $this->getDb()->getPdo()->prepare
		('
			SELECT *, DATE_FORMAT(:column, "%d/%m/%Y à %Hh%i") AS :column 
			FROM :table 
			ORDER BY :orderBy
			DESC LIMIT :limit1, :limit2
		');

		$req->bindparam(':column', $column, PDO::PARAM_STR);
		$req->bindparam(':table', $table, PDO::PARAM_STR);
		$req->bindparam(':orderBy', $orderBy, PDO::PARAM_STR);
		$req->bindparam(':limit1', $limit1, PDO::PARAM_INT);
		$req->bindparam(':limit2', $limit2, PDO::PARAM_INT);
		$req->execute();

		$res = $req->fetchAll();
		return $res;
	}

	public function getOne($table, $column, $param)
	{

		$req = $this->getDb()->getPdo()->prepare('SELECT * FROM :table WHERE :column = :param');
		$req->bindparam(':table', $table, PDO::PARAM_STR);
		$req->bindparam(':column', $column, PDO::PARAM_STR);
		$req->bindparam(':param', $param);
		$req->execute();

		$res = $req->fetch();
		return $res;

	}

	public function update($table, $key, $value, $column, $param)
	{
		$req = $this->getDb()->getPdo()->prepare('UPDATE :table SET :key = :value WHERE :column = :param');
		$req->bindparam(':table', $table, PDO::PARAM_STR);
		$req->bindparam(':key', $key, PDO::PARAM_STR);
		$req->bindParam(':value', $value);
		$req->bindparam(':column', $column, PDO::PARAM_STR);
		$req->bindParam(':param', $param);
		$req->execute();
		return $req;
	}

	public function erase($table, $column, $param)
	{
		$req = $this->getDb()->getPdo()->prepare('DELETE FROM :table WHERE :column = :param');
		$req->bindparam(':table', $table, PDO::PARAM_STR);
		$req->bindparam(':column', $column, PDO::PARAM_STR);
		$req->bindParam(':param', $param);
		$req->execute();
	}


	public function count($table, $column = '', $param = '')
	{
		
		if (($column != '') && ($param != ''))
		{
			$req= $this->getDb()->getPdo()->prepare('SELECT COUNT(*) AS total FROM :table WHERE :column  = :param');
			$req->bindParam(':param', $param);
			$req->bindparam(':table', $table, PDO::PARAM_STR);
			$req->bindparam(':column', $column, PDO::PARAM_STR);
			$req->execute();
			$data = $req->fetch();
			$total=$data['total'];
			return $total;
		}

		else
		{
			$req= $this->getDb()->getPdo()->prepare('SELECT COUNT(*) AS total FROM :table');
			$req->bindparam(':table', $table, PDO::PARAM_STR);
			$req->execute();
			$data = $req->fetch();
			$total=$data['total'];
			return $total;
		}

	}

	



}