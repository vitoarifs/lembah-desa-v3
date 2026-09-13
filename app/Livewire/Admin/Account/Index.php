<?php

namespace App\Livewire\Admin\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $userId;
    public $name;
    public $email;
    public $password;
    public $is_active = true;

    public $search = '';
    public $isOpen = false;
    public $isConfirmingDelete = false;

    protected $queryString = ['search' => ['except' => '']];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $user = User::where('role', 'content_manager')->findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->is_active = $user->is_active;
        $this->password = ''; // Kosongkan saat edit

        $this->isOpen = true;
    }

    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'is_active' => 'boolean',
        ];

        if (!$this->userId) {
            $rules['password'] = 'required|string|min:8';
        } else {
            $rules['password'] = 'nullable|string|min:8';
        }

        $this->validate($rules);

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => 'content_manager',
            'is_active' => $this->is_active,
        ];

        if (!empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        User::updateOrCreate(
            ['id' => $this->userId],
            $data
        );

        session()->flash('message', $this->userId ? 'Akun Content Manager berhasil diperbarui.' : 'Akun Content Manager baru berhasil dibuat.');

        $this->closeModal();
    }

    public function toggleActive($id)
    {
        $user = User::where('role', 'content_manager')->findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);

        session()->flash('message', 'Status akun ' . $user->name . ' berhasil diubah.');
    }

    public function confirmDelete($id)
    {
        $this->userId = $id;
        $this->isConfirmingDelete = true;
    }

    public function delete()
    {
        $user = User::where('role', 'content_manager')->findOrFail($this->userId);
        $user->delete();

        session()->flash('message', 'Akun Content Manager berhasil dihapus.');
        $this->isConfirmingDelete = false;
        $this->resetFields();
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->userId = null;
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        $users = User::query()
            ->where('role', 'content_manager')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.account.index', [
            'users' => $users,
        ]);
    }
}