<div class="section__social_media">
    <button id="social_media_toggle_button">
        <i class="fas fa-share-nodes"></i>
    </button>
    <div class="section__social_media_items top">
        @foreach ($_social_media as $item)
            <a href="{{ $item->url }}" target="_blank" style="background: {{ $item->social_media_icon->color }}">
                <i class="{{ $item->social_media_icon->icon }}"></i>
            </a>
        @endforeach
    </div>
    <div class="section__social_media_items left">
        <a href="tel:{{ $_phone_number }}" id="__phone_number">
            <i class="fas fa-phone"></i>
        </a>
        <a href="mailto:{{ $_email }}" id="__email">
            <i class="fas fa-envelope"></i>
        </a>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $('#social_media_toggle_button').on('click', () => {
            if ($('.section__social_media').hasClass('active')) {
                $('.section__social_media').removeClass('active')

                $('.section__social_media .section__social_media_items.top')
                    .children("a")
                    .each(
                        (idx, el) => {
                            $(el).css('bottom', 0)
                            // console.log(idx, el)
                        }
                    )

                $('.section__social_media .section__social_media_items.left')
                    .children("a")
                    .each(
                        (idx, el) => {
                            $(el).css('right', 0)
                            // console.log(idx, el)
                        }
                    )
            } else {
                $('.section__social_media').addClass('active')

                let width = parseInt($('#social_media_toggle_button').css('width').replace(/[^-+\d]/g, ""))
                let gap = parseInt($('.section__social_media_items.top').css('gap').replace(/[^-+\d]/g, ""))

                // console.log(width, gap)
                $('.section__social_media.active .section__social_media_items.top')
                    .children("a")
                    .each(
                        (idx, el) => {
                            var number = parseInt(idx + 1)
                            $(el).css('bottom', parseInt((width + gap) * number) + 'px')
                            // console.log(idx, el)
                        }
                    )

                $('.section__social_media.active .section__social_media_items.left')
                    .children("a")
                    .each(
                        (idx, el) => {
                            var number = parseInt(idx + 1)
                            $(el).css('right', parseInt((width + gap) * number) + 'px')
                            // console.log(idx, el)
                        }
                    )
            }
        })

        $(document).on('click', '#social_media_toggle_button', (e) => {
            // console.log(e.target)
            // if ($('.section__social_media').hasClass('active'))
            //     $('.section__social_media').removeClass('active')
        })
    </script>
@endpush
