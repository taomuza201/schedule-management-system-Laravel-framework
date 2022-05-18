<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::all();
        return view('octuslog.agenda.index',compact('agendas'));
        
    }

    public function book($id)
    {
        $agendas = Agenda::find($id);
     
        return view('octuslog.agenda.book',compact('agendas','id'));
    }
    public function imgUplaod(Request $request)
    {
        $mainImage = $request->file('file');
        $filename = time() . '.' . $mainImage->extension();
        // Image::make($mainImage)->save(public_path('tinymce_images/' . $filename));

        $request->file('file')->move(public_path('agendas/'), $filename);
        return json_encode(['location' => asset('agendas/' . $filename)]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $agenda = Agenda::find($id);
        $agenda->agendas_title = $request->agendas_title;
        $agenda->agendas_description = $request->agendas_description;
        $agenda->save();

        return redirect('agenda');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
