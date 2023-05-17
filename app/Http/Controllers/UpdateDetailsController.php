<?php

namespace App\Http\Controllers;

use App\Models\Bedrijven;
use App\Models\Contactpersonen;
use App\Models\Adressen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\Csv\CannotInsertRecord;
use League\Csv\Exception;
use League\Csv\UnavailableStream;
use League\Csv\Writer;



class UpdateDetailsController extends Controller
{
    public function edit($token)
    {
        // Decode the token to retrieve the contact person's ID
        $id = base64_decode($token);

        // Find the contact person based on the ID and eager load the associated data from other tables
        $contactPerson = Contactpersonen::with(['bedrijven', 'bedrijven.adressen'])->find($id);
        // Check if contact person exists
        if (!$contactPerson) {
            return redirect()->route('invalid-hash');
        }

        // Retrieve the associated Bedrijven model
        // Add the token attribute to the contact person object
        $contactPerson->token = $token;

        // Retrieve the associated Bedrijven model
        $bedrijf = $contactPerson->bedrijven;

        // Get the column names from the Bedrijven model
        $bedrijvenColumns = Bedrijven::first()->getFillable();
        $adressenColumns = Adressen::first()->getFillable();

        return view('update-details.edit', compact('contactPerson', 'bedrijf', 'bedrijvenColumns', 'adressenColumns'));
    }

    public function update(Request $request, $id)
    {

        // Find the contact person based on the ID
        $contactPerson = Contactpersonen::find($id);

        // Check if contact person exists
        if (!$contactPerson) {
            return redirect()->route('invalid-hash');
        }

// Validate the form data
        $rules = [
            'voornaam' => 'nullable',
            'achternaam' => 'nullable',
            'email' => 'nullable',
            'telefoonnummer_vast' => 'nullable',
            'telefoonnummer_mobiel' => 'nullable',
            'notities' => 'nullable',
        ];

        $validatedData = $request->validate($rules);

// Update the contact person's details
        $contactPerson->update($validatedData);

        // Redirect to a success page or display a success message
        return redirect()->route('persoon-updated', ['id' => $id]);
    }
    // Show the edit form
    public function showEditForm($id)
    {
        // Fetch the contact person details...
        $contactPerson = Contactpersonen::find($id);
        // get the header data from model, Dynamic form
        $contactPersonColumns = Contactpersonen::first()->getFillable();


        if (!$contactPerson) {
            return redirect()->route('invalid-hash');
        }
        return view('update-details.edit-form', compact('contactPerson', 'contactPersonColumns'));
    }
    public function contactPersoon($id)
    {
        $contactPerson = Contactpersonen::find($id);

        if (!$contactPerson) {
            return redirect()->route('invalid-hash');

        }
        // dynamic data for contact-success-contactpage
        $contactPersonColumns = array_diff(Contactpersonen::first()->getFillable(), ['kvk']);

        return view('update-details.success-contactpage', compact('contactPerson', 'contactPersonColumns'));
    }


    public function editBedrijven($id)
    {
        $bedrijf = Bedrijven::find($id);
        $bedrijvenColumns = Bedrijven::first()->getFillable();

        return view('update-details.edit-bedrijven', compact('bedrijf', 'bedrijvenColumns'));
    }

    public function updateBedrijven(Request $request, $id)
    {
        $bedrijf = Bedrijven::find($id);

        if (!$bedrijf) {
            return redirect()->route('invalid-hash');
        }
        // Get all request data except the _token and _method
        $input = $request->except('_token', '_method');


        // Get the field and value
        $field = key($input);
        $value = $input[$field];

        $validatedData = $request->validate([
            'bedrijfsnaam' => 'nullable',
            'kvk' => 'nullable',
            'btw' => 'nullable',
            // Add more validation rules for other fields
        ]);

         // Update the bedrijf page details
        $bedrijf->update($validatedData);

        // Update the specific field
        $bedrijf->$field = $value;
        $bedrijf->save();

        // Redirect to a success page or display a success messageupdate-details.updated-bedrijven
        return redirect()->route('show-updated-bedrijven', ['id' => $id]);
    }

    public function showDetailsUpdated($id)
    {
        $bedrijf = bedrijven::find($id);

        return view('update-details.edit-form', compact('bedrijf'));
    }
    public function showUpdatedBedrijven($id)
    {
        $bedrijf = Bedrijven::find($id);

        if (!$bedrijf) {
            return redirect()->route('invalid-hash');
        }
        $bedrijvenColumns = Bedrijven::first()->getFillable();

        return view('update-details.updated-bedrijven', compact('bedrijf', 'bedrijvenColumns'));
    }
    // Edit Adressen
    public function editAdressen($id)
    {
        $bedrijf = Bedrijven::find($id);

        // Retrieve the attribute names of the Adres model
        $adressenColumns = Adressen::first()->getFillable();
        $adres = $bedrijf->adressen;

        return view('update-details.edit-adressen', compact('adres', 'adressenColumns'));
    }
        // Update Adressen
    public function updateAdressen(Request $request, $id)
    {
        $adres = Adressen::find($id);

        if (!$adres) {
            return redirect()->route('invalid-hash');
        }
        $validatedData = $request->validate([
            'beschrijving' => 'nullable',
            'straatnaam' => 'nullable',
            'huisnummer' => 'nullable',
            'postcode' => 'string|max:255',
            'plaatsnaam' => 'string|max:255',
            'land' => 'string|max:255',
        ]);

        // Update the adresgegevens page details
            $adres->update($validatedData);
        // Redirect to a success page or back to the listing page

        // Get the column to update from the request
        $column = $request->get('column');

        // Validate the new value
        $validatedData = $request->validate([
            $column => 'string|max:255',
        ]);
        // Update only the specified column
        $adres->$column = $validatedData[$column];
        $adres->save();
        return redirect()->route('show-updated-adressen',  ['id' => $id]);
    }
    public function showUpdatedAdressen($id)
    {
        $adres = Adressen::find($id);

        if (!$adres) {
            return redirect()->route('invalid-hash');
        }
        $adresColumns = Adressen::first()->getFillable(); // Get the column names from the Adressen model

        return view('update-details.success-page', compact('adres', 'adresColumns'));
    }


    public function showInvalidHash()
    {
        return view('update-details.invalid-hash');
    }

    public function downloadUpdatedAddresses()
    {
        // Retrieve the updated addresses
        $updatedAddresses = Adressen::whereNotNull('updated_at')->get();

        // Generate a unique filename for the CSV
        $filename = 'updated_addresses_' . Str::random(8) . '.csv';

        // Create a new CSV writer
        $writer = Writer::createFromPath(storage_path('app/' . $filename), 'w+');

        // Insert the CSV headers
        $writer->insertOne(['Beschrijving', 'Straatnaam', 'Huisnummer', 'Postcode', 'Plaatsnaam', 'Land']);

        // Insert the address data
        foreach ($updatedAddresses as $address) {
            $writer->insertOne([
                $address->beschrijving,
                $address->straatnaam,
                $address->huisnummer,
                $address->postcode,
                $address->plaatsnaam,
                $address->land,
            ]);
        }

        // Create a download response with the CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->download(storage_path('app/' . $filename), $filename, $headers);
    }
    public function downloadUpdatedBedrijven()
    {
        // Retrieve the updated bedrijven
        $updatedBedrijven = Bedrijven::whereNotNull('updated_at')->get();

        // Generate a unique filename for the CSV
        $filename = 'updated_bedrijven_' . Str::random(8) . '.csv';

        // Create a new CSV writer
        $csv = Writer::createFromPath(storage_path('app/' . $filename), 'w+');

        // Insert the CSV headers
        $csv->insertOne(['Bedrijfsnaam', 'KvK-nummer', 'BTW-nummer', 'Land van vestiging']);

        // Insert the bedrijven data
        foreach ($updatedBedrijven as $bedrijf) {
            $csv->insertOne([
                $bedrijf->bedrijfsnaam,
                $bedrijf->kvk,
                $bedrijf->btw,
                $bedrijf->land,
            ]);
        }

        // Create a download response with the CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->download(storage_path('app/' . $filename), $filename, $headers);
    }

    /**
     * @throws UnavailableStream
     * @throws CannotInsertRecord
     * @throws Exception
     */
    public function downloadContactpersonen()
    {
        // Retrieve the contactpersonen
        $contactpersonen = Contactpersonen::whereNotNull('updated_at')->get();

        // Generate a unique filename for the CSV
        $filename = 'contactpersonen_' . Str::random(8) . '.csv';

        // Create a new CSV writer
        $writer = Writer::createFromPath(storage_path('app/' . $filename), 'w+');

        // Insert the CSV headers
        $writer->insertOne(['Voornaam', 'Achternaam', 'Email', 'Telefoonnummer Vast', 'Telefoonnummer Mobiel', 'Notities']);

        // Insert the contactpersonen data
        foreach ($contactpersonen as $contactpersoon) {
            $writer->insertOne([
                $contactpersoon->voornaam,
                $contactpersoon->achternaam,
                $contactpersoon->email,
                $contactpersoon->telefoonnummer_vast,
                $contactpersoon->telefoonnummer_mobiel,
                $contactpersoon->notities,
            ]);
        }

        // Create a download response with the CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->download(storage_path('app/' . $filename), $filename, $headers);
    }
    public function deleteColumn($id, $column)
    {
        // Find the contact person based on the ID
        $contactPerson = Contactpersonen::find($id);

        // Check if contact person exists
        if (!$contactPerson) {
            return redirect()->route('invalid-hash');
        }

        // Set the specified column to null
        $contactPerson->$column = null;
        $contactPerson->save();

        // Redirect or show a success message
        return redirect()->back()->with('success', 'Column deleted successfully.');
    }

    public function delete($id)
    {
        // Find the contact person based on the ID
        $contactPerson = Contactpersonen::find($id);

        // Check if contact person exists
        if (!$contactPerson) {
            return redirect()->route('invalid-hash');
        }

        // Delete the contact person
        $contactPerson->delete();

        // Redirect or show a success message
        return redirect()->route('details-deleted',  ['id' => $id]);
    }

    public function deleteAdressen($id, $column)
    {
        $adres = Adressen::find($id);

        // Check if adres exists
        if (!$adres) {
            return redirect()->route('invalid-hash');
        }

        // Check if the column exists
        if (!isset($adres->$column)) {
            return redirect()->route('invalid-column');
        }

        // Clear the value of the column
        $adres->$column = null;
        $adres->save();

        // Return a success response
        return redirect()->route('edit-adressen', ['id' => $id]);
    }
    public function deleteBedrijven($id, $column)
    {
        $bedrijf = Bedrijven::find($id);

        // Check if bedrijf exists
        if (!$bedrijf) {
            return redirect()->route('invalid-hash');
        }

        // Nullify the column
        $bedrijf->$column = null;
        $bedrijf->save();

        // Return a success response
        return redirect()->route('edit-bedrijven', ['id' => $id]);
    }

}
