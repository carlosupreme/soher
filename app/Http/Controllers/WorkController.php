<?php

namespace App\Http\Controllers;

use App\Models\Work;

class WorkController extends Controller
{

    public function index()
    {
        if (\Auth::user()->hasAnyPermission('work.index')) {
            return view('work.index');
        }

        abort(404);
    }

    public function create()
    {
        if (\Auth::user()->hasAnyPermission('work.create')) {
            return view('work.create');
        }

        abort(404);
    }

    public function show(Work $trabajo)
    {
        if (\Auth::user()->hasAnyPermission('work.show')) {
            return $trabajo;
        }

        abort(404);
    }

    public function edit(Work $work)
    {
        //
    }

    public function assignedIndex()
    {
        return "lista de asignadas";
    }

    public function assignedShow(Work $work)
    {
        return $work;
    }

}
