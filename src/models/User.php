<?php
class User extends Model
{
	protected static $tableName = 'users';
	protected static $columns = [
		'id',
		'name',
		'password',
		'email',
		'start_date',
		'end_date',
		'is_admin'
	];

	public static function getActiveUsersCount()
	{
		return static::getCount(['raw' => 'end_date IS NULL']);
	}

	public function insert()
	{
		$this->validate();
		$this->is_admin = $this->is_admin ? 1 : 0;
		if (!$this->end_date) $this->end_date = null;
		return parent::insert();
	}

	private function validate()
	{
		$errors = [];

		if (!$this->name) {
			$errors['name'] = 'Nome é um campo obrigatório.';
		}
		
		if (!$this->email) {
			$errors['email'] = 'Email é um campo obrigatório.';
		} elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Email inválido.';
		}
		
		if (!$this->start_date) {
			$errors['start_date'] = 'Data de Admissão é um campo obrigatório';
		} elseif (DateTime::createFromFormat('Y-m-d', $this->start_date)) {
			$errors['start_date'] = 'Data de Admissão deve seguir o padrão dd/mm/yyyy.';
		}
		
		if ($this->end_date and DateTime::createFromFormat('Y-m-d', $this->end_date)) {
			$errors['end_date'] = 'Data de Desligamento deve seguir o padrão dd/mm/yyyy.';
		}
		
		if (!$this->password) {
			$errors['password'] = 'Senha é um campo obrigatório';
		} elseif ($this->password !== $this->confirm_password) {
			$errors['confirm_password'] = 'A confirmação de senha é diferente da senha informada.';
		}

		if (count($errors) > 0) {
			throw new ValidationException($errors);
		}
	}
}