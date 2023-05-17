@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>Updated Bedrijven Details</h1>
                @foreach ($bedrijvenColumns as $column)
                    @if ($column !== 'kvk')
                        <div class="form-group">
                            <label for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                            <p>{{ $bedrijf->$column }}</p>
                        </div>
                    @endif
                @endforeach
                <a href="{{ route('download-updated-bedrijven') }}" class="btn btn-primary">Download Updated Bedrijven</a>
            </div>
        </div>
    </div>
@endsection
