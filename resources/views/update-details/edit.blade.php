@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h1>Contact Person Details</h1>
            <table class="table table-bordered">
                <thead>
                <tr>
                    @foreach ($contactPerson->getAttributes() as $attribute => $value)
                        @if (!in_array($attribute, ['kvk', 'geslacht','created_at', 'updated_at', 'token', 'id']))
                            <th scope="col">{{ ucfirst(str_replace('_', ' ', $attribute)) }}</th>
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $contactPerson->voornaam }}</td>
                        <td>{{ $contactPerson->achternaam }}</td>
                        <td>{{ $contactPerson->email }}</td>
                        <td>{{ $contactPerson->telefoonnummer_vast }}</td>
                        <td>{{ $contactPerson->telefoonnummer_mobiel }}</td>
                        <td>{{ $contactPerson->notities }}</td>
                        <td>
                            <a href="{{ route('edit-details/', $contactPerson->id) }}" class="btn btn-primary">Edit</a>

                        </td>
                    </tr>
                </tbody>
            </table>

                </div>
            </div>

        <div class="col-md-9">
            <h3>Associated Bedrijf gegevens</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    @foreach ($bedrijvenColumns as $column)
                        <th scope="col">{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{ $contactPerson->bedrijven->bedrijfsnaam }}</td>
                    <td>{{ $contactPerson->bedrijven->kvk }}</td>
                    <td>{{ $contactPerson->bedrijven->btw }}</td>
                    <td>{{ $contactPerson->bedrijven->land_van_vestiging }}</td>
                    <td>
                        <a href="{{ route('edit-bedrijven', $contactPerson->bedrijven->id) }}" class="btn btn-primary">Edit</a>
{{--                        <form action="{{ route('delete-details', $contactPerson->bedrijven->id) }}" method="POST" style="display: inline-block;">--}}
{{--                            @csrf--}}
{{--                            @method('DELETE')--}}
{{--                            <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                        </form>--}}
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    <div class="col-md-9">
        <h3>Associated adresgegevens</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                @foreach ($adressenColumns as $column)
                    <th scope="col">{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $contactPerson->bedrijven->adressen->beschrijving }}</td>
                <td>{{ $contactPerson->bedrijven->adressen->straatnaam }}</td>
                <td>{{ $contactPerson->bedrijven->adressen->huisnummer }}</td>
                <td>{{ $contactPerson->bedrijven->adressen->postcode }}</td>
                <td>{{ $contactPerson->bedrijven->adressen->plaatsnaam }}</td>
                <td>{{ $contactPerson->bedrijven->adressen->land }}</td>
                <td>
                    <a href="{{ route('edit-adressen', $contactPerson->bedrijven->adressen->id) }}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('delete-details', $contactPerson->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>





