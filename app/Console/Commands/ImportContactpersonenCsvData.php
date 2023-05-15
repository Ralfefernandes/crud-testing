<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contactpersonen;

class ImportContactpersonenCsvData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:contactpersonen-csv-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from contactpersonen.csv into Contactpersonen table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = 'contactpersonen.csv';
        $path = database_path('seeds/csv/') . $filename;

        $csvData = array_map('str_getcsv', file($path));
        $header = array_shift($csvData);

        $data = [];
        foreach ($csvData as $row) {
            $data[] = array_combine($header, $row);
        }

        // Check if data already exists based on E-mail
        $existingEmails = Contactpersonen::whereIn('email', array_column($data, 'email'))
            ->pluck('email')
            ->toArray();

        $duplicateEmails = array_intersect($existingEmails, array_column($data, 'email'));
        if (!empty($duplicateEmails)) {
            $this->warn('Data from ' . $filename . ' cannot be imported. Duplicate email(s) found: ' . implode(', ', $duplicateEmails));
            return 0;
        }

        Contactpersonen::insert($data);

        $this->info('Data from ' . $filename . ' imported into Contactpersonen table.');

        return 0;
    }
}
