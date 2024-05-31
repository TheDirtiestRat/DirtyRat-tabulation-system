@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <h1>Judge : {{ $judge->name }}</h1>
            {{-- <h1>Judge : {{ $judge->firstname }} {{ $judge->middlename }}. {{ $judge->lastname }}</h1> --}}
            {{-- <h4>ID: {{ $judge->judge_id }}</h4> --}}
        </div>
        <div class="col-auto">
            <div class="row g-3">
                {{-- judge list --}}
                @forelse ($judge_list as $judges)
                    <div class="col-md-auto">
                        <a href="{{ route('showJudgesResults', $judges->id) }}" class="btn btn-light shadow">
                            {{ $judges->name }}
                        </a>
                    </div>
                @empty
                    <div class="col-md-auto">
                        No judges
                    </div>
                @endforelse
            </div>
        </div>
        <div class="col-auto">
            <div class="row g-3">
                <div class="col-md-auto">
                    Print Judge Scores
                </div>
                {{-- judge list --}}
                @forelse ($judge_list as $judges)
                    <div class="col-md-auto">
                        <a href="{{ route('printJudgeScores', $judges->id) }}" target="_blank"
                            class="btn btn-outline-light shadow">
                            {{ $judges->name }}
                        </a>
                    </div>
                @empty
                    <div class="col-md-auto">
                        No judges
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- category list --}}
    @forelse ($categories as $category)
        <div class=" table-responsive">
            <table class="table table-dark table-striped align-middle">
                <thead>
                    <tr>
                        <th colspan="{{ count($criterias) + 1 }}">
                            <h2 class="text-center">{{ $category->title }}</h2>
                        </th>
                    </tr>
                    <tr>
                        <th>Candidate</th>
                        @php
                            $cri_num = 0;
                        @endphp
                        {{-- criteria list --}}
                        @forelse ($criterias as $criteria)
                            @if ($criteria->category == $category->category_id)
                                @php
                                    $cri_num++;
                                @endphp
                                <th class="text-center">{{ $criteria->name }} - {{ $criteria->points }} pts</th>
                            @endif
                        @empty
                            <th>No criteria</th>
                        @endforelse

                    </tr>
                </thead>
                <tbody>
                    {{-- candidate list --}}
                    @forelse ($candidates as $candidate)
                        @if ($candidate->category_id == $category->category_id)
                            <tr>
                                <td>
                                    {{ $candidate->name }}
                                </td>
                                @php
                                    $cri_in = 0;

                                @endphp
                                {{-- scores by category --}}
                                @foreach ($criterias as $criteria)
                                    @php
                                        $score = [];
                                        $cri_in++;
                                        foreach ($scores as $key => $value) {
                                            if (
                                                $value->candidate == $candidate->candidate_no &&
                                                $value->criteria == $criteria->id &&
                                                $value->category == $category->category_id &&
                                                $value->judge == $judge->name
                                            ) {
                                                $score = $value;
                                                // adds the scores to the sum
                                                // $sum_score += $value->score;
                                            }
                                        }

                                    @endphp
                                    @if ($score != null)
                                        <td class="text-center">
                                            {{ $score->score }}
                                        </td>
                                    @else
                                        {{-- @if ($cri_in <= $cri_num)
                                            <td class="text-center">0</td>
                                        @endif --}}
                                    @endif
                                @endforeach
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="{{ count($criterias) + 1 }}">No candidates</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @empty
        <h2 class="text-center text-muted">
            No Categories
        </h2>
    @endforelse
@endsection
