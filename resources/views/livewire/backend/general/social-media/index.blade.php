<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <th>#</th>
                    <th>{{ __('Account Name') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Icon') }}</th>
                    <th>{{ __('URL') }}</th>
                    <th></th>
                </thead>
                <tbody>
                    @forelse ($social_media as $media)
                        <tr>
                            <td>
                                {{ $social_media->perPage() * ($social_media->currentPage() - 1) + $loop->iteration }}
                            </td>
                            <td>{{ $media->name }}</td>
                            <td>{{ $media->social_media_icon->name }}</td>
                            <td>
                                <div class="text-white rounded-circle d-flex align-items-center justify-content-center"
                                    style="height:25px; width: 25px; background: {{ $media->social_media_icon->color }}">
                                    <i class="{{ $media->social_media_icon->icon }}"></i>
                                </div>
                            </td>
                            <td><a href="{{ $media->url }}">{{ $media->url }}</a></td>
                            <td>
                                <button class="btn btn-sm btn-danger" data-toggle="tooltip" title="{{ __('Delete') }}"
                                    data-placement="left" wire:click="delete_social_media({{ $media->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan=5>{{ __('No data found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
