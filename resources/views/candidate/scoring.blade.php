@extends('layouts.app')

{{-- initialized some variables --}}
@php
    $score = [];
@endphp

@section('content')
    <div class="row g-3">
        <div class="col-md-auto">
            <h1 class="">Scoring Candidates</h1>
            <h2 class="">{{ $category->title }}</h2>
        </div>
        <div class="col-md">
            <p class="fs-4 m-0">Criterias</p>
            <ul class="m-0">
                {{-- list of criterias --}}
                @foreach ($criterias as $criteria)
                    <li>
                        <div class="row g-1">
                            <div class="col-auto">
                                {{ $criteria->name }}
                            </div>
                            <div class="col"><hr></div>
                            <div class="col-auto">{{ $criteria->points }}%</div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <hr>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ url('submitScoreCandidate') }}" method="post" class="needs-validations" novalidate>
        {{-- for validation --}}
        @csrf

        {{-- the other values --}}
        {{-- the catogory --}}
        <input type="text" class="d-none" name="category" value="{{ $category->category_id }}" required>
        {{-- the judge --}}
        <input type="text" class="d-none" name="judge" value="{{ Auth::user()->name }}" required>

        {{-- candidates --}}
        <div class="row g-2 justify-content-center">
            @forelse ($candidates as $candidate)
                <div class="col-md-6">
                    {{-- card --}}
                    <div class="card rounded-4 h-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                @if ($candidate->photo == 'aclc.png')
                                    <div class="text-center">
                                        <i class="bi bi-person" style="font-size: 6rem;"></i>
                                    </div>
                                @else
                                    <img src="{{ asset('storage/images/' . $candidate->photo) }}"
                                        class="img-fluid rounded-start h-100 w-100" alt="..."
                                        style="object-fit: cover;">
                                @endif

                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $candidate->name }}
                                    </h5>
                                    {{-- criterias --}}
                                    @foreach ($criterias as $criteria)
                                        <div class="row align-items-center mb-1">
                                            <div class="col-md-12">
                                                <p class="card-text m-0"><small
                                                        class="text-body-secondary">{{ $criteria->name }}
                                                        1-{{ $criteria->points }} pts</small>
                                            </div>
                                            <div class="col-md">
                                                {{-- get the scores if already submitted --}}
                                                @php
                                                    $score = [];

                                                    foreach ($scores as $key => $value) {
                                                        if (
                                                            $value->candidate == $candidate->candidate_no &&
                                                            $value->criteria == $criteria->id
                                                        ) {
                                                            $score = $value;
                                                        }
                                                    }
                                                @endphp
                                                {{-- if already scored --}}
                                                @if ($score == null)
                                                    {{-- input value points --}}
                                                    <input type="number" class="form-control contestant-scores"
                                                        name="scores[]" step="0.01" min="1"
                                                        max="{{ $criteria->points }}"
                                                        placeholder="1-{{ $criteria->points }}"
                                                        aria-describedby="score validScoresInput" required>

                                                    {{-- the crtieria --}}
                                                    <input type="text" class="d-none" name="criteria[]"
                                                        value="{{ $criteria->id }}" id="" required>
                                                    {{-- the candidate --}}
                                                    <input type="text" class="d-none" name="candidates[]"
                                                        value="{{ $candidate->candidate_no }}" id="" required>
                                                @else
                                                    <h5 class="text-muted text-center">
                                                        {{ $score->score }}
                                                    </h5>
                                                @endif

                                            </div>
                                            <div class="col-12">
                                                {{-- input tool tip alert --}}
                                                <div class="invalid-tooltip" id="validScoresInput">
                                                    Please Input a valid score.
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
        </div>

        {{-- submit button --}}
        <button type="submit" class="d-none" id="submitVotesFormBtn">Submit</button>
        <button type="button" class="d-none" id="openErrorModal" data-bs-toggle="modal"
            data-bs-target="#errorModal">Error</button>
    </form>

    {{-- if there is a score already dont show this --}}
    @if ($score == null)
        {{-- submit button to trigger the modal --}}
        <div class="text-center mt-2">
            <button type="button" class="btn btn-danger btn-lg" id="SubmitVotes" data-bs-toggle="modal"
                data-bs-target="#Modal">Submit Scores</button>
        </div>
    @endif

    {{-- modal --}}
    <div class="modal fade" tabindex="-1" id="Modal">
        <div class="modal-dialog modal-dialog-centered modal-xl text-dark">
            {{-- modal summary content --}}
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">
                        Are you sure <strong>about this Scores</strong>? review the scores before submitting.
                    </p>

                    {{-- table scores summary --}}
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Contestant</th>
                                {{-- criteria list --}}
                                @foreach ($criterias as $criteria)
                                    <th scope="col" class=" text-center">{{ $criteria->name }}
                                        pts-{{ $criteria->points }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            {{-- contestant list --}}
                            @foreach ($candidates as $candidate)
                                <tr>
                                    <th scope="row">{{ $candidate->name }}</th>
                                    {{-- criteria list --}}
                                    @foreach ($criterias as $criteria)
                                        <td class="score-input text-center"></td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal"
                        onclick="submit_votes()">Accept</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal error --}}
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-bg-danger rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title">Warning!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>Please input your score on each contestants properly.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- submits the form votes --}}
    <script>
        function submit_votes() {
            document.getElementById("submitVotesFormBtn").click();
        }

        function show_error() {
            document.getElementById("openErrorModal").click();
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

                        // alert trigger
                        show_error()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    {{-- gets the summary of candidates scores --}}
    <script>
        const myModalEl = document.getElementById('Modal')
        myModalEl.addEventListener('show.bs.modal', event => {
            // alert("Hi hi")
            var contestant_scores = document.getElementsByClassName('contestant-scores');
            var inputed_scores = document.getElementsByClassName('score-input');

            // alert(selected_candidates.length);
            // selected_candidates[0].innerHTML = "test";

            for (let index = 0; index < contestant_scores.length; index++) {
                inputed_scores[index].innerHTML = contestant_scores[index].value
            }
        })
    </script>
@endsection
