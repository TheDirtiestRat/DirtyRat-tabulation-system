@extends('layouts.app')

@section('content')
    <h1 class="text-center">Category Edit details</h1>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ route('category.update', $category['id']) }}" method="post" class="needs-validations"
        enctype="multipart/form-data" novalidat>
        {{-- for validation --}}
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" placeholder="Title Category" name="title" id="title"
                    value="{{ $category['title'] }}" required>
            </div>
        </div>

        {{-- criteria list --}}
        @forelse ($criterias as $criteria)
            <div class="row mb-1 mt-1" id="criteria{{ $criteria->id }}">
                <div class="col d-none">
                    <input type="number" name="cri_id[]" value="{{ $criteria->id }}" id="">
                </div>
                <div class="col-md">
                    <label for="criteria_name{{ $criteria->id }}" class="form-label">Criteria name</label>
                    <input type="text" class="form-control" placeholder="Criteria Name" name="criteria_name[]"
                        id="criteria_name{{ $criteria->id }}" value="{{ $criteria->name }}" required>
                </div>
                <div class="col-md-auto">
                    <label for="points{{ $criteria->id }}" class="form-label">Points</label>
                    <input type="number" class="form-control" placeholder="50 pt" name="points[]"
                        id="points{{ $criteria->id }}" min="0" step="0.1" value="{{ $criteria->points }}"
                        required>
                </div>
                <div class="col-md-auto">
                    <a href="{{ route('remove_criteria', $criteria->id) }}" class=" text-decoration-none text-light">
                        <label for="btn{{ $criteria->id }}" class="form-label">Remove</label>
                        <button class="btn btn-danger w-100" id="btn{{ $criteria->id }}" type="button">
                            <i class="bi bi-trash3"></i>
                        </button>
                    </a>
                </div>
            </div>
        @empty
            <h1 class="text-muted text-center">
                No Criterias
            </h1>
        @endforelse

        <div class="row">
            <div class="col-12 text-center">
                <button class="btn btn-danger rounded-3 m-2" onclick="add_new_criteria()" type="button">
                    Add Criteria
                </button>
            </div>
        </div>

        {{-- criteria list --}}
        <div class="" id="criteria_list">

        </div>

        <hr>

        <div class="row">
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
                    <p>Do you wanna remove <strong>{{ $category['title'] }}</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    {{-- data deletion form --}}
                    <form action="{{ route('category.destroy', $category['id']) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const list = document.getElementById('criteria_list');
        var index = 0;

        function add_new_criteria() {
            index++;
            list.innerHTML = list.innerHTML +
                `
            <div class="row mb-1" id="criteria` + index + `">
                <div class="col d-none">
                    <input type="number" name="cri_id[]" value="" id="">
                </div>
                <div class="col-md">
                    <label for="criteria_name` + index + `" class="form-label">Criteria name</label>
                    <input type="text" class="form-control" placeholder="Criteria Name" name="criteria_name[]"
                        id="criteria_name` + index + `" value="" required>
                </div>
                <div class="col-md-auto">
                    <label for="points` + index + `" class="form-label">Points</label>
                    <input type="number" class="form-control" placeholder="50 pt" name="points[]" id="points` + index + `"
                        min="0" step="0.1" value="" required>
                </div>
                <div class="col-md-auto">
                    <label for="btn` + index + `" class="form-label">Remove</label>
                    <button class="btn btn-danger w-100" id="btn` + index + `" onclick="remove_criteria('criteria` +
                index + `')" type="button">
                        <i class="bi bi-trash3"></i>
                    </button>
                </div>
            </div>
            `;
        }

        function remove_criteria(id) {
            const criteria = document.getElementById(id);
            criteria.remove();
        }
    </script>

    {{-- delete criteria in the database --}}
    <script>
        function del_cri(id) {
            document.getElementById(id).submit();
        }
    </script>
@endsection
