@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <h1>Total Scores</h1>
        </div>
        <div class="col-auto">
            <a href="{{ route('scoresResultsPDF') }}" class="text-decoration-none" target="_blank">
                <button class="btn btn-light shadow">Print</button>
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-dark align-middle table-sm">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Candidate</th>
                    {{-- category list --}}
                    @foreach ($Categories as $Category)
                        <th class="text-center">{{ $Category->title }}</th>
                    @endforeach
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                {{-- candidates list male --}}
                <tr>
                    <th colspan="{{ $Categories->count() + 3 }}" class="text-center">
                        <h3>Male</h3>
                    </th>
                </tr>
                @for ($i = 0, $no = 1; $i < $TotalsMale->count(); $i++)
                    {{-- rank colors --}}
                    @php
                        $rank_color = '';
                        if ($no == 1) {
                            $rank_color = 'table-primary';
                        }elseif ($no == 2) {
                            $rank_color = 'table-light';
                        } elseif ($no == 3) {
                            $rank_color = 'table-secondary';
                        }
                    @endphp
                    <tr class="{{ $rank_color }}">
                        <td>{{ $TotalsMale[$i]->contestant_no }}</td>
                        <td>{{ $TotalsMale[$i]->firstname }} {{ $TotalsMale[$i]->lastname }}</td>
                        {{-- score by category  --}}
                        @foreach ($Categories as $category)
                            <td class="text-center">
                                {{-- get scores by category --}}
                                @foreach ($Scores as $Score)
                                    @if ($Score->category == $category->category_id && $Score->candidate == $TotalsMale[$i]->firstname)
                                        {{ $Score->score }}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                        <td class="text-end">
                            {{ round($TotalsMale[$i]->total / $Categories->count(), 2) }}
                        </td>
                        {{-- incrument --}}
                        @php
                            $no++;
                        @endphp
                    </tr>
                @endfor

                {{-- candidates list female --}}
                <tr>
                    <th colspan="{{ $Categories->count() + 3 }}" class="text-center">
                        <h3>Female</h3>
                    </th>
                </tr>
                @for ($i = 0, $no = 1; $i < $TotalsFemale->count(); $i++)
                    {{-- rank colors --}}
                    @php
                        $rank_color = '';
                        if ($no == 1) {
                            $rank_color = 'table-primary';
                        }elseif ($no == 2) {
                            $rank_color = 'table-light';
                        } elseif ($no == 3) {
                            $rank_color = 'table-secondary';
                        }
                    @endphp
                    <tr class="{{ $rank_color }}">
                        <td>{{ $TotalsFemale[$i]->contestant_no }}</td>
                        <td>{{ $TotalsFemale[$i]->firstname }} {{ $TotalsFemale[$i]->lastname }}</td>
                        {{-- score by category  --}}
                        @foreach ($Categories as $category)
                            <td class="text-center">
                                {{-- get scores by category --}}
                                @foreach ($Scores as $Score)
                                    @if ($Score->category == $category->category_id && $Score->candidate == $TotalsFemale[$i]->firstname)
                                        {{ $Score->score }}
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                        <td class="text-end">
                            {{ round($TotalsFemale[$i]->total / $Categories->count(), 2) }}
                        </td>
                        {{-- incrument --}}
                        @php
                            $no++;
                        @endphp
                    </tr>
                @endfor
            </tbody>
        </table>
    </div>
@endsection
