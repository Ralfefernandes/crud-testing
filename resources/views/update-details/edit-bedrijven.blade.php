@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Edit Bedrijven Details</h1>
            @foreach ($bedrijvenColumns as $column)
                <div class="form-group">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <label for="{{ $column }}" class="mr-2">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                            <form action="{{ route('update-bedrijven.update', ['id' => $bedrijf->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-control d-inline-block" id="{{ $column }}" name="{{ $column }}" value="{{ $bedrijf->$column }}">
                            </form>
                        </div>
                        <form action="{{ route('delete-bedrijven', ['id' => $bedrijf->id, 'column' => $column]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
            <form action="{{ route('update-bedrijven.update', ['id' => $bedrijf->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
