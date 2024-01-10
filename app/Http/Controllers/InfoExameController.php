<?php

namespace App\Http\Controllers;

use App\Models\InfoExame;
use Illuminate\Http\Request;

class InfoExameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('reqlamation.next');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InfoExame  $infoExame
     * @return \Illuminate\Http\Response
     */
    public function show(InfoExame $infoExame)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InfoExame  $infoExame
     * @return \Illuminate\Http\Response
     */
    public function edit(InfoExame $infoExame)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfoExame  $infoExame
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InfoExame $infoExame)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfoExame  $infoExame
     * @return \Illuminate\Http\Response
     */
    public function destroy(InfoExame $infoExame)
    {
        //
    }
}
