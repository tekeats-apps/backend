<?php

namespace App\Http\Livewire\Vendor\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vendor\Category as CategoryModel;

class Category extends Component
{
    use WithPagination;


    public $positions;
    public $usedPositions;

    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete-category' => 'deleteCategory'];

    public function render()
    {
        $categories = $this->getCategories();
        $this->usedPositions = CategoryModel::pluck('position')->toArray();
        $this->positions = range(1, CategoryModel::MAX_POSITION);
        return view('livewire.vendor.categories.category', compact('categories'));
    }

    public function getCategories()
    {
        $categories = CategoryModel::list($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
        return $categories;
    }

    public function toggleStatus($categoryId)
    {
        $category = CategoryModel::findOrFail($categoryId);
        $category->status = !$category->status;
        $category->save();

        $statusMessage = $category->status ? 'active' : 'inactive';
        session()->flash('message', 'Status updated to ' . $statusMessage);

        // Refresh the component to update the UI
        $this->render();
    }

    public function confirmDelete($categoryId)
    {
        CategoryModel::findOrFail($categoryId);

        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the category. This action cannot be undone.',
            'categoryId' => $categoryId,
        ]);
    }

    public function deleteCategory($categoryId)
    {
        $category = CategoryModel::findOrFail($categoryId);

        // Delete the subcategories using the relationship
        $category->subcategories()->delete();

        // Delete the category
        $category->delete();

        session()->flash('message', 'Category and its subcategories deleted successfully.');

        // Refresh the component to update the UI
        $this->render();
    }
}
