<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransportationRequest;
use App\Models\Transportation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $paginate = $request->query('paginate', true);
        $query = Transportation::query();
        if ($paginate)
            return response()->json($query->paginate(15));
        return response()->json($query->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TransportationRequest $request
     * @return JsonResponse
     */
    public function store(TransportationRequest $request): JsonResponse
    {
        $data = $request->validated();
        $transportation = Transportation::query()->create($data);
        return response()->json($transportation);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $transportation = Transportation::query()->findOrFail($id);
        return response()->json($transportation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TransportationRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(TransportationRequest $request, int $id): JsonResponse
    {
        $data = $request->validated();
        $transportation = Transportation::query()->findOrFail($id);
        $transportation->update($data);

        return response()->json($transportation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        Transportation::destroy($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
