<footer class="main-footer">
    <div class="footer-left">
        {{ __('Copyright') }} &copy;{{ date('Y') }}. <a href="{{ route('homepage') }}">{{ config('app.name') }}</a>.
    </div>
    <div class="footer-right">
        {{ config('app.version') }}
    </div>
</footer>
