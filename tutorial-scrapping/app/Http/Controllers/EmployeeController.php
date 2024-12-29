<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::user() == null) {
            return abort(401);
        }

        $records = Employee::all();

        $recordsTotal = $records->count();

        $orderColumn = 'id';
        $orderDir = 'asc';
        if ($request->order != null) {
            if ($request->order[0]['dir'] == 'asc') {
                $orderDir = 'asc';
            } else {
                $orderDir = 'desc';
            }
            if ($request->order[0]['column'] == '0') {
                $orderColumn = 'name';
            } else if ($request->order[0]['column'] == '1') {
                $orderColumn = 'email';
            }
        }

        $searchkeyword = $request->search['value'];
        if ($searchkeyword != null) {
            $records = $records->filter(function ($q) use (
                $searchkeyword
            ) {
                return Str::contains(strtolower($q->name), strtolower($searchkeyword)) ||
                    Str::contains(strtolower($q->email), strtolower($searchkeyword));
            });
        }
        $recordsFiltered = $records->count();

        if ($orderDir == 'asc') {
            $records = $records->sortBy($orderColumn);
        } else {
            $records = $records->sortByDesc($orderColumn);
        }

        if ($request->length != -1) {
            $records = $records->skip($request->start)
                ->take($request->length);
        }

        $recordsArray = array();
        $i = $request->start + 1;

        foreach ($records as $record) {
            $recordData = array();
            $recordData["id"] = $record->id;
            $recordData["name"] = $record->name;
            $recordData["email"] = $record->email;

            $recordsArray[] = $recordData;
            $i++;
        }

        return json_encode([
            "draw" => $request->draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $recordsArray
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
