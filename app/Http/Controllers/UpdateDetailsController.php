<?php

namespace App\Http\Controllers;

use App\Models\Bedrijven;
use App\Models\Contactpersonen;
use App\Models\Adressen;


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


}
