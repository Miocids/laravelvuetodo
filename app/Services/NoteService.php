<?php namespace App\Services;

use App\Repositories\{NoteRepository};
use Illuminate\Support\Facades\{Cache, DB};
use Illuminate\Support\{Collection, Str};
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\{Response};

class NoteService extends NoteRepository
{
    /**
     * Store a newly created resource in storage.
     *
     * @return Model|null
     * @throws \Exception
     */
    public function store(): ?Model
    {
        DB::beginTransaction();
        try {
            $payload = \request()->merge([
                'user_id'       => \auth()?->user()?->getKey(),
                'tags'          => json_encode(\request()->input("tags"))
            ])->toArray();

            $response = $this->saveRepository($payload);

            DB::commit();

            return $response;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $id
     * @return Model|null
     * @throws \Exception
     */
    public function update(int $id): ?Model
    {
        DB::beginTransaction();
        try {
            $payload = \request()->merge([
                'user_id'       => \auth()?->user()?->getKey(),
                'tags'          => json_encode(\request()->input("tags"))
            ])->toArray();

             $response = $this->updateRepository(
                $payload,
                $id
            );

            DB::commit();

            return $response;

        } catch (\Throwable $e) {
            $error = $e->getMessage() . " " . $e->getLine() . " " . $e->getFile();
            \Log::error($error);
            DB::rollback();

            throw new \Exception($e->getMessage(),Response::HTTP_BAD_REQUEST);
        }
    }

}