@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Edit Contact Person Details</h1>
            <form action="{{ route('update-details.update', ['id' => $contactPerson->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @foreach ($contactPersonColumns as $column)
                    @if (!in_array($column, ['id', 'bedrijven_id', 'created_at', 'updated_at', 'token', 'kvk']))
                        <div class="form-group">
                            <label for="{{ $column }}">{{ ucfirst(str_replace('_', ' ', $column)) }}</label>
                            @if ($column === 'notities')
                                <textarea class="form-control" id="{{ $column }}" name="{{ $column }}" required>{{ $contactPerson->$column }}</textarea>
                            @else
                                <input type="text" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $contactPerson->$column }}" required>
                            @endif
                        </div>
                    @endif
                @endforeach
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>

    </div>
</div>
