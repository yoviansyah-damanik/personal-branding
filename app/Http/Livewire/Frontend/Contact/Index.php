<?php

namespace App\Http\Livewire\Frontend\Contact;

use App\Helpers\GeneralHelper;
use Exception;
use Throwable;
use App\Models\Contact;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use LivewireAlert;

    public $contact_name, $contact_email, $contact_person, $subject, $message;

    public function render()
    {
        return view('livewire.frontend.contact.index');
    }

    public function rules()
    {
        return [
            'contact_name' => 'required|max:60',
            'contact_email' => 'required|email:dns',
            'contact_person' => 'required|numeric',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function validationAttributes()
    {
        return [
            'contact_name' => __('Contact Name'),
            'contact_email' => __('Contact Email'),
            'contact_person' => __('Contact Person'),
            'subject' => __('Subject'),
            'message' => __('Message')
        ];
    }

    public function updated($attribute)
    {
        $this->validateOnly($attribute);
    }

    public function store_contact()
    {
        $this->validate();

        try {
            $ticket_number = GeneralHelper::generate_ticket_number();
            Contact::create([
                'ticket_number' => $ticket_number,
                'name' => $this->contact_name,
                'email' => $this->contact_email,
                'contact' => $this->contact_person,
                'subject' => $this->subject,
                'message' => $this->message
            ]);

            $this->alert(
                'success',
                __('Successfully!'),
                ['text' => __('Your message has been sent. Please wait for our reply.')]
            );

            $this->reset();
        } catch (Exception $e) {
            $this->alert(
                'warning',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        } catch (Throwable $e) {
            $this->alert(
                'warning',
                __('Something went wrong!'),
                ['text' => $e->getMessage()]
            );
        }
    }
}
