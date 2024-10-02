
<button target="_blank" class="btn btn-primary" rel="nofollow" class="btn " href="#" data-toggle="modal" data-target="#createRequestModal-{{$task->id}}">
    <i class="fas fa-edit"> </i> Editar
</button>    



<!-- Modal -->
<div class="modal fade" id="createRequestModal-{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="createRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRequestModalLabel">Nueva Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('tasks.update', $task)}}" method="POST">
        
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Tarea:</strong>
                                <input type="text" name="title" class="form-control" placeholder="Tarea" value="{{$task->title}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                            <div class="form-group">
                                <strong>Descripción:</strong>
                                <textarea class="form-control" style="height:150px" name="description" placeholder="Descripción..."> {{$task->description}} </textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                                <strong>Fecha límite:</strong>
                                <input type="date" name="due_date" class="form-control" id="" value={{$task->due_date}}>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                            <div class="form-group">
                                <strong>Estado (inicial):</strong>
                                <select name="status" class="form-control" id="">
                                    <option value="">-- Elige el status --</option>
                                    <option value="Pendiente" @selected("Pendiente" == $task->status)>Pendiente</option>
                                    <option value="En progreso"@selected("En Progreso" == $task->status)>En progreso</option>
                                    <option value="Completada"@selected("Completada" == $task->status)>Completada</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
