@extends('layouts.app')

@section('content')
    <h1 class="text-center">Add new User</h1>
    <hr>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ route('user.store') }}" method="post" class="needs-validations" novalidat>
        {{-- for validation --}}
        @csrf

        <div class="row">
            <div class="col-md">
                <div class="row g-2">

                    <div class="col-md-12">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" id="name"
                            value="" required>
                    </div>
                    {{-- <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email"
                            value="" required>
                    </div> --}}

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password"
                            value="" required>
                    </div>
                    <div class="col-md-6">
                        <label for="type" class="form-label">User Type</label>
                        <select class="form-select" name="type" id="type" required>
                            <option selected disabled value>Select Type</option>
                            <option value="JUDGE">Judge User</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row mt-2">
            <div class="col text-center">
                <button class="btn btn-lg btn-danger rounded-3" type="submit">
                    Add User
                </button>
            </div>
        </div>
    </form>
@endsection
