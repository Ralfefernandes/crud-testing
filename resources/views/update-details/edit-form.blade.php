@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Edit Contact Person Details</h1>
            <form action="{{ route('update-details.update', ['id' => $contactPerson->id]) }}" method="POST">
                @csrf
                @method('PUT')
                @foreach ($contactPersonColumns as $column)
                    @if (in_array($column, ['geslacht', 'voornaam', 'achternaam', 'email', 'telefoonnummer_vast', 'telefoonnummer_mobiel', 'notities']))
                        @php
                            $fieldName = str_replace('_', ' ', $column);
                            $labelId = 'label_' . $column;
                            $fieldValue = $contactPerson->$column ?? '';
                            $isRequired = !empty($fieldValue);
                        @endphp

                        <div class="form-group" id="{{ $column }}_container">
                            <label id="{{ $labelId }}" for="{{ $column }}">{{ ucfirst($fieldName) }}</label>
                            @if ($column === 'notities')
                                <textarea class="form-control" id="{{ $column }}" name="{{ $column }}" @if ($isRequired)  @endif>{{ $fieldValue }}</textarea>
                            @else
                                <input type="text" class="form-control" id="{{ $column }}" name="{{ $column }}" value="{{ $fieldValue }}" @if ($isRequired)

                                @endif>
                            @endif
                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteColumn('{{ $column }}', '{{ $labelId }}')">Delete</button>
                        </div>
                    @endif
                @endforeach
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

<script>
    function deleteColumn(column, labelId) {
        const confirmation = confirm("Are you sure you want to delete this column?");
        if (confirmation) {
            // Send an AJAX request to delete the column
            let url = "{{ route('delete-column', ['id' => $contactPerson->id, 'column' => ':column']) }}";
            url = url.replace(':column', column);

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })
                .then(response => {
                    if (response.ok) {
                        // Remove the field container
                        const fieldContainer = document.getElementById(column + '_container');
                        if (fieldContainer) {
                            fieldContainer.remove();
                        }
                    } else {
                        // Handle the error case as needed
                        console.error('Error deleting column:', response.statusText);
                    }
                })
                .catch(error => {
                    console.error('Error deleting column:', error);
                });
        }
    }
</script>
