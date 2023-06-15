<?php

namespace App\Http\Livewire\Vendor\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Vendor\Category as CategoryModel;

class Category extends Component
{
    use WithPagination, WithFileUploads;

    public $categoryId;
    public $name;
    public $slug;
    public $position;
    public $description;
    public $image;
    public $featured;
    public $status;
    public $updateMode = false;

    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $paginationTheme = 'bootstrap';


    protected $rules = [
        'name' => 'required',
        'position' => 'required|numeric',
        'description' => 'nullable',
        'image' => 'nullable|image|max:2048', // Assuming you're validating an image upload field
        'featured' => 'nullable|boolean',
        'status' => 'nullable|boolean',
    ];

    public function render()
    {
        $categories = $this->getCategories();
        return view('livewire.vendor.categories.category', compact('categories'));
    }

    public function getCategories()
    {
        $categories = CategoryModel::list($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
        return $categories;
    }

    public function saveCategory()
    {
        $data = $this->validate();
        dd($this->image);
        // Show success message or perform any other actions

        // Refresh the categories list or redirect if needed
        // $this->emit('categorySaved');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->position = '';
        $this->description = '';
        $this->image = '';
        $this->featured = '';
        $this->status = '';
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}
