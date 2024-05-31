@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <h1>Category Details</h1>
        </div>
        <div class="col-auto">
            {{-- <button class="btn btn-dark shadow">Print as a PDF</button> --}}
        </div>
    </div>

    <table class="table table-light align-middle">
        <tbody>
            <tr>
                <th colspan="4" class="table-dark"><h3 class="text-center m-0">Category Name</h3></th>
            </tr>
            <tr>
                <th>Criteria</th>
                <th class="text-end">Points</th>
            </tr>
            <tr>
                <td>Test</td>
                <td class="text-end">Test</td>
            </tr>
        </tbody>
    </table>
@endsection
