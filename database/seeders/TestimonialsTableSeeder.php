<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestimonialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Dummy data for testimonials
        $testimonials = [
            [
                'name' => 'John Doe',
                'designation' => 'Software Engineer',
                'company' => 'Tech Solutions',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'rating' => '5',
                'image' => '/images/default-user.png', // Dummy image URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'designation' => 'Project Manager',
                'company' => 'Business Corp',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'rating' => '4',
                'image' => '/images/default-user.png', // Dummy image URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alice Johnson',
                'designation' => 'UX Designer',
                'company' => 'Creative Agency',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'rating' => '5',
                'image' => '/images/default-user.png', // Dummy image URL
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the testimonials table
        DB::table('testimonials')->insert($testimonials);
    }
}