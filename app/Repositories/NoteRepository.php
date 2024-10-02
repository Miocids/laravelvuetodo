<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\{Note};

class NoteRepository
{

    /**
     * @return mixed
     */
    public function getAllQuery(): mixed
    {
        return Note::query()
            ->where('user_id', \auth()->user()->getkey())
            ->get();
    }

    /**
     * @param array $attributes
     * @return Model|null
     */
    public function saveRepository(array $attributes): ?Model
    {
        return Note::query()->updateOrCreate($attributes,$attributes);
    }

    /**
     * @param array $attributes
     * @param string $id
     * @return Model|null
     */
    public function updateRepository(array $attributes,string $id): ?Model
    {
        return Note::query()->updateOrCreate([
            "id" => $id
        ],$attributes);
    }

}
