<?php

namespace Http\controllers;

use Core\App;
use Core\Database;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class NotesController
{
    protected function currentUserId() {
        return $_SESSION['user']['id'] ?? null;
    }

    protected function getNoteOrFail($id) {
        $db = App::resolve(Database::class);
        $note = $db->query("SELECT * FROM note WHERE id = :id", [
            'id' => $id
        ])->findOrFail();

        authorize($note['user_id'] === $this->currentUserId());

        return $note;
    }

    function createNotes(): void
    {
        view("notes/create.view.php", [
            'heading' => 'Create Notes',
            'errors' => []
        ]);
    }

    function edit(): void
    {
        if (!isset($_GET['id'])) {
            abort();
        }

        $note = $this->getNoteOrFail($_GET['id']);

        view("notes/edit.view.php", [
            'heading' => 'Edit Notes',
            'errors' => [],
            'note' => $note
        ]);
    }

    function showNotes(): void
    {
        $db = App::resolve(Database::class);

        $notes = $db ->query('SELECT * FROM note WHERE user_id=1')->get();

        view("notes/index.view.php", [
            'heading' => 'My Notes',
            'notes' => $notes
        ]);
    }

    function showNote(): void
    {
        if (!isset($_GET['id'])) {
            abort();
        }

        $note = $this->getNoteOrFail($_GET['id']);

        view("notes/show.view.php", [
            'heading' => 'Note',
            'note' => $note
        ]);
    }

    function store(): void
    {
        $userId = $this->currentUserId();
        if (!$userId) {
            header('location: /login'); // o abort()
            exit;
        }

        $db = App::resolve(Database::class);

        $errors = [];

        if (! Validator::string($_POST['body'], 1,1000)){
            $errors['body'] = 'A body of no more 1,000 characters is required';
        }

        if(! empty($errors)){
            view("notes/create.view.php", [
                'heading' => 'Create Notes',
                'errors' => $errors
            ]);
        }
        $db->query('INSERT INTO note(body,user_id) VALUES (:body, :user_id)',[
            'body' => $_POST['body'],
            'user_id'=> $userId
        ]);

        header('location: /notes');
        exit;
    }

    #[NoReturn]
    function update(): void
    {
        if (!isset($_POST['id'])) {
            abort();
        }

        $note = $this->getNoteOrFail($_POST['id']);

        $errors = [];

        if (! Validator::string($_POST['body'], 1,1000)){
            $errors['body'] = 'A body of no more 1,000 characters is required';
        }

        if (count($errors)) {
            view('notes/edit.view.php', [
                'heading' => 'Edit Note',
                'errors' => $errors,
                'note' => $note
            ]);
        }

        $db = App::resolve(Database::class);
        $db->query('update note set body = :body where id = :id',[
            'id' => $_POST['id'],
            'body' => $_POST['body']
        ]);

        header('location: /notes');
        exit;
    }

    #[NoReturn]
    function destroy(): void
    {
        if (!isset($_POST['id'])) {
            abort(404);
        }

        $note = $this->getNoteOrFail($_POST['id']);

        $db = App::resolve(Database::class);
        $db->query("DELETE FROM note WHERE id = :id", [
            'id' => $note['id']
        ]);

        header('location: /notes');
        exit;
    }
}