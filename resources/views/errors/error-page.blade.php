@props(['number', 'error', 'message', 'button' => 'home'])

<section class="h-min w-full py-12 max-w-96 col-start-2 flex flex-col items-center gap-12">
    <div id="error-info" class="grid gap-6 justify-items-center">
        <h1 class="text-9xl font-bold text-center">
            {{ $number }}
        </h1>
        <h2 class="text-3xl font-bold text-center text-blue-600 dark:text-blue-400">
            {{ $error }}
        </h2>
        <h3 class="text-xl text-center whitespace-pre-wrap">{{ $message }}</h3>
    </div>
    @switch ($button)
        @case('home')
            @include('partials.text-button', ['anchorUrl' => route('home'), 'text' => 'Return to Home Page'])
            @break
        @case('logout')
            <form method="post" action="{{ route('logout') }}">
                @csrf
                @include('partials.text-button', ['text' => 'Logout', 'submit' => true])
            </form>
            @break
    @endswitch
</section>
