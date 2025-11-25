<?php

namespace Core\Dao;

use Core\Database;

class NotesDaoImpl implements NotesDao
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getAllNotesByUserId(int $userId): array
    {
        return $this->db->query('SELECT * FROM note WHERE user_id = :userId', [
            'userId' => $userId
        ])->get();
    }

    public function getNoteById(int $id): array
    {
        return $this->db->query('SELECT * FROM note WHERE id = :id', [
            'id' => $id
        ])->findOrFail();
    }

    public function createNote(string $body, int $userId): void
    {
        $this->db->query('INSERT INTO note (body, user_id) VALUES (:body, :user_id)', [
            'body' => $body,
            'user_id' => $userId
        ]);
    }

    public function updateNote(int $id, string $body): void
    {
        $this->db->query('UPDATE note SET body = :body WHERE id = :id', [
            'id' => $id,
            'body' => $body
        ]);
    }

    public function deleteNoteById(int $id): void
    {
        $this->db->query('DELETE FROM note WHERE id = :id', [
            'id' => $id
        ]);
    }
}