<?php

namespace App\Livewire\Admin\Event;

use App\Models\Event;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $eventId;
    public $judul, $tanggal, $waktu, $lokasi, $htm, $deskripsi;
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
        $event = Event::findOrFail($id);
        $this->eventId = $event->id;
        $this->judul = $event->judul;
        $this->tanggal = $event->tanggal->format('Y-m-d');
        $this->waktu = $event->waktu;
        $this->lokasi = $event->lokasi;
        $this->htm = $event->htm;
        $this->deskripsi = $event->deskripsi;
        $this->is_active = $event->is_active;

        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'htm' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'is_active' => 'boolean',
        ]);

        Event::updateOrCreate(
            ['id' => $this->eventId],
            [
                'judul' => $this->judul,
                'slug' => Str::slug($this->judul) . '-' . Str::random(5),
                'tanggal' => $this->tanggal,
                'waktu' => $this->waktu,
                'lokasi' => $this->lokasi,
                'htm' => $this->htm,
                'deskripsi' => $this->deskripsi,
                'is_active' => $this->is_active,
            ]
        );

        session()->flash('message', $this->eventId ? 'Event berhasil diperbarui.' : 'Event baru berhasil ditambahkan.');

        $this->closeModal();
    }

    public function confirmDelete($id)
    {
        $this->eventId = $id;
        $this->isConfirmingDelete = true;
    }

    public function delete()
    {
        $event = Event::findOrFail($this->eventId);
        $event->delete();

        session()->flash('message', 'Event berhasil dihapus.');
        $this->isConfirmingDelete = false;
        $this->resetFields();
    }

    public function toggleActive($id)
    {
        $event = Event::findOrFail($id);
        $event->update(['is_active' => !$event->is_active]);
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->eventId = null;
        $this->judul = '';
        $this->tanggal = '';
        $this->waktu = '';
        $this->lokasi = '';
        $this->htm = '';
        $this->deskripsi = '';
        $this->is_active = true;
        $this->resetErrorBag();
    }

    public function render()
    {
        $events = Event::query()
            ->where('judul', 'like', '%' . $this->search . '%')
            ->orWhere('lokasi', 'like', '%' . $this->search . '%')
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('livewire.admin.event.index', [
            'events' => $events,
        ]);
    }
}