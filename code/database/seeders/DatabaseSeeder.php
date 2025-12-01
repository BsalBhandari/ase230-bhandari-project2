<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@ase230.edu',
            'password' => Hash::make('password'),
            'first_name' => 'Admin',
            'last_name' => 'User',
            'role' => 'admin',
        ]);

        $instructor = User::create([
            'username' => 'instructor1',
            'email' => 'instructor1@ase230.edu',
            'password' => Hash::make('password'),
            'first_name' => 'John',
            'last_name' => 'Smith',
            'role' => 'instructor',
        ]);

        $student1 = User::create([
            'username' => 'student1',
            'email' => 'student1@ase230.edu',
            'password' => Hash::make('password'),
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'role' => 'student',
        ]);

        $student2 = User::create([
            'username' => 'student2',
            'email' => 'student2@ase230.edu',
            'password' => Hash::make('password'),
            'first_name' => 'Bob',
            'last_name' => 'Johnson',
            'role' => 'student',
        ]);

        // Create courses
        $course1 = Course::create([
            'title' => 'Web Development Fundamentals',
            'description' => 'Introduction to web development using Laravel, HTML, CSS, and JavaScript',
            'instructor_id' => $instructor->id,
            'course_code' => 'ASE230',
            'credits' => 3,
            'semester' => 'Fall',
            'year' => 2025,
        ]);

        $course2 = Course::create([
            'title' => 'Database Design',
            'description' => 'Database design principles and SQL implementation',
            'instructor_id' => $instructor->id,
            'course_code' => 'ASE240',
            'credits' => 3,
            'semester' => 'Fall',
            'year' => 2025,
        ]);

        // Create enrollments
        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course1->id,
            'status' => 'active',
        ]);

        Enrollment::create([
            'student_id' => $student2->id,
            'course_id' => $course1->id,
            'status' => 'active',
        ]);

        Enrollment::create([
            'student_id' => $student1->id,
            'course_id' => $course2->id,
            'status' => 'active',
        ]);
    }
}
