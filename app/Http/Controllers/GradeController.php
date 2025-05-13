<?php

namespace App\Http\Controllers;

use App\Http\Requests\GradeRequest;
use App\Http\Resources\GradeResource;
use App\Models\Enrollment;
use App\Models\Grade;
use Illuminate\Http\JsonResponse;

class GradeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(GradeRequest $request): JsonResponse
    {
        try {
            $enrollment = Enrollment::findOrFail($request->enrollment_id);

            // Verificar si ya existe una calificación para esta inscripción
            if ($enrollment->grade()->exists()) {
                return response()->json(['message' => 'Ya existe una calificación para esta inscripción.'], 409);
            }

            $grade = Grade::create($request->validated());

            return response()->json(new GradeResource($grade), 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al registrar la calificación.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade): JsonResponse
    {
        return response()->json(new GradeResource($grade));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GradeRequest $request, Grade $grade): JsonResponse
    {
        try {
            $grade->update($request->validated());
            return response()->json(new GradeResource($grade));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar la calificación.', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade): JsonResponse
    {
        try {
            $grade->delete();
            return response()->json(['message' => 'Calificación eliminada correctamente.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la calificación.', 'error' => $e->getMessage()], 500);
        }
    }
}
