<?php

namespace App\Http\Livewire\Vendor\Users;

use App\Models\Vendor\User;
use Livewire\Component;

class UserList extends Component
{
    public function render()
    {
        $users = $this->getUsers();
        return view('livewire.vendor.users.user-list', compact('users'));
    }

    public function getUsers()
    {
        $users = User::list()->paginate(10);
        return $users;
    }

    public function toggleStatus($userId)
    {
        $user = User::find($userId);
        $user->status = !$user->status;
        $user->save();

        $this->refresh(); // Manually trigger a component refresh

    }
}
