<?php

namespace App\Http\Controllers;

use App\Models\Bedrijven;
use Illuminate\Http\Request;
use App\Models\Adressen;
use Illuminate\Support\Str;
use League\Csv\Writer;

class AdresController extends Controller
{
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
}
