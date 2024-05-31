@extends('layouts.app')

@section('head-links')
    
@endsection

@section('content')
    <h1 class="text-center">Home</h1>

    <hr>

    <div class="container-fluid p-2 d-flex justify-content-center align-items-center">
        <div class="flex-column gap-1">
            <h1 class="display-1 text-center">
                Welcome Judge {{ Auth::user()->name }}!
            </h1>
            <p>
                You can now score the contestant by selecting the
                category list in the <strong>"Score Contestant"</strong> button found
                in the left side of the page.
            </p>
        </div>
    </div>
@endsection
