@extends('layouts.app')

@section('content')
    <h1 class="text-center">List of Users</h1>
    <hr>

    {{-- alert --}}
    @include('components.alert')

    {{-- candidate list cards male --}}
    <div class="row g-2 justify-content-center">
        @forelse ($users as $user)
            <div class="col-md-6">
                {{-- card --}}
                <div class="card h-100">
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('user.edit', $user->id) }}" class="text-decoration-none text-dark">
                                        {{ $user->name }}
                                    </a>
                                </h5>
                                <p class="card-text"><small class="text-body-secondary">{{ $user->type }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-md-6">
                {{-- card --}}
                <div class="card h-100">
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <h5 class="card-title text-muted">
                                    No Users Listed
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
