<?php

namespace Database\Seeders;

use App\Models\ContainerStatus;
use Illuminate\Database\Seeder;

class ContainerStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! app()->environment('local')) {
            ContainerStatus::query()->delete();
        }

        ContainerStatus::query()->create([
            'name' => 'At the terminal',
            'color' => 'warning'
        ]);

        ContainerStatus::query()->create([
            'name' => 'Shipped',
            'color' => 'success'
        ]);
    }
}
