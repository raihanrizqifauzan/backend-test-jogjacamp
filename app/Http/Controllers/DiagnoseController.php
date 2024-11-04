<?php 

namespace App\Http\Controllers;

use App\Http\Requests\DiagnoseRequest;
use App\Repositories\Contracts\DiagnoseRepositoryInterface;
use Illuminate\Http\JsonResponse;

class DiagnoseController extends Controller
{
    protected $diagnoseRepository;

    public function __construct(DiagnoseRepositoryInterface $diagnoseRepository)
    {
        $this->diagnoseRepository = $diagnoseRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/diagnose",
     *     summary="Create a new diagnose",
     *     tags={"Diagnose"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Ringan")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Diagnose created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Diagnose")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(DiagnoseRequest $request): JsonResponse
    {
        $diagnose = $this->diagnoseRepository->create($request->validated());
        return response()->json($diagnose, 201);
    }
}
