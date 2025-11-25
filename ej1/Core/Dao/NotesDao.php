<?php

namespace Core\Dao;

interface NotesDao
{
    public function getAllNotesByUserId(int $userId): array;
    public function getNoteById(int $id): array;
    public function createNote(string $body, int $userId): void;
    public function updateNote(int $id, string $body): void;
    public function deleteNoteById(int $id): void;
}