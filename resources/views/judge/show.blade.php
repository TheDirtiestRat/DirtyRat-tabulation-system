@extends('layouts.app')

@section('content')
    <div class="row mb-4">
        <div class="col">
            <h1>Employee Personal Data Sheet</h1>
        </div>
        <div class="col-auto">
            {{-- <button class="btn btn-dark shadow">Print as a PDF</button> --}}
        </div>
    </div>

    <table class="table table-light align-middle">
        <thead class="text-center">
            <tr>
                <th colspan="4">Emloyee Id</th>
            </tr>
            <tr>
                <td colspan="4">Test</td>
            </tr>
            <tr>
                <th colspan="3">Name</th>
                <th class="text-start">Date Employed</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="width: 30%">Test</td>
                <td style="width: 20%">Test</td>
                <td style="width: 20%">Test</td>
                <td>Test</td>
            </tr>

            <tr>
                <th colspan="4" class="table-dark"><h3 class="text-center m-0">Personal Information</h3></th>
            </tr>
            <tr>
                <th>Maiden Name if Married</th>
                <th colspan="2">Place of Birth</th>
                <th>Religion</th>
            </tr>
            <tr>
                <td>Test</td>
                <td colspan="2">Test</td>
                <td>Test</td>
            </tr>
            <tr>
                <th colspan="2">Date of Birth</th>
                <th>Blood Type</th>
                <th>Gender</th>
            </tr>
            <tr>
                <td colspan="2">MM/DD/YYYY</td>
                <td>Test</td>
                <td>Test</td>
            </tr>
            <tr>
                <th colspan="2">Citizenship</th>
                <th colspan="2">Civil Status</th>
            </tr>
            <tr>
                <td colspan="2">Test</td>
                <td colspan="2">Test</td>
            </tr>
            <tr>
                <th colspan="4" class="table-dark">Security Number</th>
            </tr>
            <tr>
                <th>TIN no.</th>
                <th colspan="2">SSS no.</th>
                <th>PAG-IBIG no.</th>
            </tr>
            <tr>
                <td>Test</td>
                <td colspan="2">Test</td>
                <td>Test</td>
            </tr>
            <tr>
                <th class="text-center" colspan="4">Address</th>
            </tr>
            <tr>
                <td colspan="4">Test</td>
            </tr>

            <tr>
                <th colspan="4" class="table-dark text-center">Contact Information</th>
            </tr>
            <tr>
                <th>Telephone no.</th>
                <th>Cellphone no.</th>
                <th colspan="2">Email</th>
            </tr>
            <tr>
                <td>Test</td>
                <td>Test</td>
                <td colspan="2">Test</td>
            </tr>
        </tbody>
    </table>
@endsection
