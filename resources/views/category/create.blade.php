@extends('layouts.app')

@section('content')
    <h1 class="text-center">Add new Category</h1>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ route('category.store') }}" method="post" class="needs-validations" enctype="multipart/form-data"
        novalidat>
        {{-- for validation --}}
        @csrf

        <div class="row">
            <div class="col-12">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" placeholder="Category Title" name="title" id="title"
                    value="" required>
            </div>

            <div class="col-12 text-center">
                <button class="btn btn-danger rounded-3 m-2" onclick="add_new_criteria()" type="button">
                    Add Criteria
                </button>
            </div>

            {{-- criteria list --}}
            <div class="col-12" id="criteria_list">
                
            </div>

        </div>

        <hr>

        <div class="row mt-2">
            <div class="col text-center">
                <button class="btn btn-lg btn-danger rounded-3" type="submit">
                    Add Category
                </button>
            </div>
        </div>
    </form>

    <script>
        const list = document.getElementById('criteria_list');
        var index = 0;
        function add_new_criteria() {
            index++;

            // create the new element
            const cri = document.createElement("div");
            cri.classList.add('row');
            cri.classList.add('mb-1');
            cri.id = "criteria" + index;
            cri.innerHTML = `<div class="col-md">
                    <label for="criteria_name`+index+`" class="form-label">Criteria name</label>
                    <input type="text" class="form-control" placeholder="Criteria Name" name="criteria_name[]"
                        id="criteria_name`+index+`" value="" required>
                </div>
                <div class="col-md-auto">
                    <label for="points`+index+`" class="form-label">Points</label>
                    <input type="number" class="form-control" placeholder="50 pt" name="points[]" id="points`+index+`"
                        min="0" step="0.1" value="" required>
                </div>
                <div class="col-md-auto">
                    <label for="btn`+index+`" class="form-label">Remove</label>
                    <button class="btn btn-danger w-100" id="btn`+index+`" onclick="remove_criteria('criteria`+index+`')" type="button">
                        <i class="bi bi-trash3"></i>
                    </button>
                </div>`;

            // add the new element
            list.appendChild(cri);

            // list.innerHTML = list.innerHTML +
            // `
            // <div class="row mb-1" id="criteria`+index+`">
            //     <div class="col-md">
            //         <label for="criteria_name`+index+`" class="form-label">Criteria name</label>
            //         <input type="text" class="form-control" placeholder="Criteria Name" name="criteria_name[]"
            //             id="criteria_name`+index+`" value="" required>
            //     </div>
            //     <div class="col-md-auto">
            //         <label for="points`+index+`" class="form-label">Points</label>
            //         <input type="number" class="form-control" placeholder="50 pt" name="points[]" id="points`+index+`"
            //             min="0" step="0.1" value="" required>
            //     </div>
            //     <div class="col-md-auto">
            //         <label for="btn`+index+`" class="form-label">Remove</label>
            //         <button class="btn btn-danger w-100" id="btn`+index+`" onclick="remove_criteria('criteria`+index+`')" type="button">
            //             <i class="bi bi-trash3"></i>
            //         </button>
            //     </div>
            // </div>
            // `;
        }

        function remove_criteria(id) {
            const criteria = document.getElementById(id);
            // criteria.remove();

            // remove the element
            list.removeChild(criteria);
        }
    </script>
@endsection
