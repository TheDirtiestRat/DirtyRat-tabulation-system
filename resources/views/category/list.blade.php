@extends('layouts.app')

@section('content')
    <h1 class="text-center">List of Category</h1>

    <hr>

    {{-- alert --}}
    @include('components.alert')

    {{-- candidate list cards male --}}
    <div class="row g-2 justify-content-center">
        @for ($i = 0; $i < $Categories->count(); $i++)
            <div class="col-md-6">
                {{-- card --}}
                <div class="card h-100">
                    <div class="row">
                        <div class="col">
                            <div class="card-body">
                                <a href="{{ route('category.edit', $Categories[$i]->id) }}"
                                    class="text-decoration-none text-dark">
                                    <h5 class="card-title">{{ $Categories[$i]->title }}</h5>
                                </a>

                                {{-- list of criterias --}}
                                @foreach ($Criterias as $criteria)
                                    @if ($criteria->category == $Categories[$i]->category_id)
                                        <p class="card-text m-0"><small class="text-body-secondary">{{ $criteria->name }} -
                                                {{ $criteria->points }}pt</small></p>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
