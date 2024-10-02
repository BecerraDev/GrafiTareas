@extends('layouts.base')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Control</h1>
        <a href="{{ route('tasks.export.csv') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>


    </div>



    <!-- Content Row -->
    <div class="row">




        @include('partials.card-body')


        <!-- Earnings (Monthly) Card Example -->









        <!-- Content Row -->


        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Análisis Mensual de Tareas</h6>



                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-area">
                            @include('chart.bar')
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Progreso Circular</h6>



                    </div>

                    <!-- Card Body -->
                    <div class="card-body">


                        <div class="chart-pie pt-4 pb-2">

                            @include('chart.dough')

                        </div>
                    </div>

                </div>

            </div>









        </div>




        <!-- Botón para abrir el modal -->



        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>













        <!-- Content Row -->
        <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Lista de Tareas</h6>
                    </div>
                    <div class="card-body">


                        @foreach ($tasks as $task)
                            <div class="task-progress mb-4" data-status="{{ $task->status }}">
                                <h4 class="small font-weight-bold">
                                    {{ $task->title }}
                                    <span class="float-right">{{ $task->status }}</span>
                                </h4>

                                <!-- Barra de progreso clickeable -->
                                <div class="progress mb-2 task-progress-bar" style="cursor: pointer;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                {{-- Muestra el resultado de comparación --}}
                                <!-- Descripción oculta inicialmente -->
                                <div class="task-description" style="display: none;">
                                    <p> Descripción: {{ $task->description }} </p>
                                    <p> Fecha limite: {{ $task->due_date }} Estado: {{ $comparisonResults[$task->id] }} </p>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>

                                    @include('partials.modal-edit')

                                </div>


                            </div>
                        @endforeach
                        {{ $tasks->links() }}

                    </div>
                </div>





 <!-- Color System -->
 <div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card bg-success text-white shadow">
            <div class="card-body">
                Vigentes:
                <div class="text-white-50 small">{{ $chartData['expiradas'] }}
                    Actividades</div>
            </div>
        </div>
    </div>
 
        
 
    <div class="col-lg-6 mb-4">
        <div class="card bg-danger text-white shadow">
            <div class="card-body">
                Expirados:
                <div class="text-white-50 small"> {{ $chartData['vigentes'] }} Actividades</div>
            </div>
        </div>
    </div>
 </div>









            </div>







            
            <style>
                .task-description {
                    margin-top: 10px;
                    padding: 10px;
                    background-color: #f8f9fa;
                    /* Fondo claro */
                    border: 1px solid #ddd;
                    border-radius: 5px;
                }

                .task-progress-bar {
                    cursor: pointer;
                }

                .task-progress {
                    margin-bottom: 20px;
                }

                .progress {
                    height: 10px;
                }
            </style>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Selecciona todas las barras de progreso de las tareas
                    const taskBars = document.querySelectorAll('.task-progress-bar');

                    taskBars.forEach(bar => {
                        bar.addEventListener('click', function() {
                            // Selecciona el div con la clase "task-description" que sigue a la barra de progreso
                            const description = this.nextElementSibling;
                            // Alterna la visibilidad
                            if (description.style.display === "none" || description.style.display === "") {
                                description.style.display = "block"; // Mostrar descripción
                            } else {
                                description.style.display = "none"; // Ocultar descripción
                            }
                        });
                    });
                });
            </script>








            <div class="col-lg-6 mb-4">

                <!-- Illustrations -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Gráfico de Tareas</h6>
                    </div>
                    <div class="card-body">

                        @include('chart.line')


                    </div>
                </div>




                
                <!-- Approach -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Sobre este proyecto...</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 5rem;"
                                src="https://cdn-icons-png.flaticon.com/512/11189/11189219.png" alt="...">
                        </div>
                        <p> <strong> GrafiTareas </strong> una aplicación web de gestión de tareas que permite a los usuarios crear, editar, eliminar y visualizar el estado de sus tareas de manera intuitiva y eficiente.</p>

                        @include('partials.modal-create')









                    </div>



                    
                </div>











                
            </div>
        
            
        </div>

        
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    @include('partials.footer')
    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

    </div>
@endsection

@section('scripts')
    <!-- Importa el archivo de JavaScript desde la carpeta public -->
    <script src="{{ asset('js/task-progress.js') }}"></script>
@endsection
