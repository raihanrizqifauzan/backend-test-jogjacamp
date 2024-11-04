<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\AppointmentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AppointmentController extends Controller
{
    protected $appointmentRepository;

    public function __construct(AppointmentRepositoryInterface $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/appointment",
     *     summary="Create a new appointment",
     *     tags={"Appointment"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"patient_id", "diagnose_id"},
     *             @OA\Property(property="patient_id", type="integer", example=1),
     *             @OA\Property(property="diagnose_id", type="integer", example=1)
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Appointment created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $appointment = $this->appointmentRepository->create($request->all());

        return response()->json($appointment, 201);
    }

     /**
     * @OA\Get(
     *     path="/api/appointment/{id}",
     *     summary="Get an appointment by ID",
     *     tags={"Appointment"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Get appointment details",
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Appointment not found"
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $appointment = $this->appointmentRepository->findById($id);

        return response()->json([
            'id' => $appointment->id,
            'patient' => [
                'id' => $appointment->patient->id,
                'name' => $appointment->patient->name,
            ],
            'diagnose' => [
                'id' => $appointment->diagnose->id,
                'name' => $appointment->diagnose->name,
            ],
            'checkup' => $appointment->checkupProgress->map(function ($checkup) {
                return [
                    'id' => $checkup->id,
                    'service' => [
                        'id' => $checkup->service->id,
                        'name' => $checkup->service->name,
                    ],
                    'status' => $checkup->status,
                ];
            }),
        ], 200);
    }

    /**
     * @OA\Patch(
     *     path="/api/appointment/{id}",
     *     summary="Update an appointment by ID",
     *     tags={"Appointment"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(property="status", type="integer", example=1)
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Appointment updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Appointment")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Appointment not found"
     *     )
     * )
     */
    public function update(Request $request, $id): JsonResponse
    {
        $appointment = $this->appointmentRepository->update($id, $request->all());

        return response()->json([
            'id' => $appointment->id,
            'patient' => [
                'id' => $appointment->patient->id,
                'name' => $appointment->patient->name,
            ],
        ], 200);
    }
}
