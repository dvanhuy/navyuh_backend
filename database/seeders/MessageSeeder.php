<?php

namespace Database\Seeders;

use App\Models\JoiningDetails;
use App\Models\Message;
use App\Models\Server;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Server::all() as $server) {
            $users = JoiningDetails::where('server_id',$server->id)->get();
            if (sizeof($users)) {
                for ($i=0; $i < 50; $i++) {
                    Message::create([
                        'content'=>fake()->sentence(6),
                        'sender_id'=>fake()->randomElement($users->toArray())['user_id'],
                        'server_id'=>$server->id,
                    ]);
                }
            }
        }
    }
}
