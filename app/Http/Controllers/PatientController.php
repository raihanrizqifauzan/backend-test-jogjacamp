<?php 

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Repositories\Contracts\PatientRepositoryInterface;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(title="Klinik API", version="1.0")
*/
class PatientController extends Controller
{
    protected $patientRepository;

    public function __construct(PatientRepositoryInterface $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/patient",
     *     summary="Create a new patient",
     *     tags={"Patient"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="John Doe")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Patient created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Patient")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(PatientRequest $request): JsonResponse
    {
        $patient = $this->patientRepository->create($request->validated());
        return response()->json($patient, 201);
    }
}
