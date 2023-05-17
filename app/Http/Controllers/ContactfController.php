<?php

namespace App\Http\Controllers;

use App\Models\Contactpersonen;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\Csv\CannotInsertRecord;
use League\Csv\Exception;
use League\Csv\UnavailableStream;
use League\Csv\Writer;

class ContactfController extends Controller
{
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
}
