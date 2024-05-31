@extends('layouts.app')

@section('content')
    <h1 class="mb-4 display-3">List of Category</h1>

    <hr>

    {{-- candidate list cards male --}}
    <div class="row gap-2 justify-content-center">
        @for ($i = 0; $i < 8; $i++)
            <div class="col-auto p-0">
                {{-- card --}}
                <div class="card" style="width: 20rem;">
                    <div class="row g-0">
                        {{-- <div class="col-md-4">
                            <img src="{{ asset('storage/images/con_test_pic.jpeg') }}" class="img-fluid rounded-start h-100" alt="..." style="object-fit: cover;">
                        </div> --}}
                        <div class="col">
                            <div class="card-body">
                                <button class="btn btn-secondary d-block w-100 mb-2">Category ID</button>
                                <h5 class="card-title">Category Title</h5>
                                
                                {{-- <p class="card-text"><small class="text-body-secondary">Middlename</small></p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    </div>
@endsection
