<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Judge Scores</title>

    @vite(['resources/js/app.js'])
</head>

<body class="bg-dark">

    <!-- Page content-->
    <div class="rounded-4 m-2 p-3 shadow text-bg-light">
        <div class="row mb-4">
            <div class="col">
                <h1>Judge : {{ $judge->name }}</h1>
                {{-- <h1>Judge : {{ $judge->firstname }} {{ $judge->middlename }}. {{ $judge->lastname }}</h1> --}}
                {{-- <h4>ID: {{ $judge->judge_id }}</h4> --}}
            </div>
        </div>

        {{-- category list --}}
        @forelse ($categories as $category)
            <table class="table table-light table-striped align-middle">
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
                                        {{-- @if ($cri_in <= $cri_num && $cri_num != 1)
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
        @empty
            <h2 class="text-center text-muted">
                No Categories
            </h2>
        @endforelse
    </div>

    {{-- start print --}}
    <script>
        window.print()
    </script>
</body>

</html>
