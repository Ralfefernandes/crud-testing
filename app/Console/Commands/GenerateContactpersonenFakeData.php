<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateContactpersonenFakeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:contactpersonen-fake-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate fake data for Contactpersonen table and export to CSV';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $data = [];

        // Generate fake data for Contactpersonen table
        for ($i = 1; $i <= 5; $i++) {
            $data[] = [
                'voornaam' => $this->generateFirstName(),
                'achternaam' => $this->generateLastName(),
                'geslacht' => ($i % 2 === 0) ? 'Women' : 'Men',
                'email' => $this->generateUniqueEmail(),
                'telefoonnummer_vast' => $this->generateUniquePhoneNumber(),
                'telefoonnummer_mobiel' => '06' . rand(10000000, 99999999),
                'notities' => 'Notities ' . $i,
            ];
        }

        // Export data to CSV file
        $filename = 'contactpersonen.csv';
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

        $this->info('Fake data for Contactpersonen table generated and exported to ' . $filename);

        return 0;
    }

    /**
     * Generate a random first name.
     *
     * @return string
     */
    private function generateFirstName()
    {
        $faker = \Faker\Factory::create();
        return $faker->firstName;
    }

    /**
     * Generate a random last name.
     *
     * @return string
     */
    private function generateLastName()
    {
        $faker = \Faker\Factory::create();
        return $faker->lastName;
    }

    /**
     * Generate a unique email address.
     *
     * @return string
     */
    private function generateUniqueEmail()
    {
        $faker = \Faker\Factory::create();
        $email = $faker->unique()->safeEmail;
        return $email;
    }

    /**
     * Generate a unique phone number.
     *
     * @return string
     */
    private function generateUniquePhoneNumber()
    {
        return rand(100000000, 999999999);
    }
}
