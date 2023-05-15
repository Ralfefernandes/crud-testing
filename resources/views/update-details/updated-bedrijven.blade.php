@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>Updated Bedrijven Details</h1>
                <div class="form-group">
                    <label for="bedrijfsnaam">Bedrijfsnaam</label>
                    <p>{{ $bedrijf->bedrijfsnaam }}</p>
                </div>
                <div class="form-group">
                    <label for="kvk">KvK-nummer</label>
                    <p>{{ $bedrijf->kvk }}</p>
                </div>
                <div class="form-group">
                    <label for="btw">BTW-nummer</label>
                    <p>{{ $bedrijf->btw }}</p>
                </div>
                <div class="form-group">
                    <label for="land_van_vestiging">Land van vestiging</label>
                    <p>{{ $bedrijf->land_van_vestiging }}</p>
                </div>
                <a href="{{ route('download-updated-bedrijven') }}" class="btn btn-primary">Download Updated Bedrijven</a>

            </div>

        </div>
    </div>
@endsection
