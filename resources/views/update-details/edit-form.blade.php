@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Edit Contact Person Details</h1>
            <form action="{{ route('update-details.update', ['id' => $contactPerson->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="voornaam">Voornaam</label>
                    <input type="text" class="form-control" id="voornaam" name="voornaam" value="{{ $contactPerson->voornaam }}" required>
                </div>
                <div class="form-group">
                    <label for="achternaam">Achternaam</label>
                    <input type="text" class="form-control" id="achternaam" name="achternaam" value="{{ $contactPerson->achternaam }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $contactPerson->email }}" required>
                </div>
                <div class="form-group">
                    <label for="telefoonnummer_vast">Telefoon</label>
                    <input type="text" class="form-control" id="telefoonnummer_vast" name="telefoonnummer_vast" value="{{ $contactPerson->telefoonnummer_vast }}" required>
                </div>
                <div class="form-group">
                    <label for="telefoonnummer_mobiel">Mobile</label>
                    <input type="text" class="form-control" id="telefoonnummer_mobiel" name="telefoonnummer_mobiel" value="{{ $contactPerson->telefoonnummer_mobiel }}" required>
                </div>
                <div class="form-group">
                    <label for="notities">Notities</label>
                    <textarea class="form-control" id="notities" name="notities" required>{{ $contactPerson->notities }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
