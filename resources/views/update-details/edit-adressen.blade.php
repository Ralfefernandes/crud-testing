@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Adresgegevens</h1>
            <div class="col-md-3">
                <form action="{{ route('update-adressen.update', ['id' => $adres->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @foreach ($adressenColumns as $column)
                        @if ($column !== 'kvk')
                            <div class="form-group">
                                <label for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                                <input type="text" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $adres->$column }}" required>
                            </div>
                        @endif
                    @endforeach
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
