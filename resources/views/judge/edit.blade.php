@extends('layouts.app')

@section('content')
    <h1 class="text-center">Judge Edit details</h1>

    <form action="{{ route('judge.update', $Judge['id']) }}" method="post" class="needs-validations" enctype="multipart/form-data" novalidat>
        {{-- for validation --}}
        @csrf
        @method('PUT')

        <div class="row g-2 m-2">
            <div class="col-12">
                <h3>Judge Name : ID {{ $Judge['judge_id'] }}</h3>
            </div>
            <div class="col">
                <label for="surname" class="form-label">Sur Name</label>
                <input type="text" class="form-control" placeholder="Sur Name" name="surname" id="surname"
                    value="{{ $Judge['lastname'] }}" required>
            </div>
            <div class="col-md col-12">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname"
                    value="{{ $Judge['firstname'] }}" required>
            </div>
            <div class="col">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" class="form-control" placeholder="Middle Name" name="middlename" id="middlename"
                    value="{{ $Judge['middlename'] }}">
            </div>
        </div>

        <hr class="m-3">

        <div class="row g-2">
            <div class="col">
                <button class="btn btn-lg btn-danger rounded-3 float-start" type="button" data-bs-toggle="modal"
                    data-bs-target="#Modal">
                    Delete
                </button>
            </div>
            <div class="col">
                <button class="btn btn-lg btn-light rounded-3 float-end" type="submit">
                    Update
                </button>
            </div>
        </div>
    </form>

    {{-- delete modal --}}
    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title">Remove Judge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you wanna remove <strong>{{ $Judge['firstname'] }} {{ $Judge['lastname'] }}</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    {{-- data deletion form --}}
                    <form action="{{ route('judge.destroy', $Judge['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
