@extends('layouts.app')

@section('content')
    <h1 class="text-center">Add new Judge</h1>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ route('judge.store') }}" method="post" class="needs-validations" enctype="multipart/form-data" novalidat>
        {{-- for validation --}}
        @csrf

        <div class="row g-2 m-2">
            <div class="col-12">
                <h3>Judge Name</h3>
            </div>
            <div class="col">
                <label for="surname" class="form-label">Sur Name</label>
                <input type="text" class="form-control" placeholder="Sur Name" name="surname" id="surname"
                    value="" required>
            </div>
            <div class="col-md col-12">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname"
                    value="" required>
            </div>
            <div class="col">
                <label for="middlename" class="form-label">Middle Name</label>
                <input type="text" class="form-control" placeholder="Middle Name" name="middlename" id="middlename"
                    value="">
            </div>
        </div>

        <hr class="m-3">

        <div class="row g-2">
            <div class="col">
                <button class="btn btn-lg btn-danger rounded-3 float-end" type="submit">
                    Add Judge
                </button>
            </div>
        </div>
    </form>
@endsection
