@extends('layouts.app')

@section('content')
    <h1 class="text-center">Add new Criteria</h1>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ route('criteria.store') }}" method="post" class="needs-validations" enctype="multipart/form-data" novalidat>
        {{-- for validation --}}
        @csrf

        <div class="row g-2 m-2">
            <div class="col-12">
                <h3>Criteria</h3>
            </div>
            <div class="col">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Criteria Name" name="name" id="name"
                    value="" required>
            </div>
            <div class="col">
                <label for="name" class="form-label">Points</label>
                <input type="number" class="form-control" placeholder="50 pt" name="points" id="points" value=""
                    required>
            </div>
        </div>

        <div class="row g-2 m-2">
            <div class="col-12">
                <h3>Category</h3>
            </div>
            <div class="col-md col-12">
                <label for="category" class="form-label">Category Select</label>
                <select class="form-select" name="category" id="category" required>
                    <option selected disabled value>Select Category</option>
                    @foreach ($Categories as $Category)
                        <option value="{{ $Category->category_id }}">{{ $Category->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr class="m-3">

        <div class="row g-2">
            <div class="col">
                <button class="btn btn-lg btn-danger rounded-3 float-end" type="submit">
                    Add Criteria
                </button>
            </div>
        </div>
    </form>
@endsection
