<header class="h-16 px-24 grid grid-cols-[1fr_auto] items-center justify-end">
    <div class="inline-flex gap-2 items-center">  {{-- Left elements --}}
        <p>ProGram</p>
        @include('partials.search-field')  {{-- To prevent search field from expanding all available space --}}
    </div>
    <div class="inline-flex gap-2 items-center">  {{-- Right elements --}}
        @include('partials.icon-button', ['iconName' => 'home', 'id' => 'home-button', 'label' => 'Home', 'type' => 'secondary', 'anchorUrl' => route('home')])
        @include('partials.theme-button')
        @include('partials.text-button', ['text' => 'Login/Register', 'id' => 'login-button', 'type' => 'primary', 'anchorUrl' => route('login')])
        @include('partials.icon-button', ['iconName' => 'grip', 'id' => 'more-button', 'label' => 'More', 'type' => 'transparent'])
    </div>
</header>