@props(['type', 'results', 'numResults'])

@extends('layouts.app')
@section('title')
    {{'Search | Program'}}
@endsection
@section('content')
    <main id="search-page" class="px-8 grid grid-cols-4 grid-rows-[auto_1fr] gap-6">
        <section id="search-options" class="card h-min">
            <h1 class="pb-4 text-xl font-semibold">Search Options</h1>
            <div class="border-t border-slate-300 dark:border-slate-600 grid justify-stretch">
                @include('partials.search-type-button', ['optionType' => 'posts', 'searchType' => $type, 'icon' => 'message-circle', 'text' => 'Posts'])
                @include('partials.search-type-button', ['optionType' => 'users', 'searchType' => $type, 'icon' => 'user-round', 'text' => 'Users'])
                @include('partials.search-type-button', ['optionType' => 'groups', 'searchType' => $type, 'icon' => 'users-round', 'text' => 'Groups'])
            </div>
        </section>

        @if($type === 'posts')
            <section id="search-filters" class="card h-min row-start-2 space-y-4">
                <h1 class="text-xl font-semibold">Search Filters</h1>
                @include('partials.select', [
                    'name' => 'tags[]',
                    'label' => 'Tags',
                    'options' => $tags,
                    'multi' => true,
                    'selected' => request('tags'),
                    'form' => 'search-field'
                ])
                @include('partials.select', [
                    'name' => 'search_attr',
                    'label' => 'Search By',
                    'options' => [
                        (object) ['id' => null, 'name' => 'All'],
                        (object) ['id' => 'author', 'name' => 'Post Author'],
                        (object) ['id' => 'group', 'name' => 'Post Group'],
                    ],
                    'selected' => request('search_attr'),
                    'form' => 'search-field'
                ])
            </section>
        @endif

        <section id="search-results" class="flex flex-col col-span-3 row-span-2 gap-3">
            @switch($type)
                @case('posts')
                    @if ($numResults > 0)
                        <h1 class="text-xl font-semibold">
                            Found {{ $numResults . ($numResults === 1 ? ' post' : ' posts') }}</h1>
                        <div id="search-posts" class="space-y-3">
                            @include('partials.post-list', ['posts' => $results])
                        </div>
                    @else
                        <h1 class="text-xl font-semibold">No posts found</h1>
                    @endif
                    @break
                @case('users')
                    @if ($numResults > 0)
                        <h1 class="text-xl font-semibold">
                            Found {{ $numResults . ($numResults === 1 ? ' user' : ' users') }}</h1>
                        <div id="search-users" class="space-y-3">
                            @include('partials.user-list', ['users' => $results])
                        </div>
                    @else
                        <h1 class="text-xl font-semibold">No users found</h1>
                    @endif
                    @break
                @case('groups')
                    @if ($numResults > 0)
                        <h1 class="text-xl font-semibold">
                            Found {{ $numResults . ($numResults === 1 ? ' group' : ' groups') }}</h1>
                        <div id="search-groups" class="space-y-3">
                            @include('partials.group-list', ['groups' => $results])
                        </div>
                    @else
                        <h1 class="text-xl font-semibold">No groups found</h1>
                    @endif
                    @break
            @endswitch
            <div class="flex flex-col items-center">
                @include('partials.loading-spinner')
            </div>
        </section>
    </main>
@endsection