<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * List enrollments
     * GET /api/enrollments
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Enrollment::with(['student', 'course.instructor']);

        // Build query based on user role
        if ($user->role === 'admin') {
            // Admin can see all enrollments
            if ($request->has('student_id')) {
                $query->where('student_id', $request->student_id);
            }
            if ($request->has('course_id')) {
                $query->where('course_id', $request->course_id);
            }
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }
        } elseif ($user->role === 'instructor') {
            // Instructor can see enrollments for their courses
            $query->whereHas('course', function ($q) use ($user) {
                $q->where('instructor_id', $user->id);
            });
            if ($request->has('course_id')) {
                $query->where('course_id', $request->course_id);
            }
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }
        } else {
            // Student can only see their own enrollments
            $query->where('student_id', $user->id);
            if ($request->has('status')) {
                $query->where('status', $request->status);
            }
        }

        $enrollments = $query->orderBy('enrolled_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'enrollments' => $enrollments,
            'count' => $enrollments->count(),
        ]);
    }

    /**
     * Create a new enrollment
     * POST /api/enrollments
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'status' => 'sometimes|in:active,dropped,completed',
        ]);

        // Check if course exists
        $course = Course::findOrFail($request->course_id);

        // Check if already enrolled
        $existing = Enrollment::where('student_id', $user->id)
            ->where('course_id', $request->course_id)
            ->first();

        if ($existing) {
            return response()->json(['error' => 'Already enrolled in this course'], 409);
        }

        $enrollment = Enrollment::create([
            'student_id' => $user->id,
            'course_id' => $request->course_id,
            'status' => $request->status ?? 'active',
        ]);

        $enrollment->load(['course', 'course.instructor']);

        return response()->json([
            'success' => true,
            'message' => 'Successfully enrolled in course',
            'enrollment' => $enrollment,
        ], 201);
    }

    /**
     * Update an enrollment
     * PUT /api/enrollments/{id}
     */
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $enrollment = Enrollment::with('course')->findOrFail($id);

        // Check permissions
        $canUpdate = false;
        if ($user->role === 'admin') {
            $canUpdate = true;
        } elseif ($user->role === 'instructor' && $enrollment->course->instructor_id == $user->id) {
            $canUpdate = true;
        } elseif ($user->role === 'student' && $enrollment->student_id == $user->id) {
            $canUpdate = true;
        }

        if (!$canUpdate) {
            return response()->json(['error' => 'Insufficient permissions'], 403);
        }

        $request->validate([
            'status' => 'required|in:active,dropped,completed',
        ]);

        $enrollment->update(['status' => $request->status]);
        $enrollment->load(['course']);

        return response()->json([
            'success' => true,
            'message' => 'Enrollment updated successfully',
            'enrollment' => $enrollment,
        ]);
    }

    /**
     * Delete (drop) an enrollment
     * DELETE /api/enrollments/{id}
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $enrollment = Enrollment::findOrFail($id);

        // Check permissions
        $canDrop = false;
        if ($user->role === 'admin') {
            $canDrop = true;
        } elseif ($user->role === 'student' && $enrollment->student_id == $user->id) {
            $canDrop = true;
        }

        if (!$canDrop) {
            return response()->json(['error' => 'Insufficient permissions'], 403);
        }

        // Update status to dropped instead of deleting
        $enrollment->update(['status' => 'dropped']);

        return response()->json([
            'success' => true,
            'message' => 'Enrollment dropped successfully',
        ]);
    }
}

