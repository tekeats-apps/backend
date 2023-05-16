<?php

namespace App\Http\Livewire\Store\Users;

use App\Models\Store\User as StoreUser;
use Livewire\Component;

class UserList extends Component
{
    public function render()
    {
        $users = $this->getUsers();
        return view('livewire.store.users.user-list', compact('users'));
    }

    public function getUsers()
    {
         $users = StoreUser::list()->paginate(10);
         return $users;
    }
}
