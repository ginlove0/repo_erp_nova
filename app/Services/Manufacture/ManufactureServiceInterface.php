<?php


namespace App\Services\Manufacture;


use App\Models\Manufactor;

interface ManufactureServiceInterface
{
    public function create(array $manufacture): Manufactor;


    public function update($id, array $data): Manufactor;


    public function delete($id): Manufactor;

//    find model by name, if not found, create it (by default manufacture name is CISCO)
    public function firstOrCreate(?string $name = "CISCO"): Manufactor;
}