<div class="contact__form col-margin">
    <div class="contact__form-input">
        <input type="text" wire:model.lazy="contact_name" id="contactName" placeholder="{{ __('Enter Your Name') }}" />
        @error('contact_name')
            <span class="text-danger small">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="contact__form-input">
        <input type="email" wire:model.lazy="contact_email" id="contactEmail"
            placeholder="{{ __('Enter Email Address') }}" />
        @error('contact_email')
            <span class="text-danger small">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="contact__form-input">
        <input type="number" wire:model.lazy="contact_person" id="contactPerson"
            placeholder="{{ __('Enter Contact Person') }}" />
        @error('contact_person')
            <span class="text-danger small">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="contact__form-input">
        <input type="text" wire:model.lazy="subject" id="contactSub" placeholder="{{ __('Subject') }}" />
        @error('subject')
            <span class="text-danger small">
                {{ $message }}
            </span>
        @enderror
    </div>
    <div class="contact__form-input">
        <textarea wire:model.lazy="message" id="contactMessage" placeholder="{{ __('Write me a message') }}"></textarea>
        @error('message')
            <span class="text-danger small">
                {{ $message }}
            </span>
        @enderror
    </div>
    <button wire:click="store_contact" wire:loading.attr="disabled">{{ __('Contact Me') }}</button>
</div>
