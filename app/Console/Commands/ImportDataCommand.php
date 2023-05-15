<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from CSV files into the specified table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->argument('table');
        $csvPath = storage_path('app/public/csv/' . $table . '.csv');

        if (!file_exists($csvPath)) {
            $this->error("CSV file does not exist for table: {$table}");
            return;
        }

        // Read the CSV file
        $data = array_map('str_getcsv', file($csvPath));

        // Remove the header row
        $header = array_shift($data);

        // Prepare the data for insertion
        $rows = [];
        foreach ($data as $row) {
            $rows[] = array_combine($header, $row);
        }

        // Insert data into the database
        $success = DB::table($table)->insert($rows);

        if ($success) {
            $this->info("Data imported successfully into table: {$table}");
        } else {
            $this->error("Failed to import data into table: {$table}");
        }
    }
}
