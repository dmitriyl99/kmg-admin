<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CargoRequest;
use App\Models\Cargo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cargos = Cargo::query()->paginate(15);
        return response()->json($cargos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CargoRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CargoRequest $request)
    {
        $data = $request->validated();

        $cargo = DB::transaction(function () use ($data, $request) {
            /** @var Cargo $cargo */
            $cargo = Cargo::query()->create($data);

            if ($request->hasFile('images')) {
                $images = $request->file('images');
                foreach ($images as $image) {
                    $imageData = ImageHelper::saveImage($image, 'cargos');
                    $cargo->images()->create($imageData);
                }
            }

            return $cargo;
        });

        return response()->json($cargo);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $cargo = Cargo::with('images')->findOrFail($id);

        return response()->json($cargo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CargoRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CargoRequest $request, int $id)
    {
        $data = $request->validated();

        /** @var Cargo $cargo */
        $cargo = Cargo::query()->findOrFail($id);

        $cargo = DB::transaction(function () use ($data, $cargo, $request) {
            $cargo->update($data);

            if ($request->hasFile('images')) {
                foreach ($cargo->images as $image)
                    ImageHelper::deleteImage($image->filename);
                $cargo->images()->delete();

                $images = $request->file('images');
                foreach ($images as $image) {
                    $imageData = ImageHelper::saveImage($image, 'cargo');
                    $cargo->images()->create($imageData);
                }
            }

            return $cargo;
        });

        return response()->json($cargo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $cargo = Cargo::query()->findOrFail($id);

        foreach ($cargo->images as $image) {
            ImageHelper::deleteImage($image->filename);
        }
        $cargo->images()->delete();
        $cargo->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
