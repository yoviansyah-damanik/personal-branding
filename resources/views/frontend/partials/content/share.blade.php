<div class="section__shares">
    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}"
        class="section__share_item section__share_facebook">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a target="_blank" href="https://twitter.com/share?text={{ $excerpt }}&url={{ Request::fullUrl() }}"
        class="section__share_item section__share_twitter">
        <i class="fab fa-twitter"></i>
    </a>
    <a target="_blank"
        href="whatsapp://send?text=*{{ $title }}* %0A%0A{{ $excerpt }} %0A%0A{{ Request::fullUrl() }}"
        class="section__share_item section__share_whatsapp">
        <i class="fab fa-whatsapp"></i>
    </a>
    <a target="_blank" href="https://plus.google.com/share?url={{ Request::fullUrl() }}"
        class="section__share_item section__share_google">
        <i class="fab fa-google-plus-g"></i>
    </a>
</div>
