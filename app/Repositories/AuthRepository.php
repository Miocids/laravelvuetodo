<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\{User};

class AuthRepository
{

    /**
     * @param array $attributes
     * @return Model|null
     */
    public function saveRepository(array $attributes): ?Model
    {
        return User::query()->updateOrCreate($attributes,$attributes);
    }

    /**
     * @param array $attributes
     * @param string $id
     * @return Model|null
     */
    public function updateRepository(array $attributes,string $id): ?Model
    {
        return User::query()->updateOrCreate([
            "id" => $id
        ],$attributes);
    }

}
