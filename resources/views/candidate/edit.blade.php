@extends('layouts.app')

@section('content')
    <div class="row g-2">
        <div class="col-md">
            <h1 class="text-center">Edit Candidate</h1>
            
        </div>
        <div class="col-md-auto">
            {{-- data deletion form --}}
            <form action="{{ route('candidate.destroy', $candidate->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </div>
    </div>
    <hr>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ route('candidate.update', $candidate->id) }}" method="post" class="needs-validations"
        enctype="multipart/form-data" novalidat>
        {{-- for validation --}}
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-auto">
                {{-- photo --}}
                <div class="text-center">
                    <div class="text-bg-light rounded-3 p-2">
                        <img src="{{ url('storage/images/' . $candidate->photo) }}" class="img-fill rounded-2"
                            id="outputImage" alt="candidate" width="150px" height="150px">
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label for="file" class="form-label">Photo</label>
                <input class="form-control mb-1" type="file" accept="image/*" name="photo" id="file"
                    onchange="loadFile(event)">

                <div class="row">
                    {{-- <div class="col-md-auto">
                        <label for="contestant_no" class="form-label">Contestan Number</label>
                        <input type="number" class="form-control" placeholder="09" name="contestant_no" id="contestant_no"
                            value="">
                    </div> --}}
                    <div class="col-md">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                            value="{{ $candidate->name }}" required>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-1  mt-2">
            <div class="col-12">
                <label class="form-label">Category to Join</label>
            </div>
            <div class="col-12">
                <div class="row g-2">
                    {{-- categories --}}
                    @for ($i = 0; $i < count($categories); $i++)
                        @php
                            $checked = $categories[$i]['joined'] ? 'checked' : '';
                        @endphp
                        <div class="col-auto">
                            <input type="checkbox" class="btn-check" id="btn{{ $categories[$i]['id'] }}" name="categories[]"
                                value="{{ $categories[$i]['category_id'] }}" autocomplete="off" {{ $checked }}>
                            <label class="btn btn-outline-light"
                                for="btn{{ $categories[$i]['id'] }}">{{ $categories[$i]['title'] }}</label>

                            {{-- category id joined --}}
                            {{-- @if ($checked == 'checked')
                                <input type="number" name="joined_cat[]" class=" d-none"
                                    value="{{ $categories[$i]['category_id'] }}" id="">
                            @endif --}}

                        </div>
                    @endfor

                </div>
            </div>
        </div>

        <hr>

        <div class="row mt-2">
            <div class="col text-center">
                <button class="btn btn-lg btn-danger rounded-3" type="submit">
                    Update Candidate
                </button>
            </div>
        </div>
    </form>

    <!-- image display script -->
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('outputImage');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
