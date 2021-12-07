<?php

namespace App\Tasks;

class UserSignInTask
{
    public function run(array $data): bool
    {
        try {
            return app()->auth()->authenticate(
                $data['email'],
                $data['password'],
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
