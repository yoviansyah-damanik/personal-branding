<?php

namespace App\Http\Livewire\Backend\Contact;

use App\Models\Contact;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
        $this->s = '';
    }

    public function render()
    {
        $contacts = Contact::where('name', 'like', "%$this->s%")
            ->orWhere('message', 'like', "%$this->s%")
            ->orderBy('is_read', 'desc')
            ->orderBy('is_replied', 'desc')
            ->latest()
            ->paginate(config('app.pagination_limit', 20));

        $this->dispatchBrowserEvent('tooltipReset');
        return view('livewire.backend.contact.index', [
            'contacts' => $contacts
        ]);
    }
}
