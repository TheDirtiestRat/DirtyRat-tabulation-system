@extends('pdf.layout')

@section('content')
    <div class="d-flex">
        <h2>Judge : {{ $judge->firstname }} {{ $judge->middlename }}. {{ $judge->lastname }}</h1>
        <h5 class="float-end">ID: {{ $judge->judge_id }}</h4>
    </div>

    {{-- category list --}}
    @forelse ($Categories as $Category)
        <div class="table-responsive">
            <table class="table align-middle table-sm">
                <tbody>
                    <tr>
                        {{-- get the count --}}
                        {{ $i = 0 }}
                        @foreach ($Criterias as $Criteria)
                            @if ($Criteria->category == $Category->category_id)
                                {{ $i++ }}
                            @endif
                        @endforeach

                        <th colspan="{{ $i + 2 }}" class="table-dark">
                            <h3 class="text-center">{{ $Category->title }}</h3>
                        </th>
                    </tr>
                    <tr>
                        <th>No.</th>
                        <th>Candidate</th>
                        {{-- criteria list --}}
                        @foreach ($Criterias as $Criteria)
                            @if ($Criteria->category == $Category->category_id)
                                <th class="text-center">{{ $Criteria->name }}</th>
                            @endif
                        @endforeach
                    </tr>
                    {{-- candidates list male --}}
                    <tr>
                        <th colspan="{{ $i + 2 }}" class="text-center">
                            Male
                        </th>
                    </tr>
                    @foreach ($CandidatesMale as $male)
                        <tr>
                            <td>{{ $male->contestant_no }}</td>
                            <td>{{ $male->firstname }} {{ $male->lastname }}</td>
                            {{-- criteria score list --}}
                            @forelse ($Criterias as $Criteria)
                                @if ($Criteria->category == $Category->category_id)
                                    {{-- get the scores by criteria --}}
                                    <td class="text-center">
                                        @foreach ($Scores as $Score)
                                            @if (
                                                $Criteria->category == $Category->category_id &&
                                                    $Score->category == $Category->category_id &&
                                                    $Score->criteria == $Criteria->name &&
                                                    $Score->candidate == $male->firstname)
                                                {{ $Score->score }}
                                            @endif
                                        @endforeach
                                    </td>
                                @else
                                @endif
                            @empty
                                <td></td>
                            @endforelse
                            {{-- @foreach ($Criterias as $Criteria)
                            @endforeach --}}
                        </tr>
                    @endforeach
                    {{-- candidates list female --}}
                    <tr>
                        <th colspan="{{ $i + 2 }}" class="text-center">
                            Female
                        </th>
                    </tr>
                    @foreach ($CandidatesFemale as $female)
                        <tr>
                            <td>{{ $female->contestant_no }}</td>
                            <td>{{ $female->firstname }} {{ $female->lastname }}</td>
                            {{-- criteria score list --}}
                            @foreach ($Criterias as $Criteria)
                                @if ($Criteria->category == $Category->category_id)
                                    {{-- get the scores by criteria --}}
                                    <td class="text-center">
                                        @foreach ($Scores as $Score)
                                            @if (
                                                $Criteria->category == $Category->category_id &&
                                                    $Score->category == $Category->category_id &&
                                                    $Score->criteria == $Criteria->name &&
                                                    $Score->candidate == $female->firstname)
                                                {{ $Score->score }}
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @empty
            <h2 class="text-center text-muted">
                No Categories
            </h2>
        @endforelse
    @endsection
