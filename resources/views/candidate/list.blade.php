@extends('layouts.app')

@section('content')
    <h1 class="text-center">List of Candidate</h1>
    <hr>

    {{-- alert --}}
    @include('components.alert')

    {{-- candidate list cards male --}}
    <div class="row g-2 justify-content-center">
        @forelse ($candidates as $candidate)
            <div class="col-md-6">
                {{-- card --}}
                <div class="card h-100">
                    <div class="row">
                        <div class="col-md-4">
                            @if ($candidate->photo == 'aclc.png')
                                <div class="text-center">
                                    <i class="bi bi-person" style="font-size: 6rem;"></i>
                                </div>
                            @else
                                <img src="{{ asset('storage/images/' . $candidate->photo) }}"
                                    class="img-fluid rounded-start h-100 w-100" alt="..." style="object-fit: cover;">
                            @endif

                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('candidate.edit', $candidate->id) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $candidate->name }}
                                    </a>
                                </h5>
                                <p class="card-text">
                                    @foreach ($category_list as $category)
                                        @if ($category->candidate_no == $candidate->candidate_no)
                                            <small class="text-body-secondary">{{ $category->title }}</small>
                                            <br>
                                            {{-- @break --}}
                                        @endif
                                    @endforeach

                                </p>
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
                                    No candidates Listed.
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforelse
        {{-- @for ($i = 0; $i < $CandidatesMale->count(); $i++)
        @endfor --}}
    </div>

    {{-- candidate list cards female --}}
    {{-- <div class="row mt-4 gap-2 justify-content-center">
        <h2 class="text-center">Female</h2>
        @for ($i = 0; $i < $CandidatesFemale->count(); $i++)
            <div class="col-auto p-0">
                card
                <div class="card" style="width: 20rem;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/'. $CandidatesFemale[$i]->photo) }}" class="img-fluid rounded-start h-100" alt="..." style="object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">No. {{ $CandidatesFemale[$i]->contestant_no }}</h5>
                                <a href="{{ route('candidate.edit', $CandidatesFemale[$i]->id) }}" class="text-decoration-none">
                                    <button class="btn btn-secondary d-block w-100 mb-2 text-truncate">{{ $CandidatesFemale[$i]->firstname }} {{ $CandidatesFemale[$i]->lastname }}</button>
                                </a>
                                <p class="card-text"><small class="text-body-secondary">{{ $CandidatesFemale[$i]->middlename }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div> --}}
@endsection
