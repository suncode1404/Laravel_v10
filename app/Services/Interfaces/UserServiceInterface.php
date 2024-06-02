<?php

namespace App\Services\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserServiceInterface
{
    public function paginate($request);
    public function create($request);
    public function update($id, $request);
    public function updateStatus($post = []);
    public function destroy($id);
}
