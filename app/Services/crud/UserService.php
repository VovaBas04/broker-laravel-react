<?php

namespace App\Services\crud;

use App\Models\User;
use Illuminate\Support\Collection;

class UserService
{
    public function findAll():Collection
    {
        return User::with('company')->orderBy('full_name')->get();
    }
    public function update(User $user,array $data):User
    {
        $user->fill($data)->save();
        return $user;
    }
    public function store(array $data)
    {
        return User::query()->create($data);
    }
    public function destroy(User $user):void
    {
        $user->delete();
    }
}
