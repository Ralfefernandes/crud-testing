@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Address Updated Successfully</h1>
                <p>Here are the updated details:</p>
                <ul>
                    <li>Beschrijving: {{ $adres->beschrijving }}</li>
                    <li>Straatnaam: {{ $adres->straatnaam }}</li>
                    <li>Huisnummer: {{ $adres->huisnummer }}</li>
                    <li>Postcode: {{ $adres->postcode }}</li>
                    <li>Plaatsnaam: {{ $adres->plaatsnaam }}</li>
                    <li>Land: {{ $adres->land }}</li>
                </ul>
                <a href="{{ route('download-updated-addresses') }}" class="btn btn-primary">Download Updated Addresses</a>

            </div>
        </div>
    </div>
@endsection
