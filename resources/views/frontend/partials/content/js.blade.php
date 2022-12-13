<script src="{{ asset('frontend-assets/vendor/jquery/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend-assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend-assets/vendor/nice-select/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('frontend-assets/vendor/magnific-popup/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('frontend-assets/vendor/slick/js/slick.min.js') }}"></script>
<script src="{{ asset('frontend-assets/vendor/typed/typed.js') }}"></script>
<script src="{{ asset('frontend-assets/vendor/fullpage/js/scrolloverflow.js') }}"></script>
<script src="{{ asset('frontend-assets/vendor/fullpage/js/jquery.fullpage.js') }}"></script>
<script src="{{ asset('frontend-assets/vendor/three/three.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenLite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/plugins/CSSPlugin.min.js"></script>
{{-- <script src="{{ asset('frontend-assets/js/plugin.js') }}"></script> --}}
<script type="text/javascript">
    (function($) {
        jQuery(document).ready(function() {
            // aos animation
            $("[data-aos]").each(function() {
                $(this).addClass("aos-init aos-animate");
            });
        });
    })(jQuery);
</script>
<script src="{{ asset('frontend-assets/js/main.js') }}"></script>
@livewireScripts
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />
@stack('scripts')
