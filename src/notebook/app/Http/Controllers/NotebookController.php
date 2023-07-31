<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use App\Models\Notebook;
use http\Env\Response;
use Illuminate\Http\JsonResponse;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $notes = Notebook::paginate(10);

        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreNotebookRequest $request
     * @return JsonResponse
     */
    public function store(StoreNotebookRequest $request): JsonResponse
    {
        $validated_data = $request->validate([

        ]);

        $note = Notebook::create($validated_data);

        return response()->json($note, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Notebook $notebook
     * @return JsonResponse
     */
    public function show(Notebook $notebook): JsonResponse
    {
        return response()->json($notebook);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateNotebookRequest $request
     * @param Notebook $notebook
     * @return JsonResponse
     */
    public function update(UpdateNotebookRequest $request, Notebook $notebook): JsonResponse
    {
        $validated_data = $request->validate([]);

        $notebook->update($validated_data);

        return response()->json($notebook);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Notebook $notebook
     * @return JsonResponse
     */
    public function destroy(Notebook $notebook): JsonResponse
    {
        $notebook->delete();

        return response()->json(null, 204);
    }
}
