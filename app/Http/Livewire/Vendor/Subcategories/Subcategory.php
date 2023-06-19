<?php

namespace App\Http\Livewire\Vendor\subcategories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vendor\Category as CategoryModel;

class Subcategory extends Component
{
    use WithPagination;


    public $positions;
    public $usedPositions;
    public $categoryId;

    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete-category' => 'deleteCategory'];

    public function mount($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function render()
    {
        $categories = $this->getSubCategories($this->categoryId);
        $this->usedPositions = CategoryModel::pluck('position')->toArray();
        $this->positions = range(1, CategoryModel::MAX_POSITION);
        return view('livewire.vendor.subcategories.subcategory', compact('categories'));
    }

    public function getSubCategories($parentId)
    {
        $categories = CategoryModel::getSubCategorieslist($parentId, $this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
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
        $category = CategoryModel::withTrashed()->findOrFail($categoryId);
        $category->delete();

        session()->flash('message', 'Category deleted successfully.');

        // Refresh the component to update the UI
        $this->render();
    }
}
