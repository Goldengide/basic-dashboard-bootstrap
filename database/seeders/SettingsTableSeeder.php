<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => 'App Name',
                'slug' => 'app-name',
                'value' => 'Spokesman Sanctuary of Hope',
                'type' => 'text',
                'group' => 'core'
            ],
            [
                'name' => 'Homepage Title',
                'slug' => 'homepage-title',
                'value' => 'Spokesman Sanctuary of Hope',
                'type' => 'text',
                'group' => 'core'
            ],
            [
                'name' => 'App Icon',
                'slug' => 'app-icon',
                'value' => '',
                'type' => 'image',
                'group' => 'core'
            ],
            [
                'name' => 'Preloader Icon',
                'slug' => 'preloader-icon',
                'value' => '',
                'type' => 'image',
                'group' => 'core'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
