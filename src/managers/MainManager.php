<?php

namespace P5\managers;
use P5\core\factories\DbFactory;
use \PDO;



abstract class MainManager
{

	protected $db;
	protected $tableRef = ['Posts', 'Users', 'Comments', 'Networks', 'Roles'];
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
		
		if(in_array($table, $this->tableRef))
		{
			$req = $this->getDb()->getPdo()->prepare('SELECT * FROM ' .$table.' ORDER BY ' .$orderBy.' DESC LIMIT :limit1, :limit2');
			$req->bindparam(':limit1', $limit1, PDO::PARAM_INT);
			$req->bindparam(':limit2', $limit2, PDO::PARAM_INT);
			$req->execute();
			$res = $req->fetchAll();
			return $res;
		}
		else
		{
			throw new \Exception('Requête non autorisée');
		}



	}

	public function getAllByDate($column, $table, $orderBy, $limit1 = 0, $limit2 = 1000)
	{
		if(in_array($table, $this->tableRef))
		{
			$req = $this->getDb()->getPdo()->prepare
			('
				SELECT *, DATE_FORMAT('.$column.', "%d/%m/%Y à %Hh%i") AS '.$column.' 
				FROM '.$table.' 
				ORDER BY '.$orderBy.'
				DESC LIMIT :limit1, :limit2
			');

			$req->bindparam(':limit1', $limit1, PDO::PARAM_INT);
			$req->bindparam(':limit2', $limit2, PDO::PARAM_INT);
			$req->execute();

			$res = $req->fetchAll();
			return $res;
		}
		else
		{
			throw new \Exception('Requête non autorisée');
		}
	}

	public function getOne($table, $column, $param)
	{
		if(in_array($table, $this->tableRef))
		{
			$req = $this->getDb()->getPdo()->prepare('SELECT * FROM ' .$table. ' WHERE '.$column. ' = :param');
			$req->bindParam(':param', $param);
			$req->execute();
			$res = $req->fetch();
			return $res;
		}
		else
		{
			throw new \Exception('Requête non autorisée');
		}

	}

	public function update($table, $key, $value, $column, $param)
	{
		if(in_array($table, $this->tableRef))
		{	
			$req = $this->getDb()->getPdo()->prepare('UPDATE ' .$table. ' SET '.$key.' = :value WHERE '.$column. ' = :param');
			$req->bindParam(':value', $value);
			$req->bindParam(':param', $param);
			$req->execute();
			return $req;
		}
		else
		{
			throw new \Exception('Requête non autorisée');
		}
	}

	public function erase($table, $column, $param)
	{
		if(in_array($table, $this->tableRef))
		{
			$req = $this->getDb()->getPdo()->prepare('DELETE FROM ' .$table. ' WHERE '.$column. ' = :param');
			$req->bindParam(':param', $param);
			$req->execute();
		}
		else
		{
			throw new \Exception('Requête non autorisée');
		}
	}


	public function count($table, $column = '', $param = '')
	{
		if(in_array($table, $this->tableRef))
		{
			if (($column != '') && ($param != ''))
			{
				$req= $this->getDb()->getPdo()->prepare('SELECT COUNT(*) AS total FROM '.$table.' WHERE '.$column.'  = :param');
				$req->bindParam(':param', $param);
				$req->execute();
				$data = $req->fetch();
				$total=$data['total'];
				return $total;
			}

			else
			{
				$req= $this->getDb()->getPdo()->query('SELECT COUNT(*) AS total FROM '.$table.'');
				$data = $req->fetch();
				$total=$data['total'];
				return $total;
			}
		}
		else
		{
			throw new \Exception('Requête non autorisée');
		}

	}

}


