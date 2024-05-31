@extends('layouts.user')

@section('content')
    <h1 class="mb-4 display-2 text-center">{{ $category->title }}</h1>

    <hr>

    {{-- alert --}}
    @include('components.alert')

    <div class="p-3 pt-0">
        {{-- candidates --}}
        <form action="{{ route('submitCandidatesScores') }}" method="post" class="needs-validations" novalidate>
            {{-- for validation --}}
            @csrf

            {{-- constant values --}}
            <div class="d-flex justify-content-center visually-hidden">
                <input type="text" class="form-control" name="category" value="{{ $category->category_id }}">
                <input type="text" class="form-control" name="judge"
                    value="{{ Session::get('Judge_user')[0]->firstname }}">
            </div>

            {{-- male candidates --}}
            <div class="row mt-4 gap-2 justify-content-center">
                <div class="col-12">
                    <h2 class="text-center display-4">Male</h2>
                </div>
                @foreach ($CandidatesMale as $male)
                    <div class="col-auto p-0">
                        {{-- card --}}
                        <div class="card" style="width: 20rem;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/images/' . $male->photo) }}"
                                        class="img-fluid rounded-start h-100" alt="..." style="object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title text-truncate">{{ $male->contestant_no }} -
                                            {{ $male->firstname }}
                                            {{ $male->lastname }}</h5>
                                        {{-- input scores --}}
                                        @foreach ($Criterias as $Criteria)
                                            @if ($Criteria->category == $category->category_id)
                                                <p class="card-text m-0"><small
                                                        class="text-body-secondary">{{ $Criteria->name }}</small>
                                                </p>
                                                {{-- get the scores if already submitted --}}
                                                @forelse ($Scores as $score)
                                                    @if (
                                                        $score->candidate == $male->firstname &&
                                                            $score->category == $category->category_id &&
                                                            $score->criteria == $Criteria->name)
                                                        <h5 class="text-muted">
                                                            {{ $score->score }}
                                                        </h5>
                                                    @endif
                                                @empty
                                                    {{-- input value points --}}
                                                    <input type="number" class="form-control" name="scores[]"
                                                        id="score" step="0.01" min="1"
                                                        max="{{ $Criteria->points }}"
                                                        placeholder="1-{{ $Criteria->points }}"
                                                        {{-- value="{{ $Criteria->points }}" --}}
                                                        aria-describedby="score validScoresInput" required>
                                                @endforelse

                                                {{-- input tool tip alert --}}
                                                <div class="invalid-tooltip" id="validScoresInput">
                                                    Please Input a valid score.
                                                </div>
                                                {{-- the crtieria --}}
                                                <input type="text" class="d-none" name="criteria[]"
                                                    value="{{ $Criteria->name }}" id="" required>
                                                {{-- the candidate --}}
                                                <input type="text" class="d-none" name="candidates[]"
                                                    value="{{ $male->firstname }}" id="" required>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- female candidates --}}
            <div class="row mt-4 gap-2 justify-content-center">
                <div class="col-12">
                    <h2 class="text-center display-4">Female</h2>
                </div>
                @foreach ($CandidatesFemale as $female)
                    <div class="col-auto p-0">
                        {{-- card --}}
                        <div class="card" style="width: 20rem;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="{{ asset('storage/images/' . $female->photo) }}"
                                        class="img-fluid rounded-start h-100" alt="..." style="object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title text-truncate">{{ $female->contestant_no }} -
                                            {{ $female->firstname }}
                                            {{ $female->lastname }}</h5>
                                        {{-- input scores --}}
                                        @foreach ($Criterias as $Criteria)
                                            @if ($Criteria->category == $category->category_id)
                                                <p class="card-text m-0"><small
                                                        class="text-body-secondary">{{ $Criteria->name }}</small>
                                                </p>
                                                {{-- get the scores if already submitted --}}
                                                @forelse ($Scores as $score)
                                                    @if (
                                                        $score->candidate == $female->firstname &&
                                                            $score->category == $category->category_id &&
                                                            $score->criteria == $Criteria->name)
                                                        <h5 class="text-muted">
                                                            {{ $score->score }}
                                                        </h5>
                                                    @endif
                                                @empty
                                                    {{-- input value points --}}
                                                    <input type="number" class="form-control" name="scores[]"
                                                        id="score" step="0.01" min="1"
                                                        max="{{ $Criteria->points }}"
                                                        placeholder="1-{{ $Criteria->points }}"
                                                        {{-- value="{{ $Criteria->points }}" --}}
                                                        aria-describedby="score validScoresInput" required>
                                                @endforelse
                                                {{-- input tool tip alert --}}
                                                <div class="invalid-tooltip" id="validScoresInput">
                                                    Please Input a valid score.
                                                </div>
                                                {{-- the crtieria --}}
                                                <input type="text" class="d-none" name="criteria[]"
                                                    value="{{ $Criteria->name }}" id="" required>
                                                {{-- the candidate --}}
                                                <input type="text" class="d-none" name="candidates[]"
                                                    value="{{ $female->firstname }}" id="" required>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- submit button --}}
            <div class="text-center p-3">
                <button type="submit" class="d-none" id="submitVotesFormBtn">Submit vote</button>
            </div>
        </form>

        {{-- submit button to modal --}}
        <div class="text-center p-3">
            <hr>
            {{-- if already submitted then hide the submit button --}}
            @if ($Scores->count() > 0)
                <h1 class="text-light text-center">
                    Scores Submitted
                </h1>
            @else
                <button type="button" class="btn btn-danger btn-lg" id="SubmitVotes" data-bs-toggle="modal"
                    data-bs-target="#Modal">Submit Scores</button>
            @endif
        </div>
    </div>

    {{-- modal --}}
    <div class="modal fade" tabindex="-1" id="Modal">
        <div class="modal-dialog modal-dialog-centered text-dark">
            {{-- modal summary content --}}
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Scoring Summary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        Are you sure <strong>about this Scores</strong>? review the scores before submitting.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark"  data-bs-dismiss="modal" onclick="submit_votes()">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // submits the form votes
        function submit_votes() {
            document.getElementById("submitVotesFormBtn").click();
        }
    </script>

    <!-- Form validation script -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validations')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
@endsection
