<?php

namespace App\Http\Controllers;

use App\Models\CalendrierSession;
use Illuminate\Http\Request;

class CalendrierSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function showAllSessionsDropdown()
    {
        $sessions = CalendrierSession::all();
    
        return view('admin.Calendrier_modules')
        ->with('sessions', $sessions);
        // ->with('dropdownView', view('calendrier_sessions.dropdown')->with('sessions', $sessions));
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
     * @param  \App\Models\CalendrierSession  $calendrier_session
     * @return \Illuminate\Http\Response
     */
    public function show(CalendrierSession $calendrier_session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CalendrierSession  $calendrier_session
     * @return \Illuminate\Http\Response
     */
    public function edit(CalendrierSession $calendrier_session)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CalendrierSession  $calendrier_session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalendrierSession $calendrier_session)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CalendrierSession  $calendrier_session
     * @return \Illuminate\Http\Response
     */
    public function destroy(CalendrierSession $calendrier_session)
    {
        //
    }
}
