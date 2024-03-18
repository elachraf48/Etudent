<?php

namespace App\Http\Controllers;

use App\Models\ParameterPage;
use Illuminate\Http\Request;
use App\Models\CalendrierSession;
use App\Models\Reclamation;
use Illuminate\Support\Facades\Auth;

class ParameterPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $parameters = ParameterPage::with('user')->get();

        return view('admin.ParameterPage', ['parameters' => $parameters]);
        // //
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
     * @param  \App\Models\ParameterPage  $parameterPage
     * @return \Illuminate\Http\Response
     */
    public function show(ParameterPage $parameterPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParameterPage  $parameterPage
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)

    {
        $id = $request->input('id');
        $name = $request->input('name');
        $date = $request->input('date');
        $statu = $request->input('statu');
    
        $affectedRows = ParameterPage::where('id', $id)->update([
            'NamePage' => $name,
            'LastDate' => $date,
            'Statu' => $statu,
            'updated_at' => now(),
            'user_id'=> Auth::user()->id,

        ]);
    
        if ($affectedRows === 1) {
            // Return a success response
            return response()->json(['success' => true]);
        } else {
            // Return an error response if the record was not updated
            return response()->json(['success' => false, 'error' => 'Record not found or no changes were made.']);
        }

        //return redirect()->route('parameterPage')->with('success', 'Parameter updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ParameterPage  $parameterPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ParameterPage $parameterPage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParameterPage  $parameterPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParameterPage $parameterPage)
    {
        //
    }
}
