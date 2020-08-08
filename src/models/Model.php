<?php

class Model
{
	protected static $tableName = '';
	protected static $columns = [];
	protected $values = [];

	public function __construct($arr)
	{
		$this->loadFromArray($arr);
	}

	public function loadFromArray($arr)
	{
		if ($arr) {
			foreach ($arr as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	public function __get($key)
	{
		return $this->values[$key] ?? null;
	}
	
	public function __set($key, $value)
	{
		$this->values[$key] = $value;
	}

	public static function getOne($filters = [], $columns = '*')
	{
		$class = get_called_class();
		$result = static::getResultSetFromSelect($filters, $columns);
		return $result ? new $class($result) : null;
	}

	public static function get($filters = [], $columns = '*')
	{
		$objects = [];
		$result = static::getResultSetFromSelect($filters, $columns);
		if ($result) {
			$class = get_called_class();
			while ($row = $result->fetch_assoc()) {
				$objects[] = new $class($row);
			}
		}
		return $objects;
	}

	public static function getResultSetFromSelect($filters = [], $columns = '*')
	{
		$sql = "SELECT {$columns} FROM " 
			. static::$tableName
			. static::getFilters($filters);
		$result = Database::getResultFromQuery($sql);
		if ($result->num_rows === 0) {
			return null;
		} else {
			return $result;
		}
	}

	public static function getFilters($filters)
	{
		$sql = '';

		if (count($filters) > 0) {
			$where = [];
			foreach ($filters as $column => $value) {
				$where[] = "$column = " . static::getFormatedValue($value);
			}
			$sql = " WHERE " . implode(" AND ", $where);
		}

		return $sql;
	}

	private static function getFormatedValue($value) 
	{
		if (is_null($value)) {
			return "null";
		} elseif (gettype($value) === 'string') {
			return "'{$value}'";
		} else {
			return $value;
		}
	}
}