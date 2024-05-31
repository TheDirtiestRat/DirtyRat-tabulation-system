@extends('layouts.app')

@section('head-links')
    <link href="{{ asset('storage/assets/simple-datatables/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-auto">
            <h1>Results</h1>
            Judges Total : <strong>{{ $judge_count }}</strong>
        </div>
        <div class="col-auto">
            <a href="{{ route('DatabaseBackup') }}" class="btn btn-outline-danger" target="_blank">
                Backup Database
            </a>
        </div>
        <div class="col">
            <form action="{{ url('printResults') }}" method="get" target="_blank">
                {{-- for validation --}}
                @csrf

                <div class="row g-1">
                    @forelse ($categories_list as $category)
                        <div class="col-auto">
                            <input type="checkbox" class="btn-check" id="prnt{{ $category->id }}" name="categories[]"
                                value="{{ $category->category_id }}" autocomplete="off">
                            <label class="btn btn-outline-light"
                                for="prnt{{ $category->id }}">{{ $category->title }}</label>
                        </div>
                    @empty
                        <div class="col-md-6">
                            <h2 class="text-muted">
                                No category yet.
                            </h2>
                        </div>
                    @endforelse
                    <div class="col-auto">
                        <button type="submit" class="btn btn-danger">Print</button>
                    </div>
                </div>
            </form>
            {{-- <a href="{{ url('printResults') }}?categories={{ $category_keys }}" class="btn btn-light" target="_blank">Print</a> --}}
        </div>
    </div>

    <hr>

    {{-- sorting form --}}
    <form action="{{ url('showResults') }}" method="get">
        {{-- for validation --}}
        @csrf

        <div class="row g-1">
            <div class="col-12">
                <label class="form-label">Sort Candidate by Category</label>
            </div>
            @forelse ($categories_list as $category)
                <div class="col-auto">
                    <input type="checkbox" class="btn-check" id="btn{{ $category->id }}" name="categories[]"
                        value="{{ $category->category_id }}" autocomplete="off">
                    <label class="btn btn-outline-light" for="btn{{ $category->id }}">{{ $category->title }}</label>
                </div>
            @empty
                <div class="col-md-6">
                    <h2 class="text-muted">
                        No category yet.
                    </h2>
                </div>
            @endforelse
            <div class="col-auto">
                <button type="submit" class="btn btn-danger">Sort</button>
            </div>
        </div>
    </form>


    <div class="table-responsive p-3">
        <table class="table table-dark table-striped datatable align-middle" id="scores_table">
            <thead>
                {{-- <tr>
                    <th></th>
                    <th colspan="{{ count($categories) }}" class="text-center">Categories</th>
                    <th colspan="2" class="text-center">Total</th>
                </tr> --}}
                <tr>
                    <th>Candidates</th>
                    {{-- category list --}}
                    @foreach ($categories as $category)
                        <th class="text-center">{{ $category->title }}</th>
                    @endforeach
                    {{-- total --}}
                    <th class="text-center">Raw</th>
                    <th class="text-center">%</th>
                </tr>
            </thead>
            <tbody id="table_body">
                {{-- list of candidates --}}
                @forelse ($candidates as $candidate)
                    <tr>
                        {{-- scores of all categories --}}
                        @php
                            $sum_score = 0;
                        @endphp
                        <td>
                            {{ $candidate->name }}
                        </td>
                        {{-- scores by category --}}
                        @foreach ($categories as $category)
                            @php
                                $score = [];

                                foreach ($scores as $key => $value) {
                                    if (
                                        $value->candidate == $candidate->candidate_no &&
                                        $value->category == $category->category_id
                                    ) {
                                        $score = $value;

                                        // adds the scores to the sum
                                        $sum_score += $value->score;
                                    }
                                }

                            @endphp
                            @if ($score != null)
                                <td class="text-center">
                                    {{ $score->score }}
                                </td>
                            @else
                                <td>

                                </td>
                            @endif
                        @endforeach
                        {{-- calculate the percentage total --}}
                        @php
                            $total_percent = 0;
                            if ($sum_score != 0) {
                                $total_percent = ($sum_score / $overall_point_total) * 100;
                            }
                        @endphp
                        <td class="text-center">
                            {{ $sum_score }}
                        </td>
                        <td class="text-center">
                            {{ round($total_percent, 2) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td></td>
                        <td>Select Categories to show scores</td>
                        <td></td>
                        {{-- <td colspan="{{ $categories->count() + 3 }}">

                        </td> --}}
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    {{-- print the list scores --}}
    <script>
        function print_scores() {
            var table_content = document.getElementById('scores_table').innerHTML;

            console.log(table_content);

            // var printable = window.open('', '', 'height=500, width=500');
            // printable.document.write('<html><head><style>body {display: flex; justify-content: center;} button {width: 100%} table, td, th {border: 1px solid black; border-collapse: separate;}</style>');
            // printable.document.write('</head><body><table>');
            // printable.document.write(table_content);
            // printable.document.write('</table></div></body></html>');
            // contents here
            // printable.print();
        }
    </script>
@endsection

@section('body-links')
    <script src="{{ asset('storage/assets/simple-datatables/simple-datatables.js') }}"></script>

    <script>
        /**
         * Easy selector helper function
         */
        const select = (el, all = false) => {
            el = el.trim()
            if (all) {
                return [...document.querySelectorAll(el)]
            } else {
                return document.querySelector(el)
            }
        }

        /**
         * Initiate Datatables
         */
        const datatables = select('.datatable', true)
        datatables.forEach(datatable => {
            new simpleDatatables.DataTable(datatable, {
                perPageSelect: [5, 10, 15, ["All", -1]],
                columns: [{
                        select: 2,
                        sortSequence: ["desc", "asc"]
                    },
                    {
                        select: 3,
                        sortSequence: ["desc"]
                    },
                    {
                        select: 4,
                        cellClass: "green",
                        headerClass: "red"
                    }
                ]
            });
        })
    </script>
@endsection
