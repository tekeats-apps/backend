<?php

namespace App\Http\Livewire\Vendor\Tags;

use Livewire\Component;
use App\Models\Vendor\Tag;
use Livewire\WithPagination;

class TagList extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete-tag' => 'deleteTag'];

    public function render()
    {
        $tags = $this->getTags();
        return view('livewire.vendor.tags.tag-list', compact('tags'));
    }

    public function getTags()
    {
        $categories = Tag::list($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
        return $categories;
    }

    public function toggleStatus($tagId)
    {
        $tag = Tag::getTagByID($tagId);
        $tag->status = !$tag->status;
        $tag->save();

        $statusMessage = $tag->status ? 'Active' : 'Inactive';
        session()->flash('message', 'Status updated to ' . $statusMessage);

        // Refresh the component to update the UI
        $this->render();
    }

    public function confirmDelete($tagId)
    {
        Tag::getTagByID($tagId);

        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the tag. This action cannot be undone.',
            'tagId' => $tagId,
        ]);
    }

    public function deleteTag($tagId)
    {
        $tag = Tag::getTagByID($tagId);
        // Delete the tag
        $tag->delete();

        session()->flash('message', 'Tag deleted successfully.');

        // Refresh the component to update the UI
        $this->render();
    }
}
