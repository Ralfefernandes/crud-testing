<?php

namespace App\Console\Commands;

use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateAdressenFakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:adressen-fake-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate fake data for Adressen table and export to CSV';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $faker = Factory::create();

        $data = [];

        // Generate fake data for Adressen table
        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'beschrijving' => 'Beschrijving ' . $i,
                'straatnaam' => $this->generateStreetName(),
                'huisnummer' => $this->generateHouseNumber(),
                'postcode' => $this->generatePostcode(),
                'plaatsnaam' => $this->generateCityName(),
                'land' => $this->generateCountryName(),
                'kvk' => $faker->randomNumber(8),
            ];
        }

        // Export data to CSV file
        $filename = 'adressen.csv';
        $path = storage_path('app/public/csv/');
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        $file = fopen($path . $filename, 'w');
        fputcsv($file, array_keys($data[0]));
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

        $this->info('Fake data for Adressen table generated and exported to ' . $filename);

        return 0;
    }

    /**
     * Generate a random street name.
     *
     * @return string
     */
    private function generateStreetName()
    {
        $streets = ['First Street', 'Second Street', 'Third Street', 'Fourth Street', 'Fifth Street'];
        return $streets[array_rand($streets)];
    }

    /**
     * Generate a random house number.
     *
     * @return string
     */
    private function generateHouseNumber()
    {
        return rand(1, 100);
    }

    /**
     * Generate a random postcode with 4 digits and 2 letters.
     *
     * @return string
     */
    private function generatePostcode()
    {
        $digits = rand(1000, 9999);
        $letters = chr(rand(65, 90)) . chr(rand(65, 90));
        return $digits . ' ' . $letters;
    }

    /**
     * Generate a random city name.
     *
     * @return string
     */
    private function generateCityName()
    {
        $cities = ['City A', 'City B', 'City C', 'City D', 'City E'];
        return $cities[array_rand($cities)];
    }

    /**
     * Generate a random country name.
     *
     * @return string
     */
    private function generateCountryName()
    {
        $countries = ['Country X', 'Country Y', 'Country Z'];
        return $countries[array_rand($countries)];
    }
}
