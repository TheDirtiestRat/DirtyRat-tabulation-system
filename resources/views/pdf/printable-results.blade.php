<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Scores</title>

    @vite(['resources/js/app.js'])
</head>

<body class="bg-dark">

    <!-- Page content-->
    <div class="rounded-4 m-2 p-3 shadow text-bg-light">
        <div class="row mb-4">
            <div class="col text-center">
                <h1>Scores</h1>
                <h3>@include('components.title')</h3>
            </div>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-light table-striped align-middle">
                <thead>
                    <tr>
                        <th>Judges Total : <strong>{{ $judge_count }}</strong></th>
                        <th colspan="{{ count($categories) }}" class="text-center">Categories</th>
                        <th colspan="3" class="text-center">Total</th>
                    </tr>
                    {{-- <tr>
                        <th>Place</th>
                        <th>Candidates</th>
                        @foreach ($categories as $category)
                            <th class="text-center">{{ $category->title }}</th>
                        @endforeach
                        <th class="text-center">Raw</th>
                        <th class="text-center">%</th>
                    </tr> --}}
                </thead>
            </table>
            <table class="table table-light table-striped align-middle" id="scores_table">
                <thead>
                    <tr>
                        <th>Place</th>
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
                            <td>

                            </td>
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
                                        00
                                    </td>
                                @endif
                            @endforeach
                            {{-- calculate the percentage total --}}
                            @php
                                $total_percent = ($sum_score / $overall_point_total) * 100;
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
                <tfoot>
                    <tr>
                        <th colspan="{{ count($categories) + 4 }}">@include('components.copyright')</th>
                    </tr>
                </tfoot>
            </table>


            <table class="table">
                <tbody>
                    <tr>
                        <th colspan="{{ $judge_count }}" class=" text-center">Signatures :</th>
                    </tr>
                    {{-- judges signatures --}}
                    <tr>
                        @for ($i = 0; $i < $judge_count; $i++)
                            <td>
                                <hr class="m-3 text-danger">
                                <p class=" text-center">{{ $judges_name[$i]->name }}</p>
                                {{-- <p class=" text-center">Judge {{ $i }}</p> --}}
                            </td>
                        @endfor
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- start print --}}
    <script>
        window.print()
    </script>
    {{-- sorting table --}}
    <script>
        // call on load
        sortTable({{ count($categories) + 2 }});

        function sortTable(columnIndex) {
            let table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("table_body");
            switching = true;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 0; i < rows.length - 1; i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[columnIndex];
                    y = rows[i + 1].getElementsByTagName("td")[columnIndex];

                    // if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    //     shouldSwitch = true;
                    //     break;
                    // }

                    // console.log(x.innerHTML + "--" + y.innerHTML);
                    if (Number(x.innerHTML) < Number(y.innerHTML)) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }

            // give placement

        }

        give_placement()

        function give_placement() {
            let table = document.getElementById("table_body");
            console.log(table.rows);
            let f_rows = table.rows
            for (i = 0; i < f_rows.length; i++) {
                shouldSwitch = false;
                let e = f_rows[i].getElementsByTagName("td")[0];
                switch (i) {
                    case 0:
                        e.innerHTML = i + 1 + "st";
                        break;
                    case 1:
                        e.innerHTML = i + 1 + "nd";
                        break;
                    case 2:
                        e.innerHTML = i + 1 + "rd";
                        break;
                    case 3:
                        e.innerHTML = i + 1 + "th";
                        break;
                    default:
                        e.innerHTML = i + 1;
                }

                console.log(e);
            }
        }
    </script>
</body>

</html>
