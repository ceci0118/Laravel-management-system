<?php

namespace App\Http\Livewire;

use App\Csv;
use Livewire\Component;
use App\Models\Guardian;
use App\Models\Applicant;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;


class ImportApplicant extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $upload;
    public $columns;

    public $fieldColumnMap = [
        'first' => '',
        'last' => '',
        'email' => '',
        'dob' => '',
        'applicant_type' => '',
        'applicant_id' => '',
        'guardian1_first' => '',
        'guardian1_last' => '',
        'guardian1_email' => '',
        'guardian2_first' => '',
        'guardian2_last' => '',
        'guardian2_email' => '',
    ];

    protected $rules = [
        'fieldColumnMap.first' => 'required',
        'fieldColumnMap.last' => 'required',
        'fieldColumnMap.email' => 'required',
        'fieldColumnMap.dob' => 'required',
        'fieldColumnMap.applicant_type' => 'required',
    ];

    protected $validationAttributes = [
        'fieldColumnMap.first' => 'First name',
        'fieldColumnMap.last' => 'Last name',
        'fieldColumnMap.email' => 'Email',
        'fieldColumnMap.dob' => 'Date of birth',
        'fieldColumnMap.applicant_type' => 'Applicant type',
    ];


    public function updatingUpload($value)
    {
        Validator::make(
            ['upload' => $value],
            ['upload' => 'required | mimes:txt,csv'],
        )->validate();
    }

    public function updatedUpload()
    {
        $this->columns = Csv::from($this->upload)->columns();

        $this->guessWhichColumnsMapToWhichFields();
    }

    public function import()
    {
        $this->validate();

        $importCount = 0;

        Csv::from($this->upload)
            ->eachRow(function ($row) use (&$importCount) {

                $attributes = collect($this->fieldColumnMap)
                    ->filter()
                    ->mapWithKeys(function ($heading, $field) use ($row) {
                        return [$field => $row[$heading]];
                    })
                    ->toArray();

                $applicantInfo = [];
                $guardian1Info = [];
                $guardian2Info = [];
                $applicant = null;
                $guardian1 = null;
                $guardian2 = null;

                foreach($attributes as $key => $value){

                    // Get applicant information
                    if (str_contains($key, 'applicant')|| $key == 'first' || $key == 'last' || $key == 'email' || $key == 'dob') {
                        $applicantInfo += [$key => $value];
                    }

                    // Get guardian 1 information
                    if (str_contains($key, 'guardian1') && $value != null) {
                        $key = ltrim($key, 'guardian1_');
                        $guardian1Info += [$key => $value];
                    }

                    // Get guardian 2 information
                    if (str_contains($key, 'guardian2') && $value != null) {
                        $key = ltrim($key, 'guardian2_');
                        $guardian2Info += [$key => $value];
                    }
                }

                $applicantInfo += ['status' => 1];

                //create applicant
                $applicant = Applicant::updateOrCreate(['email' => $applicantInfo['email']], $applicantInfo);

                //create guardians
                if ($guardian1Info != null){
                    $guardian1 = Guardian::updateOrCreate(['email' => $guardian1Info['email']], $guardian1Info);
                }
                if ($guardian2Info != null) {
                    $guardian2 = Guardian::updateOrCreate(['email' => $guardian2Info['email']], $guardian2Info);
                }

                //Link guardians to applicant
                if ($guardian1 && !$applicant->guardians->contains($guardian1->id)) 
                {
                    $applicant->guardians()->attach($guardian1->id);
                }

                if ($guardian2 && !$applicant->guardians->contains($guardian2->id)) 
                {
                    $applicant->guardians()->attach($guardian2->id);
                }

                $importCount++;
            });

        $this->reset();

        $this->emitUp('refreshApplicants');

        // Show success message
        $this->dispatchBrowserEvent('notify', 'Imported '.  $importCount .' applicants');
    }

    public function guessWhichColumnsMapToWhichFields()
    {
        $guesses = [
            'first' => ['applicant_first_name', 'first', 'applicant_first'],
            'last' => ['applicant_last_name', 'last', 'applicant_last'],
            'email' => ['applicant_email', 'email'],
            'dob' => ['applicant_dob', 'dob'],
            'applicant_type' => ['applicant_type'],
            'applicant_id' => ['applicant_id'],
            'guardian1_first' => ['guardian1_first_name'],
            'guardian1_last' => ['guardian1_last_name'],
            'guardian1_email' => ['guardian1_email'],
            'guardian2_first' => ['guardian2_first_name'],
            'guardian2_last' => ['guardian2_last_name'],
            'guardian2_email' => ['guardian2_email'],
        ];

        foreach ($this->columns as $column) {
            $match = collect($guesses)->search(fn ($options) => in_array(strtolower($column), $options));

            if ($match) $this->fieldColumnMap[$match] = $column;
        }
    }

}
