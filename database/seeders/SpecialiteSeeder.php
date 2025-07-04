<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SpecialiteSeeder extends Seeder
{
    public function run(): void
    {
        $specialites = [
            'Cardiologie',
            'Dermatologie',
            'Pédiatrie',
            'Neurologie',
            'Gynécologie',
            'Ophtalmologie',
        ];

        foreach ($specialites as $name) {
            DB::table('specialite')->insert([
                'name' => $name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
