<?php

namespace App\Livewire\Admin\ContactMessages;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedMessage = null;
    public $isDetailOpen = false;
    public $isConfirmingDelete = false;
    public $messageToDeleteId = null;

    protected $queryString = ['search' => ['except' => '']];

    public function mount(): void
    {
        // Menggunakan Facade Auth lebih aman dari false-error di VS Code
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'content_manager'])) { 
            abort(403, 'Akses Ditolak. Anda tidak memiliki wewenang.');
        }
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function showDetail(int $id): void
    {
        $message = ContactMessage::findOrFail($id);

        // Otomatis tandai sebagai sudah dibaca saat dibuka
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        $this->selectedMessage = $message->fresh();
        $this->isDetailOpen = true;
    }

    public function closeDetail(): void
    {
        $this->isDetailOpen = false;
        $this->selectedMessage = null;
    }

    public function toggleRead(int $id): void
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => !$message->is_read]);

        if ($this->selectedMessage && $this->selectedMessage->id === $id) {
            $this->selectedMessage = $message->fresh();
        }

        $statusText = $message->is_read ? 'sudah dibaca' : 'belum dibaca';
        session()->flash('message', "Status pesan dari {$message->nama} berhasil ditandai sebagai {$statusText}.");
    }

    public function confirmDelete(int $id): void
    {
        $this->messageToDeleteId = $id;
        $this->isConfirmingDelete = true;
    }

    public function delete(): void
    {
        if (!$this->messageToDeleteId) {
            return;
        }

        $message = ContactMessage::findOrFail($this->messageToDeleteId);
        $nama = $message->nama;
        $message->delete();

        if ($this->selectedMessage && $this->selectedMessage->id === $this->messageToDeleteId) {
            $this->closeDetail();
        }

        $this->isConfirmingDelete = false;
        $this->messageToDeleteId = null;

        session()->flash('message', "Pesan dari {$nama} berhasil dihapus.");
    }

    public function render()
    {
        $messages = ContactMessage::query()
            ->where(function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('pesan', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        $unreadCount = ContactMessage::where('is_read', false)->count();

        return view('livewire.admin.contact-messages.index', [
            'messages' => $messages,
            'unreadCount' => $unreadCount,
        ]);
    }
}