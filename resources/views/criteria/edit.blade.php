@extends('layouts.app')

@section('content')
    <h1 class="text-center">Category Edit details</h1>

    <form action="" method="post" class="needs-validations" enctype="multipart/form-data" novalidat>
        {{-- for validation --}}
        @csrf
        @method('PUT')

        <div class="row g-2 m-2">
            <div class="col-12">
                <h3>Category</h3>
            </div>
            <div class="col">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" placeholder="Title Category" name="title" id="title"
                    value="" required>
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
                    <h5 class="modal-title">Remove Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you wanna remove <strong>Test</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    {{-- data deletion form --}}
                    <form action="{{ route('candidate.destroy', 0) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
