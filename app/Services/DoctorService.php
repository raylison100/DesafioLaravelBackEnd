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
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->crm = $request->crm;
        $doctor->specialty = $request->specialty;

        if ($request->hasfile('photograph') && $request->file('photograph')->isValid()) {

            $imageName = kebab_case($doctor->name) . 'img';
            $extenstion = $request->photograph->extension();

            $nameFile = "{$imageName}.{$extenstion}";

            $doctor->photograph = 'doctor/' . $nameFile;
            $request->photograph->storeAs('doctor', $nameFile);
        }

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
        $doctor = Doctor::find($id);

        $nome = $doctor->name;

        if ($doctor->delete()) {
            return response()->json(['data' => "User {$nome} removed successfully"], 200);
        }
        return response()->json(['data' => ['error' => "User not found!"]], 404);
    }
}