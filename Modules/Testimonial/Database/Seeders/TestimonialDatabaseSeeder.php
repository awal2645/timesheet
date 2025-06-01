<?php

namespace Modules\Testimonial\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Testimonial\App\Models\Testimonial;

class TestimonialDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dummy data for testimonials
        $testimonials = [
            [
                'name' => 'John Doe',
                'designation' => 'Software Engineer',
                'company' => 'Tech Solutions',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'rating' => '5',
                'image' => '/images/default-user.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'designation' => 'Project Manager',
                'company' => 'Business Corp',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'rating' => '4',
                'image' => '/images/default-user.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alice Johnson',
                'designation' => 'UX Designer',
                'company' => 'Creative Agency',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'rating' => '5',
                'image' => '/images/default-user.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the testimonials table
        DB::table('testimonials')->insert($testimonials);
    }
}
