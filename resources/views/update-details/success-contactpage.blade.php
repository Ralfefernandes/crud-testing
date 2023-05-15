@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>Updated Contact Person Details</h1>
                <div class="form-group">
                    <label for="voornaam">Voornaam</label>
                    <p>{{ $contactPerson->voornaam }}</p>
                </div>
                <div class="form-group">
                    <label for="achternaam">Achternaam</label>
                    <p>{{ $contactPerson->achternaam }}</p>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <p>{{ $contactPerson->email }}</p>
                </div>
                <div class="form-group">
                    <label for="telefoonnummer_vast">Telefoon</label>
                    <p>{{ $contactPerson->telefoonnummer_vast }}</p>
                </div>
                <div class="form-group">
                    <label for="telefoonnummer_mobiel">Mobile</label>
                    <p>{{ $contactPerson->telefoonnummer_mobiel }}</p>
                </div>
                <div class="form-group">
                    <label for="notities">Notities</label>
                    <p>{{ $contactPerson->notities }}</p>
                </div>
                <a href="{{ route('download-contactpersonen') }}" class="btn btn-primary">Download Contactgegevens</a>
            </div>
        </div>
    </div>
@endsection
