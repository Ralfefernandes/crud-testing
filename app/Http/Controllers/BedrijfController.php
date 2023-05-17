<?php

namespace App\Http\Controllers;

use App\Models\Bedrijven;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\Csv\Writer;

class BedrijfController extends Controller
{
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

}
