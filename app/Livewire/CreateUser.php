<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\User;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('CreateUser')]

class CreateUser extends Component
{
    use WithPagination;

    public $name = '';
    public $email = '';
    public $password = '';
    public $message = '';

    public function register()
    {
        sleep(1);
        $this->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $this->reset(['name', 'email','password']);
        session()->flash('message', 'User registration successful!');
    }

    public function render()
    {
        return view('livewire.create-user',[
        'users' => User::paginate(1),
        ]);
    }
}
