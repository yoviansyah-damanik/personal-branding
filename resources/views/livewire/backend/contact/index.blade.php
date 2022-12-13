<div>
    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text bg-primary text-white">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <input wire:model.500ms="s" type="text" class="form-control"
                    placeholder="{{ __('Enter some letters to search') }}">
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <th>#</th>
                                <th>{{ __('Ticket Number') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Contact') }}</th>
                                <th>{{ __('Subject') }}</th>
                                <th>{{ __('Is Read') }}</th>
                                <th>{{ __('Is Replied') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th></th>
                            </thead>
                            <tbody>
                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>
                                            {{ $contacts->perPage() * ($contacts->currentPage() - 1) + $loop->iteration }}
                                        </td>
                                        <td>
                                            {{ $contact->ticket_number }}
                                        </td>
                                        <td>
                                            {{ $contact->name }}
                                        </td>
                                        <td>
                                            {{ $contact->email }}
                                        </td>
                                        <td>
                                            {{ $contact->contact }}
                                        </td>
                                        <td>
                                            {{ $contact->subject }}
                                        </td>
                                        <td>
                                            @if ($contact->is_read)
                                                <span class="rounded small text-white py-1 px-3 bg-success">
                                                    {{ $contact->read_status }}
                                                </span>
                                            @else
                                                <span class="rounded small text-white py-1 px-3 bg-danger">
                                                    {{ $contact->read_status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($contact->is_replied)
                                                <span class="rounded small text-white py-1 px-3 bg-success">
                                                    {{ $contact->replied_status }}
                                                </span>
                                            @else
                                                <span class="rounded small text-white py-1 px-3 bg-danger">
                                                    {{ $contact->replied_status }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $contact->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('dashboard.contact.show', $contact->ticket_number) }}"
                                                class="btn btn-sm btn-primary" title="{{ __('View') }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan=9>{{ __('No data found') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $contacts->links() }}
</div>
