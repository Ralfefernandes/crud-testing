<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\UpdateDetailsEmail;
use App\Models\Contactpersonen;

class SendUpdateDetailsEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:update-details-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send update details emails to contact persons';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve all contact persons with their associated data
        $contactPersons = Contactpersonen::with('bedrijven.adressen')->get();

        // Send email to each contact person
        foreach ($contactPersons as $contactPerson) {
            // Generate a unique URL for the contact person
            $id = $contactPerson->id;
            $token = base64_encode($id);
            $url = route('update-details.edit', ['id' => $token]);

            // Send the email with the URL and associated data
            Mail::to($contactPerson->email)->send(new UpdateDetailsEmail($contactPerson, $url));
        }

        $this->info('Update details emails sent successfully.');

        return 0;
    }
}
