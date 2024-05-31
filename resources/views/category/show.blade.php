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
                <th colspan="4" class="table-dark">
                    <h3 class="text-center m-0">{{ $Category['title'] }} ID: {{ $Category['category_id'] }}</h3>
                </th>
            </tr>
            <tr>
                <th>Criteria</th>
                <th class="text-end">Points</th>
                <th class="text-end" style="width: 15%">Action</th>
            </tr>

            {{-- criteria list --}}
            @forelse ($Criterias as $criteria)
                <tr>
                    <td>{{ $criteria['name'] }}</td>
                    <td class="text-end">{{ $criteria['points'] }}</td>
                    <td class="text-end" style="width: 15%">
                        {{-- data deletion form --}}
                        <form action="{{ route('criteria.destroy', $criteria['id']) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No Criterias Added yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <hr class="m-3">

    <div class="row g-2">
        <div class="col">
            <a href="{{ route('category.edit', $Category['id']) }}" class="text-decoration-none">
                <button class="btn btn-lg btn-secondary rounded-3 float-end" type="button">
                    Edit
                </button>
            </a>
        </div>
    </div>
@endsection
