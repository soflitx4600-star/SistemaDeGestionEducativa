<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreConsultaRequest;
use App\Models\Consulta;
use Illuminate\Http\JsonResponse;

class ConsultaController extends Controller
{
    /**
     * Store a new consulta from the frontend contact form.
     */
    public function store(StoreConsultaRequest $request): JsonResponse
    {
        Consulta::create($request->validated());

        return response()->json([
            'message' => 'Consulta enviada correctamente.',
        ], 201);
    }
}
