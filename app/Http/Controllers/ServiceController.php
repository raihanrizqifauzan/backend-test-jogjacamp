<?php 
namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ServiceController extends Controller
{
    protected $serviceRepository;

    public function __construct(ServiceRepositoryInterface $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @OA\Post(
     *     path="/api/service",
     *     summary="Create a new service",
     *     tags={"Service"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Obat")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Service created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Service")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(ServiceRequest $request): JsonResponse
    {
        $service = $this->serviceRepository->create($request->validated());
        return response()->json($service, 201);
    }
}
