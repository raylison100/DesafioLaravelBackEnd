<?php
/**
 * Created by PhpStorm.
 * User: raylison100
 * Date: 26/11/18
 * Time: 09:22
 */

namespace App\Services;


use App\Models\Doctor;


class DoctorService
{
    public static $instance;

    private function __construct()
    {
        self::$instance = $this;
    }

    public static function get()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function listAll()
    {
        $doctor = Doctor::All();
        if ($doctor) {
            return response()->json(['data' => $doctor], 200);
        }
        return response()->json(['data' => ['error' => "Status not found!"]], 404);
    }

    public function register($request)
    {
        $storage = StorageService::get();

        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->crm = $request->crm;
        $doctor->specialty = $request->specialty;
        $doctor->photograph = $storage->setImage('doctor', $request);

        if (!$doctor->save()) {
            return response()->json(['data' => ['error' => "not authorized!"]], 401);
        }
        $email = new EmailService();
        $email->submit();
        return response()->json(['data' => $doctor], 200);
    }


    public function show($id)
    {
        $doctor = Doctor::find($id);
        if ($doctor) {
            return response()->json(['data' => $doctor], 200);
        }
        return response()->json(['data' => ['error' => "Status not found!"]], 404);
    }

    public function update($request, $id)
    {

        $doctor = Doctor::find($id);
        if ($doctor->update($request->all())) {
            return response()->json(['data' => "Update user {$doctor->name} successfully"], 200);
        }
        return response()->json(['data' => ['error' => "User not found!"]], 404);
    }

    public function delete($id)
    {
        $storage = StorageService::get();
        $doctor = Doctor::find($id);

        $nome = $doctor->name;
        $img = $doctor->photograph;

        if ($doctor->delete()) {
            $storage->deleteImage($img);
            return response()->json(['data' => "User {$nome} removed successfully"], 200);
        }
        return response()->json(['data' => ['error' => "User not found!"]], 404);
    }
}