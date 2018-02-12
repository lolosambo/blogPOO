<?php

namespace P5\managers;
use P5\core\factories\DbFactory;



abstract class MainManager
{

	protected $db;

	public function getDb()
	{
  	 	$this->db = new DbFactory();
  	 	return $this->db;
	}
	

	public function getAllBy($table, $orderBy, $limit1 = 0, $limit2 = 20 )
	{
		$req = $this->getDb()->getPdo()->query('SELECT * FROM ' .$table. ' ORDER BY ' .$orderBy.' DESC LIMIT '.$limit1.', '.$limit2.'');
		$res = $req->fetchAll();
		return $res;

	}

	public function getAllByDate($column, $table, $orderBy, $limit1 = 0, $limit2 = 1000)
	{

		$req = $this->getDb()->getPdo()->query
		('
			SELECT *, DATE_FORMAT('.$column.', "%d/%m/%Y à %Hh%i") AS '.$column.' 
			FROM '.$table.' 
			ORDER BY '.$orderBy.'
			DESC LIMIT '.$limit1.', '.$limit2.'
		');

		$res = $req->fetchAll();
		return $res;
	}

	public function getOne($table, $column, $param)
	{
		$req = $this->getDb()->getPdo()->prepare('SELECT * FROM ' .$table. ' WHERE '.$column. ' = :param');
		$req->bindParam(':param', $param);
		$req->execute();
		$res = $req->fetch();
		return $res;

	}

	public function update($table, $key, $value, $column, $param)
	{
		$req = $this->getDb()->getPdo()->prepare('UPDATE ' .$table. ' SET '.$key.' = :value WHERE '.$column. ' = :param');
		$req->bindParam(':value', $value);
		$req->bindParam(':param', $param);
		$req->execute();
		return $req;
	}

	public function erase($table, $column, $param)
	{
		$req = $this->getDb()->getPdo()->prepare('DELETE FROM ' .$table. ' WHERE '.$column. ' = :param');
		$req->bindParam(':param', $param);
		$req->execute();
	}


	public function count($table, $column = '', $param = '')
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

}


