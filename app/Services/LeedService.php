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
        $leeds->name         = $request->name;
        $leeds->specialty    = $request->specialty;
        $leeds->cellPhone    = $request->cellPhone;
        $leeds->description  = $request->description;
        $leeds->photograph   = $request->photograph;

        if (!$leeds->save()) {

            return response()->json(['data' => ['error' => "not authorized!"]], 401);
        }
        $email = new EmailService();
        $email->submit();
        return response()->json(['data' => $leeds], 200);


    }


    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
        //
    }


    public function delete($id)
    {
        //
    }
}