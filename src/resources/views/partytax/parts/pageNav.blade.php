<!-- partytax-nav -->
<div @class(['partytax-nav', 'partytax-nav_root' => @session('is_root_partytax_pages'), 'partytax-nav_hidden' => !$pageName])>
    @unless(@session('is_root_partytax_pages'))
        <a href="{{ request()->headers->get('referer') }}" class="partytax-nav__backlink">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
        </a>
    @endunless
    <div class="partytax-nav__currentpage">
        {{ $pageName }}
    </div>
    <div></div>
</div>