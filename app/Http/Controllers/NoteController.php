<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Services\NoteService;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Resources\{NoteCollection, NoteResource};

class NoteController extends Controller
{
    public NoteService $noteService;

    public function __construct(NoteService $noteService) {
        $this->noteService = $noteService;
    }

    public function index()
    {
        return (new NoteCollection($this->noteService->getAllQuery()))->response()->setStatusCode(200);
    }

    public function store(StoreNoteRequest $request)
    {
        return (new NoteResource($this->noteService->store()))->response()->setStatusCode(201);
    }

    public function update(StoreNoteRequest $request, int $id)
    {
        return (new NoteResource($this->noteService->update($id)))->response()->setStatusCode(202);
    }

    public function destroy(int $id)
    {
        $note = Note::find($id);
        $note->delete();

        return (new NoteResource($note))->response()->setStatusCode(202);
    }
}
