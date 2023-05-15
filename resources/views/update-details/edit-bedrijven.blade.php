@include('layouts.app')

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h1>Edit Bedrijven Details</h1>
            <form action="{{ route('update-bedrijven.update', ['id' => $bedrijf->id]) }}" method="POST">
            @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="bedrijfsnaam">Bedrijfsnaam</label>
                    <input type="text" class="form-control" id="bedrijfsnaam" name="bedrijfsnaam" value="{{ $bedrijf->bedrijfsnaam }}" required>
                </div>
                <div class="form-group">
                    <label for="kvk">KvK-nummer</label>
                    <input type="text" class="form-control" id="kvk" name="kvk" value="{{ $bedrijf->kvk }}" required>
                </div>
                <div class="form-group">
                    <label for="btw">BTW-nummer</label>
                    <input type="text" class="form-control" id="btw" name="btw" value="{{ $bedrijf->btw }}" required>
                </div>
                <div class="form-group">
                    <label for="land_van_vestiging">Land van vestiging</label>
                    <input type="text" class="form-control" id="land_van_vestiging" name="land_van_vestiging" value="{{ $bedrijf->land_van_vestiging }}" required>
                </div>
                <!-- Add more fields related to bedrijven here -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
