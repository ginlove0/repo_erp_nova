<?php


namespace App\Services\Manufacture;


use App\Models\Manufactor;

class ManufactureService implements ManufactureServiceInterface
{


    public function create(array $manufacture = ["name" => "CISCO"]): Manufactor
    {

        return Manufactor::create($manufacture);
    }

    public function update($id, array $data): Manufactor
    {
        $manufacture = Manufactor::findOrFail($id);
        $manufacture->fill($data);
        $manufacture->save();
        return $manufacture;

    }

    public function delete($id): Manufactor
    {
        // TODO: Implement delete() method.
        $data = Manufactor::findOrFail($id);
        $data->delete();
        $data->save();
        return $data;
    }

    public function firstOrCreate(?string $name = "CISCO"): Manufactor
    {
        $default_name = "CISCO";
        if($name) {
            return Manufactor::firstOrCreate(['name' =>  $name]);
        } else {
            return Manufactor::firstOrCreate(['name' =>  $default_name]);

        }
    }
}