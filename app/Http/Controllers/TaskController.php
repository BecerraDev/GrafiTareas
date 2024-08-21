<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): view
    {
        //* extrae datos de la base de datos y lo ordena de ultimo a primero*/
        $tasks = Task::latest()->paginate(3);
        //* obtiene vista index

        //* paginate es usado cuando se conecta con bootstrap
        return view('index', ['tasks'=> $tasks]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        //* usado para validar*/
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        //** pinta el requerimiento */
        Task::create($request->all());
        //* retorna a pagina index */
        return redirect()-> route('tasks.index')->with('success', 'Nueva tarea creada exitosamente!');
        //* */


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task):View
    {
        return view('edit', ['task' => $task]);

        /** para mandar datos de la tarea hacia la vista se tiene que escribir de la siguiente forma 
         * ['task' => $task]
         */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);
        $task->update($request->all());
        return redirect()-> route('tasks.index')->with('success', 'Nueva tarea actualizada exitosamente!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();
        return redirect()-> route('tasks.index')->with('success', 'Nueva tarea eliminada exitosamente!');

    }
}
