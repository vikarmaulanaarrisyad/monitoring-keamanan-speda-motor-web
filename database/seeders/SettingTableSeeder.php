<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new Setting();
        $setting->app_name = "SIK Motor";
        $setting->title_login = "Sistem Keamanan Sepeda Motor Berbasis Internet Of Things";
        $setting->path_image_header = "logo.jpg";
        $setting->path_image = "logo.jpg";
        $setting->save();
    }
}
