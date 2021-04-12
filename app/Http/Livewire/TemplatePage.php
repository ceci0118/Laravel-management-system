<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\MailTemplate;
use Illuminate\Support\Facades\Auth;

class TemplatePage extends Component
{
    public $showModal = false;
    public $title, $content, $template_id;

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
    ];

    public function render()
    {
        return view('livewire.template-page', [
            'templates' => MailTemplate::orderBy('updated_at', 'DESC')->get()
        ]);
    }

    public function create()
    {
        $this->reset();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->showModal = true;
        
        $this->template_id = $id;
        $template = MailTemplate::find($id);
        $this->title = $template->title;
        $this->content = $template->body;
    }

    public function store()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'body' => $this->content,
            'user_id' => Auth::id()
        ];
        
        MailTemplate::updateOrCreate(['id' => $this->template_id], $data);

        $this->showModal = false;

        $this->dispatchBrowserEvent('notify', 'Mail template updated.');
    }

    public function delete($id)
    {
        MailTemplate::find($id)->delete();
        $this->showModal = false;
        $this->dispatchBrowserEvent('notify', 'Mail template deleted.');
    }
}
