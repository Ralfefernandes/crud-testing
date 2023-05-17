@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Adresgegevens</h1>
            <div class="col-md-3">
                @foreach ($adressenColumns as $column)
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <label for="{{ $column }}" class="mr-2">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                                <form action="{{ route('update-adressen.update', ['id' => $adres->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" class="form-control d-inline-block" id="{{ $column }}" name="{{ $column }}" value="{{ $adres->$column }}" >
                                </form>
                            </div>
                            <form action="{{ route('delete-adressen', ['id' => $adres->id, 'column' => $column]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                <form action="{{ route('update-adressen.update', ['id' => $adres->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
