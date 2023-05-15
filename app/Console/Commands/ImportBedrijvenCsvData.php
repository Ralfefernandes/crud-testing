<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Bedrijven;

class ImportBedrijvenCsvData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:bedrijven-csv-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from bedrijven.csv into Bedrijven table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $filename = 'bedrijven.csv';
        $path = database_path('seeds/csv/') . $filename;

        $csvData = array_map('str_getcsv', file($path));
        $header = array_shift($csvData);

        $data = [];
        foreach ($csvData as $row) {
            $data[] = array_combine($header, $row);
        }

        $existingData = [];
        foreach ($data as $item) {
            $kvk = $item['kvk'];

            $existingItem = Bedrijven::where('kvk', $kvk)->first();

            if ($existingItem) {
                $this->warn("Data for KVK number '{$kvk}' already exists in the Bedrijven table. Skipping import for this item.");
                continue;
            }

            $existingData[] = $item;
        }

        if (!empty($existingData)) {
            Bedrijven::insert($existingData);
            $this->info('Data from ' . $filename . ' imported into Bedrijven table.');
        } else {
            $this->info('No new data found to import into Bedrijven table.');
        }

        return 0;
    }
}
