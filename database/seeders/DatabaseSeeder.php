<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Property;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $row = 0;
        if (($handle = fopen('./database/seeders/property-data.csv', 'rb')) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $row++;
                if ($row === 1) {
                    continue;
                }
                $property = new Property();
                $property->fill([
                    'name' => $data[0],
                    'price' => $data[1],
                    'bedrooms' => $data[2],
                    'bathrooms' => $data[3],
                    'storeys' => $data[4],
                    'garages' => $data[5],
                ]);
                $property->save();
            }
            fclose($handle);
        }
    }
}
