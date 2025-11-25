<?php

namespace Http\controllers;

use Core\App;
use Core\Dao\NotesDao;
use Core\Dao\NotesDaoImpl;
use Core\Validator;
use JetBrains\PhpStorm\NoReturn;

class NotesController
{
    public NotesDao $notesDao;
    public $user;
    public array $errors;

    public function __construct()
    {
        $this->notesDao = App::resolve(NotesDao::class);
        $this->user = $_SESSION['user'] ?? null;
        $this->errors = [];
    }
    protected function currentUserId() {
        return $_SESSION['user']['id'] ?? null;
    }

    protected function getNoteOrFail($id) {

        $note = $this->notesDao->getNoteById($id);

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
        $notes = $this->notesDao->getAllNotesByUserId($this->user['id']);
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

    #[NoReturn]
    function store(): void
    {
        $userId = $this->currentUserId();
        if (!$userId) {
            header('location: /login');
            exit;
        }


        if (! Validator::string($_POST['body'], 1,1000)){
            $this->errors['body'] = 'A body of no more 1,000 characters is required';
        }

        if(! empty($errors)){
            view("notes/create.view.php", [
                'heading' => 'Create Notes',
                'errors' => $errors
            ]);
        }
        $this->notesDao->createNote($_POST['body'], $userId);

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


        if (! Validator::string($_POST['body'], 1,1000)){
            $this->errors['body'] = 'A body of no more 1,000 characters is required';
        }

        if (count($this->errors)) {
            view('notes/edit.view.php', [
                'heading' => 'Edit Note',
                'errors' => $this->errors,
                'note' => $note
            ]);
        }

        $this->notesDao->updateNote($_POST['id'], $_POST['body']);

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

        $this->notesDao->deleteNoteById($note['id']);

        header('location: /notes');
        exit;
    }
}