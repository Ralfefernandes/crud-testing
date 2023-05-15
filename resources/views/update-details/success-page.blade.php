@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Address Updated Successfully</h1>
                <ul>
                    @foreach ($adresColumns as $column)
                        @if ($column !== 'kvk')
                            <li>{{ ucfirst(str_replace('_', ' ', $column)) }}: {{ $adres->$column }}</li>
                        @endif
                    @endforeach
                </ul>
                <a href="{{ route('download-updated-addresses') }}" class="btn btn-primary">Download Updated Addresses</a>

            </div>
        </div>
    </div>
@endsection
