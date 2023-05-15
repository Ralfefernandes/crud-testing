<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Adressen;

class ImportAdressenCsvData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:adressen-csv-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from adressen.csv into Adressen table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = 'adressen.csv';
        $path = database_path('seeds/csv/') . $filename;

        $csvData = array_map('str_getcsv', file($path));
        $header = array_shift($csvData);

        $data = [];
        foreach ($csvData as $row) {
            $data[] = array_combine($header, $row);
        }

        // Check if data already exists based on Huisnummer, Postcode, and Plaatsnaam
        $existingData = Adressen::whereIn('huisnummer', array_column($data, 'huisnummer'))
            ->whereIn('postcode', array_column($data, 'postcode'))
            ->whereIn('plaatsnaam', array_column($data, 'plaatsnaam'))
            ->get();

        if ($existingData->isNotEmpty()) {
            $this->warn('Data from ' . $filename . ' already exists in Adressen table.');
            return 0;
        }

        Adressen::insert($data);

        $this->info('Data from ' . $filename . ' imported into Adressen table.');

        return 0;
    }
}
