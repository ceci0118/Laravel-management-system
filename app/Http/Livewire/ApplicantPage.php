<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Applicant;
use Livewire\WithPagination;

class ApplicantPage extends Component
{
    use WithPagination;

    public $showDeleteModal = false;
    public $sortField = 'updated_at';
    public $sortDirection = 'desc';
    public $search = '';

    public $selected = [];

    protected $listeners = ['refreshApplicants' => '$refresh'];

    public function sortBy($field)
    {

        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.applicant-page',[
            'applicants' => Applicant::query()
                ->where('first', 'LIKE', '%' . $this->search . '%')
                ->orWhere('last', 'LIKE', '%' . $this->search . '%')
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10),
        ]);
    }

    public function exportSelected()
    {
        return response()->streamDownload(function(){
            echo Applicant::whereKey($this->selected)->toCsv();
        }, 'applicants.csv');

    }

    public function deleteSelected()
    {
        $applicants = Applicant::whereKey($this->selected);

        $applicants->delete();

        $this->showDeleteModal = false;

        $this->dispatchBrowserEvent('notify', 'Deleted ' .  count($applicants) . ' applicants');
    }

}
