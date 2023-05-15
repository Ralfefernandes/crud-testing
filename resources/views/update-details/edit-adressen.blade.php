@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Adresgegevens</h1>
            <div class="col-md-3">
                <form action="{{ route('update-adressen.update', ['id' => $adres->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="text">Beschrijving</label>
                        <input type="text" class="form-control" id="beschrijving" name="beschrijving" value="{{ $adres->beschrijving }}" required>
                    </div>
                    <div class="form-group">
                        <label for="text">Straatnaam</label>
                        <input type="text" class="form-control" id="straatnaam" name="straatnaam" value="{{ $adres->straatnaam }}" required>
                    </div>
                    <div class="form-group">
                        <label for="huisnummer">Huisnummer</label>
                        <input type="text" class="form-control" id="huisnummer" name="huisnummer" value="{{ $adres->huisnummer }}" required>
                    </div>
                    <div class="form-group">
                        <label for="postcode">Postcode</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $adres->postcode }}" required>
                    </div>
                    <div class="form-group">
                        <label for="plaatsnaam">Plaatsnaam</label>
                        <input type="text" class="form-control" id="plaatsnaam" name="plaatsnaam" value="{{ $adres->plaatsnaam }}" required>
                    </div>
                    <div class="form-group">
                        <label for="land">Land</label>
                        <input type="text" class="form-control" id="land" name="land" value="{{ $adres->land }}" required>

                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
