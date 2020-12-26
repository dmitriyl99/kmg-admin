<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContainerRequest;
use App\Models\Container;
use App\Models\ContainerStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $containers = Container::with('containerStatus', 'images', 'invoice')->paginate(15);
        return response()->json($containers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContainerRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContainerRequest $request)
    {
        $data = $request->validated();
        if (in_array('paid', $data))
            $data['paid'] = true;
        if (in_array('active', $data['invoice']))
            $data['invoice']['active'] = true;

        $container = DB::transaction(function () use ($data, $request) {
            /** @var Container $container */
            $container = Container::query()->create($data);

            $container->invoice()->create($data['invoice']);

            $images = $request->file('images');
            foreach ($images as $image) {
                $imageData = ImageHelper::saveImage($image, 'containers');
                $container->images()->create($imageData);
            }

            return $container;
        });

        return response()->json($container);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $container = Container::with('images', 'invoice', 'status')->findOrFail($id);

        return response()->json($container);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContainerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ContainerRequest $request, $id)
    {
        /** @var Container $container */
        $container = Container::query()->findOrFail($id);

        $data = $request->validated();
        if (in_array('paid', $data))
            $data['paid'] = true;
        if (in_array('active', $data['invoice']))
            $data['invoice']['active'] = true;

        $container = DB::transaction(function () use ($data, $request, $container) {
            $container->update($data);

            $container->invoice->update($data['invoice']);

            if ($request->has('images')) {
                foreach ($container->images as $image)
                    ImageHelper::deleteImage($image->filename);
                $container->images()->delete();

                $images = $request->file('images');
                foreach ($images as $image) {
                    $imageData = ImageHelper::saveImage($image, 'containers');
                    $container->images()->create($imageData);
                }
            }

            return $container;
        });

        return response()->json($container);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        /** @var Container $container */
        $container = Container::query()->findOrFail($id);

        DB::transaction(function () use ($container) {
            foreach ($container->images as $image) {
                ImageHelper::deleteImage($image->filename);
            }
            $container->images()->delete();
            $container->invoice->delete();
            $container->delete();
        });

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    public function statuses()
    {
        return ContainerStatus::all();
    }
}
