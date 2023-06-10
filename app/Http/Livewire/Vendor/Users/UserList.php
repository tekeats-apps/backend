<?php

namespace App\Http\Livewire\Vendor\Users;

use App\Models\Vendor\User as StoreUser;
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
         $users = StoreUser::list()->paginate(10);
         return $users;
    }
}
