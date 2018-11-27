<?php
/**
 * Created by PhpStorm.
 * User: raylison100
 * Date: 26/11/18
 * Time: 09:22
 */

namespace App\Services;

use App\Models\Leed;
use Illuminate\Http\Request;


class LeedService
{
    public function listAll()
    {
        $leeds = Leed::All();
        if ($leeds) {
            return response()->json(['data' => $leeds], 200);
        }
        return response()->json(['data' => ['error' => "Status not found!"]], 404);
    }

    public function register($request)
    {
        $leeds = new Leed();
        $leeds->name = $request->name;
        $leeds->specialty = $request->specialty;
        $leeds->cellPhone = $request->cellPhone;
        $leeds->description = $request->description;

        if ($request->hasfile('photograph') && $request->file('photograph')->isValid()) {

            $imageName = kebab_case($leeds->name) . 'img';
            $extenstion = $request->photograph->extension();

            $nameFile = "{$imageName}.{$extenstion}";

            $leeds->photograph = 'leeds/' . $nameFile;
            $request->photograph->storeAs('leeds', $nameFile);
        }

        if (!$leeds->save()) {

            return response()->json(['data' => ['error' => "not authorized!"]], 401);
        }
        $email = new EmailService();
        $email->submit();
        return response()->json(['data' => $leeds], 200);
    }


    public function show($id)
    {
        $leeds = Leed::find($id);
        if ($leeds) {
            return response()->json(['data' => $leeds], 200);
        }
        return response()->json(['data' => ['error' => "Status not found!"]], 404);
    }

    public function update($request, $id)
    {

        $leeds = Leed::find($id);
        if ($leeds->update($request->all())) {
            return response()->json(['data' => "Update user {$leeds->name} successfully"], 200);
        }
        return response()->json(['data' => ['error' => "User not found!"]], 404);
    }

    public function delete($id)
    {
        $leeds = Leed::find($id);

        $nome = $leeds->name;

        if ($leeds->delete()) {
            return response()->json(['data' => "User {$nome} removed successfully"], 200);
        }
        return response()->json(['data' => ['error' => "User not found!"]], 404);
    }
}
