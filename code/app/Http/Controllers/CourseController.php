<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    /**
     * List all courses
     * GET /api/courses
     */
    public function index(Request $request)
    {
        $query = Course::with('instructor')
            ->select('courses.*')
            ->selectRaw('COUNT(enrollments.id) as enrollment_count')
            ->leftJoin('enrollments', function ($join) {
                $join->on('courses.id', '=', 'enrollments.course_id')
                     ->where('enrollments.status', '=', 'active');
            })
            ->groupBy('courses.id');

        // Apply filters
        if ($request->has('semester')) {
            $query->where('courses.semester', $request->semester);
        }

        if ($request->has('year')) {
            $query->where('courses.year', $request->year);
        }

        if ($request->has('instructor')) {
            $query->where('courses.instructor_id', $request->instructor);
        }

        $courses = $query->orderBy('courses.created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'courses' => $courses,
            'count' => $courses->count(),
        ]);
    }

    /**
     * Create a new course
     * POST /api/courses
     */
    public function store(Request $request)
    {
        $user = $request->user();

        // Only instructors and admins can create courses
        if (!in_array($user->role, ['instructor', 'admin'])) {
            return response()->json(['error' => 'Insufficient permissions'], 403);
        }

        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'course_code' => 'required|string|max:20|unique:courses',
            'credits' => 'nullable|integer|min:1',
            'semester' => 'nullable|string|max:20',
            'year' => 'nullable|integer',
            'instructor_id' => 'nullable|integer|exists:users,id',
        ]);

        $instructorId = $user->role === 'admin' 
            ? ($request->instructor_id ?? $user->id)
            : $user->id;

        $course = Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'instructor_id' => $instructorId,
            'course_code' => $request->course_code,
            'credits' => $request->credits ?? 3,
            'semester' => $request->semester,
            'year' => $request->year ?? date('Y'),
        ]);

        $course->load('instructor');

        return response()->json([
            'success' => true,
            'message' => 'Course created successfully',
            'course' => $course,
        ], 201);
    }

    /**
     * Get a single course
     * GET /api/courses/{id}
     */
    public function show($id)
    {
        $course = Course::with('instructor')
            ->select('courses.*')
            ->selectRaw('COUNT(enrollments.id) as enrollment_count')
            ->leftJoin('enrollments', function ($join) {
                $join->on('courses.id', '=', 'enrollments.course_id')
                     ->where('enrollments.status', '=', 'active');
            })
            ->where('courses.id', $id)
            ->groupBy('courses.id')
            ->first();

        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        return response()->json([
            'success' => true,
            'course' => $course,
        ]);
    }

    /**
     * Update a course
     * PUT /api/courses/{id}
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $course = Course::findOrFail($id);

        // Check permissions
        if ($user->role !== 'admin' && $course->instructor_id != $user->id) {
            return response()->json(['error' => 'Insufficient permissions'], 403);
        }

        $request->validate([
            'title' => 'sometimes|string|max:200',
            'description' => 'nullable|string',
            'course_code' => 'sometimes|string|max:20|unique:courses,course_code,' . $id,
            'credits' => 'nullable|integer|min:1',
            'semester' => 'nullable|string|max:20',
            'year' => 'nullable|integer',
            'instructor_id' => 'nullable|integer|exists:users,id',
        ]);

        $updateData = $request->only([
            'title', 'description', 'course_code', 'credits', 'semester', 'year'
        ]);

        // Admin can change instructor
        if ($user->role === 'admin' && $request->has('instructor_id')) {
            $updateData['instructor_id'] = $request->instructor_id;
        }

        $course->update($updateData);
        $course->load('instructor');

        return response()->json([
            'success' => true,
            'message' => 'Course updated successfully',
            'course' => $course,
        ]);
    }

    /**
     * Delete a course
     * DELETE /api/courses/{id}
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();

        // Only admins can delete courses
        if ($user->role !== 'admin') {
            return response()->json(['error' => 'Insufficient permissions'], 403);
        }

        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course deleted successfully',
        ]);
    }
}

