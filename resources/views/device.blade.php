@extends('layouts.main')
@section('container')
<h1>{{ $device["name"] }}</h1>
@php
    $i = 1;
@endphp

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Dateime</th>
            <th scope="col">Data</th>
        </tr>
    </thead>
    <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $d["created_at"] }}</td>
                <td>{{ $d["data"] }}</td>
            </tr>
            @php
                $i++;
            @endphp
            @endforeach

    </tbody>
</table>

<a href="/devices"> Back to Devices</a>
@endsection
