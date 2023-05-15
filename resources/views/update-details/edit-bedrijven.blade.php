@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Edit Bedrijven Details</h1>
            <form action="{{ route('update-bedrijven.update', ['id' => $bedrijf->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @foreach ($bedrijvenColumns as $column)
                        <div class="form-group">
                            <label for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                            <input type="text" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $bedrijf->$column }}" required>
                        </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
