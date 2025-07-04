<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'full_name' => 'Admin Général',
                'email' => 'admin@example.com',
                'number_phone' => '0600000000',
                'statut' => 'active',
                'password' => Hash::make('password123'),
                'id_role' => 1,
            ],
            // [
            //     'full_name' => 'Dr. Ahmed',
            //     'email' => 'medecin@example.com',
            //     'number_phone' => '0611111111',
            //     'statut' => 'active',
            //     'password' => Hash::make('password123'),
            //     'id_role' => 2,
            // ],
            [
                'full_name' => 'Patient Test',
                'email' => 'patient@example.com',
                'number_phone' => '0622222222',
                'statut' => 'active',
                'password' => Hash::make('password123'),
                'id_role' => 3,
            ],
        ];

        foreach ($users as $user) {
            $user['created_at'] = now();
            $user['updated_at'] = now();
            $userId = DB::table('users')->insertGetId($user);

            // Création automatique selon le rôle
            switch ($user['id_role']) {
                case 1: // Admin
                    DB::table('admins')->insert([
                        'id' => $userId,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;

                case 2: // Médecin
                    DB::table('medecins')->insert([
                        'id' => $userId,
                        'license_number' => 'MED-' . str_pad($userId, 4, '0', STR_PAD_LEFT),
                        'years_of_experience' => 5,
                        'image' => 'default.jpg',
                        'adresse' => 'Casablanca',
                        'description' => 'Médecin généraliste',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;

                case 3: // Patient
                    DB::table('patients')->insert([
                        'id_user' => $userId,
                        'medical_history' => 'Aucune allergie connue',
                        'image' => 'default.jpg',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    break;
            }
        }
    }
}
