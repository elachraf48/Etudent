<?php
// AdminController.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function processBulkInsert(Request $request)
    {
        $request->validate([
            'data' => 'required_without:file',  // Either 'data' or 'file' is required
            'file' => 'required_without:data|file|mimes:csv,txt|max:2048',
        ]);

        // Check if data is pasted in the textarea
        if ($request->has('data')) {
            $data = $request->input('data');
            // Process the pasted data and insert into the database
        } else {
            // File handling logic (similar to the previous example)
        }

        return redirect()->route('your_dashboard_route')->with('success', 'Data inserted successfully!');
    }
}
