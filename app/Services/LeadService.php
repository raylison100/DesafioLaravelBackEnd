<?php
/**
 * Created by PhpStorm.
 * User: raylison100
 * Date: 26/11/18
 * Time: 09:22
 */

namespace App\Services;

use App\Models\Lead;


class LeadService
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
        $leeds = Lead::All();

        if ($leeds) {
            return response()->json(['data' => $leeds], 200);
        }
        return response()->json(['data' => ['error' => "Status not found!"]], 404);
    }

    public function register($request)
    {
        $storage = StorageService::get();

        $leeds = new Lead();
        $leeds->name = $request->name;
        $leeds->specialty = $request->specialty;
        $leeds->cellPhone = $request->cellPhone;
        $leeds->description = $request->description;
        $leeds->photograph = $storage->setImage('leads', $request);

        if (!$leeds->save()) {
            return response()->json(['data' => ['error' => "not authorized!"]], 401);
        }
        $email = new EmailService();
        $email->submit();
        return response()->json(['data' => $leeds], 200);
    }

    public function show($id)
    {
        $leeds = Lead::find($id);
        if ($leeds) {
            return response()->json(['data' => $leeds], 200);
        }
        return response()->json(['data' => ['error' => "Status not found!"]], 404);
    }

    public function update($request, $id)
    {

        $leeds = Lead::find($id);
        if ($leeds->update($request->all())) {
            return response()->json(['data' => "Update user {$leeds->name} successfully"], 200);
        }
        return response()->json(['data' => ['error' => "User not found!"]], 404);
    }

    public function delete($id)
    {
        $storage = StorageService::get();
        $leeds = Lead::find($id);

        $nome = $leeds->name;
        $img = $leeds->photograph;

        if ($leeds->delete()) {
            $storage->deleteImage($img);
            return response()->json(['data' => "User {$nome} removed successfully"], 200);
        }
        return response()->json(['data' => ['error' => "User not found!"]], 404);
    }
}
