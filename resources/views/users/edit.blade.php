@extends('layouts.app')

@section('content')
    <div class="row g-2">
        <div class="col-md">
            <h1 class="text-center">Edit User</h1>

        </div>
        <div class="col-md-auto">
            {{-- data deletion form --}}
            <form action="{{ route('user.destroy', $user->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger">Delete</button>
            </form>
        </div>
    </div>
    <hr>

    {{-- alert --}}
    @include('components.alert')

    <form action="{{ route('user.update', $user->id) }}" method="post" class="needs-validations" novalidat>
        {{-- for validation --}}
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md">
                <div class="row">

                    <div class="col-md-6">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" id="name"
                            value="{{ $user->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email"
                            value="{{ $user->email }}" required>
                    </div>

                    {{-- <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password"
                            value="{{ $user->password }}" required>
                    </div> --}}
                    <div class="col-md">
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
                    Edit User
                </button>
            </div>
        </div>
    </form>

    {{-- select script --}}
    <script>
        document.getElementById('type').value = '{{ $user->type }}';
    </script>
@endsection
