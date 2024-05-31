@extends('layouts.app')

@section('content')
    <h1 class="text-center">Add new Candidate</h1>
    <hr>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ route('candidate.store') }}" method="post" class="needs-validations" enctype="multipart/form-data"
        novalidat>
        {{-- for validation --}}
        @csrf

        <div class="row">
            <div class="col-md-auto">
                {{-- photo --}}
                <div class="text-center">
                    <div class="text-bg-light rounded-3 p-2">
                        <img src="{{ url('storage/images/aclc.png') }}" class="img-fill rounded-2" id="outputImage"
                            alt="candidate" width="150px" height="150px">
                    </div>
                </div>
            </div>
            <div class="col-md">
                <label for="file" class="form-label">Photo</label>
                <input class="form-control mb-1" type="file" accept="image/*" name="photo" id="file"
                    onchange="loadFile(event)">

                <div class="row">
                    <div class="col-md-auto">
                        <label for="contestant_no" class="form-label">Contestan Number</label>
                        <input type="number" class="form-control" placeholder="09" name="contestant_no" id="contestant_no"
                            value="">
                    </div>
                    <div class="col-md">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                            value="" required>
                    </div>
                    {{-- <div class="col-md">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" name="gender" id="gender" required>
                            <option selected disabled value>Select Gender</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </div> --}}
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-md">
                <label for="surname" class="form-label">Sur Name</label>
                <input type="text" class="form-control" placeholder="Sur Name" name="surname" id="surname"
                    value="" required>
            </div>
            <div class="col-md">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname"
                    value="" required>
            </div>
            <div class="col-md">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" class="form-control" placeholder="Middle Name" name="middlename" id="middlename"
                    value="">
            </div>
        </div> --}}

        <div class="row g-1  mt-2">
            {{-- <div class="col-md-auto">
                <label for="contestant_no" class="form-label">Contestan Number</label>
                <input type="number" class="form-control" placeholder="09" name="contestant_no" id="contestant_no"
                    value="" required>
            </div>
            <div class="col-md">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" id="gender" required>
                    <option selected disabled value>Select Gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                </select>
            </div> --}}
            <div class="col-12">
                <label class="form-label">Category to Join</label>
            </div>
            <div class="col-12">
                <div class="row g-2">
                    @forelse ($categories as $category)
                    <div class="col-auto">
                        <input type="checkbox" class="btn-check" id="btn{{ $category->id }}" name="categories[]" value="{{ $category->category_id }}" autocomplete="off">
                        <label class="btn btn-outline-light" for="btn{{ $category->id }}">{{ $category->title }}</label>
                    </div>
                    @empty
                        <div class="col-md-6">
                            <h2 class="text-muted">
                                No category yet.
                            </h2>
                        </div>
                    @endforelse
                    
                </div>
            </div>
        </div>

        <hr>

        <div class="row mt-2">
            <div class="col text-center">
                <button class="btn btn-lg btn-danger rounded-3" type="submit">
                    Add Candidate
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
