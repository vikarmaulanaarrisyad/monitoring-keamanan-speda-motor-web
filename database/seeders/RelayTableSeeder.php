<?php

namespace Database\Seeders;

use App\Models\Relay;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relay1 = new Relay();
        $relay1->name_relay = 'Starter Kontak';
        $relay1->keterangan = 'Starter Kontak';
        $relay1->status = 0;
        $relay1->save();

        $relay2 = new Relay();
        $relay2->name_relay = 'Klakson';
        $relay2->keterangan = 'Klakson';
        $relay2->status = 1;
        $relay2->save();

        $relay3 = new Relay();
        $relay3->name_relay = 'Lampu Sein Kiri';
        $relay3->keterangan = 'Lampu Sein Kiri';
        $relay3->status = 1;
        $relay3->save();

        $relay4 = new Relay();
        $relay4->name_relay = 'Lampu Sein Kanan';
        $relay4->keterangan = 'Lampu Sein Kanan';
        $relay4->status = 1;
        $relay4->save();
    }
}
