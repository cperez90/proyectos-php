<?php

namespace Core\Dao;

interface UserDao
{
    public function findByEmail(string $email);
    public function create(array $data);
    public function update(int $userId, array $data);
}