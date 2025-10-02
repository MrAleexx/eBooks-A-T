<?php
// app/Livewire/BookContributorsManager.php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Book;
use App\Models\BookContributor;

class BookContributorsManager extends Component
{
    public $book;
    public $contributors = [];
    public $showForm = false;
    public $editingIndex = null;

    public $form = [
        'contributor_type' => 'author',
        'full_name' => '',
        'email' => '',
        'sequence_number' => 1,
        'biographical_note' => ''
    ];

    protected $rules = [
        'form.contributor_type' => 'required|in:author,editor,translator',
        'form.full_name' => 'required|string|max:200',
        'form.email' => 'nullable|email',
        'form.sequence_number' => 'required|integer|min:1',
        'form.biographical_note' => 'nullable|string'
    ];

    public function mount(Book $book)
    {
        $this->book = $book;
        $this->loadContributors();
    }

    public function loadContributors()
    {
        $this->contributors = $this->book->contributors()
            ->orderBy('sequence_number')
            ->get()
            ->toArray();
    }

    public function addContributor()
    {
        $this->validate();

        BookContributor::create(array_merge($this->form, [
            'book_id' => $this->book->id
        ]));

        $this->resetForm();
        $this->loadContributors();
        $this->showForm = false;

        $this->dispatch('contributor-added');
    }

    public function editContributor($index)
    {
        $contributor = $this->contributors[$index];
        $this->form = [
            'contributor_type' => $contributor['contributor_type'],
            'full_name' => $contributor['full_name'],
            'email' => $contributor['email'],
            'sequence_number' => $contributor['sequence_number'],
            'biographical_note' => $contributor['biographical_note']
        ];
        $this->editingIndex = $index;
        $this->showForm = true;
    }

    public function updateContributor()
    {
        $this->validate();

        $contributor = BookContributor::find($this->contributors[$this->editingIndex]['id']);
        $contributor->update($this->form);

        $this->resetForm();
        $this->loadContributors();
        $this->showForm = false;

        $this->dispatch('contributor-updated');
    }

    public function deleteContributor($index)
    {
        $contributor = BookContributor::find($this->contributors[$index]['id']);
        $contributor->delete();

        $this->loadContributors();
        $this->dispatch('contributor-deleted');
    }

    public function resetForm()
    {
        $this->form = [
            'contributor_type' => 'author',
            'full_name' => '',
            'email' => '',
            'sequence_number' => count($this->contributors) + 1,
            'biographical_note' => ''
        ];
        $this->editingIndex = null;
        $this->resetErrorBag();
    }

    public function cancelEdit()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    public function render()
    {
        return view('livewire.book-contributors-manager');
    }
}
