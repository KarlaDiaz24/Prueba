<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return StudentResource::collection(Student::all());
    }
    /**
     * @param StudentRequest $request
     * @return StudentResource
     * Save a new Student
     */
    public function store(StudentRequest $request)
    {
        return new StudentResource(Student::create($request->all()));
    }

    /**
     * @param Student $Student
     * @return StudentResource
     * Show a Student
     */
    public function show(Student $Student)
    {
        return new StudentResource($Student);
    }

    /**
     * @param StudentRequest $request
     * @param Student $Student
     * @return StudentResource
     * Update a Student
     */
    public function update(StudentRequest $request, Student $Student)
    {
        $Student->update($request->except(['password']));
        return new StudentResource($Student);
    }

    /**
     * @param Student $Student
     * @return \Illuminate\Http\JsonResponse
     * Delete a Student
     */
    public function destroy(Student $Student)
    {
        $Student->delete();

        return response()->json();
    }
}
