<?php

namespace Core\Dao;

use Core\Database;

class UserDaoImpl implements UserDao
{
    private Database $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function findByEmail(string $email)
    {
        return $this->db->query('SELECT * FROM user WHERE email = :email', [
            'email' => $email
        ])->find();
    }

    public function create(array $data)
    {
        $this->db->query('INSERT INTO user (email, password) VALUES (:email, :password)', [
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ]);
    }

    public function update(int $userId, array $data)
    {
        // Aquí puedes agregar código para actualizar un usuario si es necesario
        $this->db->query('UPDATE user SET email = :email, password = :password WHERE id = :id', [
            'id' => $userId,
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT)
        ]);
    }
}