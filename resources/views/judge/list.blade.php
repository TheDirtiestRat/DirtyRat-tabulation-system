@extends('layouts.app')

@section('content')
    <h1 class="mb-4 display-3">List of Judges</h1>

    <hr>

    {{-- alert --}}
    @include('components.alert')

    {{-- candidate list cards male --}}
    <div class="row gap-2 justify-content-center">
        @for ($i = 0; $i < $Judges->count(); $i++)
            <div class="col-auto p-0">
                {{-- card --}}
                <div class="card" style="width: 20rem;">
                    <div class="row g-0">
                        <div class="col">
                            <div class="card-body">
                                <a href="{{ route('judge.edit', $Judges[$i]->id) }}" class="text-decoration-none">
                                    <button class="btn btn-secondary d-block w-100 mb-2">ID {{ $Judges[$i]->judge_id }}</button>
                                </a>
                                <h5 class="card-title">{{ $Judges[$i]->firstname }} {{ $Judges[$i]->middlename }} {{ $Judges[$i]->lastname }}</h5>
                                
                                <p class="card-text"><small class="text-body-secondary">{{ $Judges[$i]->created_at }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
