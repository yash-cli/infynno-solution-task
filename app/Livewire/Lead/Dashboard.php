<?php

namespace App\Livewire\Lead;

use App\Enums\LeadStatus as LeadStatusEnum;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Dashboard extends Component
{
    public array $leads = [];

    public bool $showModal = false;

    #[Locked]
    public ?int $editingId = null;

    public array $recentlyMoved = [];

    public array $form = [
        'title' => '',
        'email' => '',
        'phone' => '',
    ];

    protected $rules = [
        'form.title' => 'required|string|max:255',
        'form.email' => 'required|email',
        'form.phone' => 'required|string|max:20',
    ];

    public function mount()
    {
        $this->loadLeads();
    }

    #[Computed]
    public function leadStatuses(): array
    {
        return LeadStatusEnum::values();
    }

    public function create()
    {
        $this->reset('form');
        $this->resetValidation();
        $this->editingId = null;
        $this->showModal = true;
    }

    public function edit(int $id)
    {
        $lead = Lead::where('user_id', Auth::id())->findOrFail($id);

        $this->form = [
            'title' => $lead->title,
            'email' => $lead->email,
            'phone' => $lead->phone,
        ];

        $this->editingId = $lead->id;
        $this->resetValidation();
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        if ($this->editingId) {
            Lead::where('id', $this->editingId)
                ->where('user_id', Auth::id())
                ->update([
                    'title' => $this->form['title'],
                    'email' => $this->form['email'],
                    'phone' => $this->form['phone'],
                ]);
        } else {
            Lead::create([
                'user_id' => Auth::id(),
                'title' => $this->form['title'],
                'email' => $this->form['email'],
                'phone' => $this->form['phone'],
                'status' => LeadStatusEnum::LEAD,
            ]);
        }

        $this->showModal = false;
        $this->editingId = null;
        $this->loadLeads();
    }

    public function delete(int $id)
    {
        Lead::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        $this->loadLeads();
    }

    public function loadLeads()
    {
        $this->leads = Lead::with('user')->orderBy('id', 'DESC')
            ->get()
            ->groupBy('status')
            ->toArray();
    }

    public function updateLeadOrder($groups)
    {
        $this->recentlyMoved = [];

        foreach ($groups as $group) {
            $status = $group['value'];
            $items = $group['items'] ?? [];

            foreach ($items as $item) {
                Lead::where('id', $item['value'])
                    ->update([
                        'status' => $status,
                    ]);

                $this->recentlyMoved[] = $item['value'];
            }
        }

        $this->loadLeads();
    }

    public function render()
    {
        return view('livewire.lead.dashboard')->layout('layouts.app');
    }
}
