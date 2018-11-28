<?php

namespace App\Http\Controllers;

use App\Services\LeadService;
use Illuminate\Http\Request;


class LeadController extends Controller
{

    private $leedService;

    function __construct()
    {
        $this->leedService = LeadService::get();
    }


    public function index()
    {
       return $this->leedService->listAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       return $this->leedService->register($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->leedService->show($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //dd($request->toArray());
        return $this->leedService->update($request,$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->leedService->delete($id);
    }
}


