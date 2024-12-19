@extends('layouts.app')

@section('title') {{$group->name . ' | ProGram'}} @endsection

@section('content')
    <main id="group-page" class="px-8 py-4 flex flex-col gap-6">
        <section id="banner-section" class="card h-min  grid grid-cols-[auto_1fr_1fr] gap-y-8 p-8 ">
            <div class="col-span-full flex justify-between">
                <h1 class="text-4xl font-bold">{{ $group->name }}</h1>
                <div class="min-w-[24px]">
                    @if($group->is_public)
                        @include('partials.icon', ['name' => 'earth','type' => 'secondary'])
                    @else
                        @include('partials.icon', ['name' => 'lock', 'type' => 'secondary'])
                    @endif
                </div>
            </div>
            <div class="col-span-full flex justify-start items-end">
                <p class="text-xl">{{$group->description}}</p>
            </div>
            <div class="col-span-full flex justify-between ">
                <div class="flex flex-col justify-end">
                    @can('viewContent', $group)
                         <a href="{{ route('group.members', ['id' => $group->id]) }}" class="text-xl font-bold">{{$group->member_count}} members</a>
                    @endcan
                </div>
                <div id="group-buttons-container" class="flex flex-col sm:flex-row gap-2" data-group-id={{$group->id}}>
                    @can('leave', $group)
                        <form action="{{ route('group.leave', ['id' => $group->id]) }}" method="POST">
                            @csrf
                            @method('POST') 
                            @include('partials.text-button', ['text' => 'Leave Group','submit'=>true,'id'=>'leave-group-button'])
                        </form>
                        @include('partials.text-button', ['text' => 'Post to Group', 'anchorUrl' => route('group.post.create', ['group_id' => $group->id])])
                    @endcan
                    @can('join', $group)
                        @if( $group->pendingJoinRequests->where('id', Auth::id())->count() > 0)
                            @include('partials.text-button', ['text' => 'Request Pending'])
                        @else
                            <form action="{{ route('group.join', ['id' => $group->id]) }}" method="POST">
                                @csrf
                                @method('POST') 
                                @include('partials.text-button', ['text' => 'Join Group','submit'=>true, 'id'=>'join-group-button'])
                            </form>
                        @endif      
                    @endcan
                    @can('update', $group)
                        @include('partials.text-button', ['text' => 'Edit Group', 'anchorUrl' => route('group.edit', ['id' => $group->id])])
                        <article class="dropdown">
                            @include('partials.text-button', ['text' => 'Manage Group', 'id'=>'manage-group-button'])
                            <div class="hidden">
                                <div>
                                    @include('partials.dropdown-item', ['icon' => 'user-round', 'text' => 'Manage Members', 'anchorUrl' => route('group.members', ['id' => $group->id])])
                                    @if(!$group->is_public)
                                        @include('partials.dropdown-item', ['icon' => 'inbox', 'text' => 'Manage Requests', 'anchorUrl' => route('group.requests', ['id' => $group->id])])
                                    @endif
                                    @include('partials.dropdown-item', ['icon' => 'invite', 'text' => 'Manage Invites', 'anchorUrl' => route('group.invites', ['id' => $group->id])])
                                </div>
                            </div>
                        </article>
                        @include('partials.text-button', ['text' => 'Post to Group', 'anchorUrl' => route('group.post.create', ['group_id' => $group->id])])
                    @endcan

                </div>
            </div>  

        </section>
        @can('viewContent', $group)
            <section class="grid gap-4">
                <div class="flex  gap-10">
                    <button id="group-chat-tab" class="tab-button text-2xl font-bold py-2 border-b-2" data-tab="group-chat">
                        Recent Activity
                    </button>
                    <button id="board-tab" class="tab-button text-2xl font-bold py-2 text-gray-500" data-tab="board">
                        Announcements Board
                    </button>
                </div>

                <div id="group-chat-content" class="tab-content grid gap-4">
                    <article class="grid gap-4">
                        @if ($posts->count() === 0)
                            <p>No posts to show</p>
                        @else
                            @foreach ($posts as $post)
                                @include('partials.post-card', ['post' => $post])
                            @endforeach
                        @endif
                    </article>  
                </div>
            
                <div id="board-content" class="tab-content hidden grid gap-4">

                    <article class="grid gap-4">
                        @if ($announcements->count() === 0)
                            <p>No posts to show</p>
                        @else
                            @foreach ($announcements as $announcement)
                                @include('partials.post-card', ['post' => $announcement])
                            @endforeach
                        @endif
                    </article>
                </div>
            </section>
        @else
        <section id="private-profile" class="col-span-4 flex justify-center items-center h-64">
            <h1 class="text-4xl font-bold text-gray-500">This group is private</h1>
        </section>
       @endcan
    </main>
@endsection
