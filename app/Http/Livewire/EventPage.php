<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class EventPage extends Component
{
    use WithPagination;

    public $sortField = 'events.created_at';
    public $sortDirection = 'desc';
    public $search = '';

    public function render()
    {
        return view('livewire.event-page', [
            'events' => Event::join('applicants', 'events.applicant_id', '=', 'applicants.id')
            ->where('first', 'LIKE', '%' . $this->search . '%')
                ->orWhere('last', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
        ]);
    }
}
