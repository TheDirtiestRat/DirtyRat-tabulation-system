@extends('pdf.layout')

@section('content')
    <div class="">
        <h2>Category : {{ $category->title }} ID: {{ $category->category_id }}</h2>
    </div>

    {{-- criteria list --}}
    @forelse ($Criterias as $Criteria)
        @if ($Criteria->category == $category->category_id)
            <div class="table-responsive">
                <table class="table align-middle table-sm">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Candidates</th>
                            {{-- judge list --}}
                            @foreach ($Judges as $Judge)
                                <th class="text-center">{{ $Judge->firstname }}</th>
                            @endforeach
                            <th class="text-end">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="{{ $Judges->count() + 3 }}" class="table-dark">
                                <h3 class="text-center m-0">{{ $Criteria->name }}</h3>
                            </th>
                        </tr>
                        {{-- candidates list male --}}
                        <tr>
                            <th colspan="{{ $Judges->count() + 3 }}" class="text-center">
                                Male
                            </th>
                        </tr>
                        @for ($i = 0, $no = 1; $i < $TotalsMale->count(); $i++)
                            {{-- rank colors --}}
                            @php
                                $rank_color = '';
                                if ($no == 1) {
                                    $rank_color = 'table-primary';
                                }
                                // elseif ($no == 2) {
                                //     $rank_color = 'table-light';
                                // } elseif ($no == 3) {
                                //     $rank_color = 'table-secondary';
                                // }
                            @endphp
                            <tr>
                                @if ($TotalsMale[$i]->criteria == $Criteria->name)
                                    <td>{{ $no }} - {{ $TotalsMale[$i]->contestant_no }}</td>
                                    <td>{{ $TotalsMale[$i]->firstname }} {{ $TotalsMale[$i]->lastname }}</td>
                                    @foreach ($Judges as $Judge)
                                        <td class="text-center">
                                            {{-- get scores by judges --}}
                                            @foreach ($Scores as $Score)
                                                @if (
                                                    $Score->judge == $Judge->firstname &&
                                                        $Score->category == $category->category_id &&
                                                        $Score->criteria == $Criteria->name &&
                                                        $Score->candidate == $TotalsMale[$i]->firstname)
                                                    {{ $Score->score }}
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                    <td class="text-end">
                                        {{ round($TotalsMale[$i]->total / $Judges->count(), 2) }}
                                    </td>
                                    {{-- incrument --}}
                                    @php
                                        $no++;
                                    @endphp
                                @endif
                            </tr>
                        @endfor

                        {{-- candidates list female --}}
                        <tr>
                            <th colspan="{{ $Judges->count() + 3 }}" class="text-center">
                                Female
                            </th>
                        </tr>
                        @for ($i = 0, $no = 1; $i < $TotalsFemale->count(); $i++)
                            {{-- rank colors --}}
                            @php
                                $rank_color = '';
                                if ($no == 1) {
                                    $rank_color = 'table-primary';
                                }
                                // elseif ($no == 2) {
                                //     $rank_color = 'table-light';
                                // } elseif ($no == 3) {
                                //     $rank_color = 'table-secondary';
                                // }
                            @endphp
                            <tr>
                                @if ($TotalsFemale[$i]->criteria == $Criteria->name)
                                    <td>{{ $no }} - {{ $TotalsFemale[$i]->contestant_no }}</td>
                                    <td>{{ $TotalsFemale[$i]->firstname }} {{ $TotalsFemale[$i]->lastname }}</td>
                                    @foreach ($Judges as $Judge)
                                        <td class="text-center">
                                            {{-- get scores by judges --}}
                                            @foreach ($Scores as $Score)
                                                @if (
                                                    $Score->judge == $Judge->firstname &&
                                                        $Score->category == $category->category_id &&
                                                        $Score->criteria == $Criteria->name &&
                                                        $Score->candidate == $TotalsFemale[$i]->firstname)
                                                    {{ $Score->score }}
                                                @endif
                                            @endforeach
                                        </td>
                                    @endforeach
                                    <td class="text-end">
                                        {{ round($TotalsFemale[$i]->total / $Judges->count(), 2) }}
                                    </td>
                                    {{-- incrument --}}
                                    @php
                                        $no++;
                                    @endphp
                                @endif
                            </tr>
                        @endfor
                        <tr>
                            <th colspan="{{ $Judges->count() + 3 }}" class="text-center">
                                
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endif
    @empty
        <h2 class="text-center text-light">
            No Criterias
        </h2>
    @endforelse

    <hr>

    {{-- judges signaturs --}}
    <table class="no-borders" style="margin-top: 26px">
        <tr>
            <td colspan="{{ $Judges->count() }}">
                <h2>Signatures:</h2>
            </td>
        </tr>
        <tr>
            <td>
                <br>
                <br>
            </td>
        </tr>
        <tr>
            {{-- judge list --}}
            @foreach ($Judges as $Judge)
                <td>
                    <hr>
                    <p>
                        {{ $Judge->firstname }} {{ $Judge->middlename }} {{ $Judge->lastname }}
                    </p>
                </td>
            @endforeach
        </tr>
    </table>
@endsection
