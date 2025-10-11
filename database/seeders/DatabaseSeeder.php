<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Database\Seeders\PlacesTableSeeder;
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
      $this->call(class:NewsTableSeeder::class);
    }
}
