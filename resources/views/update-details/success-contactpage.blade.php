@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>Updated Contact Person Details</h1>
                @foreach ($contactPersonColumns as $column)
                    @if ($column !== 'bedrijven_id')
                        <div class="form-group">
                            <label for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                            <p>{{ $contactPerson->$column }}</p>
                        </div>
                    @endif
                @endforeach
                <a href="{{ route('download-contactpersonen') }}" class="btn btn-primary">Download Contactgegevens</a>
            </div>
        </div>
    </div>
@endsection
