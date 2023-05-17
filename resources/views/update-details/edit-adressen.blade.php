@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h1>Edit Adresgegevens</h1>
            <div class="col-md-3">
                @foreach ($adressenColumns as $column)
                    @if ($column != 'kvk')
                        <div class="form-group">
                            <div class="d-flex align-items-center">
                                <form action="{{ route('update-adressen.update', ['id' => $adres->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label for="{{ $column }}" class="mr-2">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                                    <input type="hidden" name="column" value="{{ $column }}">
                                    <input type="text" class="form-control d-inline-block" id="{{ $column }}" name="{{ $column }}" value="{{ $adres->$column }}">
                                    <button type="submit" class="btn btn-primary ml-2">Update</button>
                                </form>
                                <form action="{{ route('delete-adressen', ['id' => $adres->id, 'column' => $column]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger ml-2">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
