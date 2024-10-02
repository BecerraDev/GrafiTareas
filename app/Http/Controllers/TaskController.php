<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon; // Asegúrate de importar Carbon
use Illuminate\Support\Facades\Response;



class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */public function index(): View
{
    // Contar tareas por estado
    $pendientes = Task::where('status', 'Pendiente')->count();
    $progreso = Task::where('status', 'En Progreso')->count();
    $completadas = Task::where('status', 'Completada')->count();

    // Obtener tareas por mes
    $tareasPorMes = Task::selectRaw('MONTH(due_date) as mes, status, COUNT(*) as total')
        ->whereYear('due_date', Carbon::now()->year) // Filtra por el año actual
        ->groupBy('mes', 'status')
        ->orderBy('mes')
        ->get();

    // Inicializa los arrays para almacenar los conteos por mes
    $pendientesPorMes = array_fill(1, 12, 0);
    $progresoPorMes = array_fill(1, 12, 0);
    $completadasPorMes = array_fill(1, 12, 0);

    // Procesa los resultados para llenar los arrays de conteo por mes
    foreach ($tareasPorMes as $tarea) {
        if ($tarea->status === 'Pendiente') {
            $pendientesPorMes[$tarea->mes] = $tarea->total;
        } elseif ($tarea->status === 'En Progreso') {
            $progresoPorMes[$tarea->mes] = $tarea->total;
        } elseif ($tarea->status === 'Completada') {
            $completadasPorMes[$tarea->mes] = $tarea->total;
        }
    }

    // Extrae datos de la base de datos y lo ordena de último a primero
    $tasks = Task::latest()->paginate(6);

    // Obtener la fecha actual
    $today = \Carbon\Carbon::now();

    $expiradasCount = 0;
    $vigentesCount = 0;


    // Crear un array para almacenar los resultados de comparación
    $comparisonResults = [];

    // Comparar las fechas de cada tarea
    foreach ($tasks as $task) {
        $dueDate = \Carbon\Carbon::parse($task->due_date);

        if ($dueDate > $today) {
            $comparisonResults[$task->id] = " Vigente.";
            $vigentesCount++;
        } elseif ($dueDate < $today) {
            $comparisonResults[$task->id] = " Expirado.";
            $expiradasCount++;

        } else {
            $comparisonResults[$task->id] = " Termina hoy.";
            $vigentesCount++;
        }
    }

    $chartData = [
        'expiradas' => $expiradasCount,
        'vigentes' => $vigentesCount,
    ];
    

    // Obtiene vista index
    return view('index', compact('pendientes', 'progreso', 'completadas', 'tasks', 'pendientesPorMes', 'progresoPorMes', 'completadasPorMes', 'comparisonResults',  'chartData'));
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
    

     public function show(Task $task)   {
    // Extraer los valores de la tarea

    
    // Comparar fechas utilizando la instancia de la tarea
    $title = $task->title;
    $description = $task->description;
    $status = $task->status;

    // Pasar el modelo y los resultados a la vista
    return view('tasks.show', compact('task'));
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

    public function exportToCsv()
    {
        // Obtener todas las tareas
        $tasks = Task::all();

        // Nombre del archivo
        $fileName = 'tasks.csv';

        // Crear la salida CSV
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ];

        // Definir el contenido del CSV
        $columns = ['ID', 'Nombre', 'Descripción', 'Fecha de Creación', 'Fecha de Actualización'];

        $callback = function () use ($tasks, $columns) {
            $file = fopen('php://output', 'w');
            
            // Insertar los nombres de las columnas
            fputcsv($file, $columns);

            // Insertar los datos
            foreach ($tasks as $task) {
                fputcsv($file, [
                    $task->id,
                    $task->name,
                    $task->description,
                    $task->created_at,
                    $task->updated_at,
                ]);
            }

            fclose($file);
        };

        // Devolver la respuesta con el archivo CSV
        return Response::stream($callback, 200, $headers);
    }


}
