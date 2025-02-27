@props(['group', 'class' => ''])

@php($groupUrl = route('group.show', $group->id))

<article class="card px-6 flex flex-col  w-full min-h-20 {{ $class }}">
    <h1 class="font-bold text-xl"><a href="{{ $groupUrl }}">{{ $group->name }}</a></h1>
    <p class="text-pretty break-words">{{ $group->description }}</p>
    @hasSection('buttons')
        <div class="flex gap-2 justify-end group-buttons-container p-2" data-group-id={{ $group->id }}>
            @yield('buttons')
        </div>
    @endif
</article>
