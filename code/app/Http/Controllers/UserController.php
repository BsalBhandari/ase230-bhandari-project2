<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Get authenticated user profile
     * GET /api/users/profile
     */
    public function profile(Request $request)
    {
        $user = $request->user();

        $data = [
            'success' => true,
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'role' => $user->role,
                'created_at' => $user->created_at,
            ],
        ];

        // Get enrollments if student
        if ($user->role === 'student') {
            $data['enrollments'] = $user->enrollments()
                ->where('status', 'active')
                ->with('course')
                ->get()
                ->map(function ($enrollment) {
                    return [
                        'id' => $enrollment->course->id,
                        'title' => $enrollment->course->title,
                        'course_code' => $enrollment->course->course_code,
                        'credits' => $enrollment->course->credits,
                        'semester' => $enrollment->course->semester,
                        'year' => $enrollment->course->year,
                        'enrolled_at' => $enrollment->enrolled_at,
                        'status' => $enrollment->status,
                    ];
                });
        }

        // Get courses taught if instructor
        if ($user->role === 'instructor') {
            $data['courses_taught'] = $user->coursesTaught()->get()->map(function ($course) {
                return [
                    'id' => $course->id,
                    'title' => $course->title,
                    'course_code' => $course->course_code,
                    'credits' => $course->credits,
                    'semester' => $course->semester,
                    'year' => $course->year,
                ];
            });
        }

        return response()->json($data);
    }
}

