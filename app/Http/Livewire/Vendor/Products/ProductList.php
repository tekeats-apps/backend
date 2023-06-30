<?php

namespace App\Http\Livewire\Vendor\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vendor\Product;

class ProductList extends Component
{
    use WithPagination;

    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $paginationTheme = 'bootstrap';

    protected $listeners = ['delete-product' => 'deleteProduct'];

    public function render()
    {
        $products = $this->getProducts();
        return view('livewire.vendor.products.product-list', compact('products'));
    }

    public function getProducts()
    {
        $categories = Product::list($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
        return $categories;
    }

    public function toggleStatus($productId)
    {
        $product = Product::findOrFail($productId);
        $product->status = !$product->status;
        $product->save();

        $statusMessage = $product->status ? 'Active' : 'Inactive';
        session()->flash('message', 'Status updated to ' . $statusMessage);

        // Refresh the component to update the UI
        $this->render();
    }

    public function confirmDelete($productId)
    {
        Product::findOrFail($productId);

        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the product. This action cannot be undone.',
            'productId' => $productId,
        ]);
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);
        // Delete the product
        $product->delete();

        session()->flash('message', 'Product deleted successfully.');

        // Refresh the component to update the UI
        $this->render();
    }
}
