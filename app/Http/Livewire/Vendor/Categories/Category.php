<?php

namespace App\Http\Livewire\Vendor\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vendor\Category as CategoryModel;

class Category extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $paginationTheme = 'bootstrap';

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
}
