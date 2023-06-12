<?php

namespace App\Http\Livewire\Vendor\Users;

use Livewire\Component;
use App\Models\Vendor\User;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;
    public $search;
    public $status;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $paginationTheme = 'bootstrap';


    public function render()
    {
        $users = $this->getUsers();
        return view('livewire.vendor.users.user-list', compact('users'));
    }

    public function getUsers()
    {
        $users = User::list($this->search, $this->status, $this->sortField, $this->sortDirection)->paginate($this->perPage);
        return $users;
    }

    public function toggleStatus($userId)
    {
        $user = User::findOrFail($userId);
        $user->status = !$user->status;
        $user->save();

        // Refresh the component to update the UI
        $this->render();
    }
}
