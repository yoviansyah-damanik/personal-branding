@extends('backend.layouts.app')

@section('title', __('Contact'))

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __('Contacts') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.homepage') }}">{{ __('Dashboard') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('dashboard.contact') }}">{{ __('Contacts') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $contact->ticket_number }}</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">{{ __('Ticket Number') }}: {{ $contact->ticket_number }}</h2>

                <div class="card">
                    <div class="card-body">
                        <article class="row article-content">
                            <div class="col-lg-6">
                                <div class="content">
                                    <div class="title">{{ $contact->ticket_number }}</div>
                                    <div class="subtitle">
                                        <div class="time">
                                            <i class="fas fa-clock"></i>
                                            {{ $contact->created_at->diffForHumans() }}
                                        </div>
                                        <div class="divide"></div>
                                        <div class="time">
                                            @if ($contact->is_read)
                                                <i class="fas fa-book"></i>
                                                {{ Carbon::parse($contact->read_at)->format('d/m/Y H:i:s') }}
                                            @else
                                                {{ __('Not yet read.') }}
                                            @endif
                                        </div>
                                        <div class="divide"></div>
                                        <div class="time">
                                            @if ($contact->is_replied)
                                                <i class="fas fa-replied"></i>
                                                {{ Carbon::parse($contact->replied_at)->format('d/m/Y H:i:s') }}
                                            @else
                                                {{ __('Not yet replied.') }}
                                            @endif
                                        </div>
                                    </div>

                                    <div class="body">
                                        {!! $contact->message !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                {{ __('Coming Soon') }}
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $('#delete-contact').on('click', (e) => {
            e.preventDefault()

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger ml-2'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: `{{ __('Are you sure?') }}`,
                text: `{{ __('You wont be able to revert this!') }}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: `{{ __('Yes, delete it!') }}`,
                cancelButtonText: `{{ __('No, cancel!') }}`,
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        `{{ __('Wait!') }}`,
                        `{{ __('The process is in progress.') }}`,
                        'success'
                    )
                    e.target.closest('form').submit()
                }
            })
        })
    </script>
@endpush
