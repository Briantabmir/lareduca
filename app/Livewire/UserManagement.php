<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User; // Importar el modelo User
use App\Models\Role; 



class UserManagement extends Component
{

    public $users, $name, $email, $password, $user_id;
    public $roles, $role;
    public $isOpen = false;
    public function mount()
    {
        $this->users = User::all();
        $this->roles = Role::all();
    }

    public function resetInputFields() 
    { 
        $this->name = ''; 
        $this->email = ''; 
        $this->user_id = ''; 
    } 

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.user-management');
    }


    public function openModal()
    {
        $this->isOpen = true;
    }


    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::updateOrCreate(['id' => $this->userId], [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $user->syncRoles($this->role);

        session()->flash('message', $this->userId ? 'User updated successfully.' : 'User created successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;

        $this->openModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'User deleted successfully.');
    }

}

