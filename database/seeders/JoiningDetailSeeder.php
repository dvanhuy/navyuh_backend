<?php

namespace Database\Seeders;

use App\Models\JoiningDetails;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JoiningDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::limit(10)->get();
        foreach ($users as $user) {
            $servers = Server::inRandomOrder()->limit(3)->get();
            foreach ($servers as $server) {
                JoiningDetails::create([
                    'user_id' => $user->id,
                    'server_id'=>$server->id,
                    'role'=>fake()->randomElement(['admin','']),
                ]);
            }
        }
    }
}
