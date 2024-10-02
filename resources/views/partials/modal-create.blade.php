
<a target="_blank" rel="nofollow" href="#" data-toggle="modal" data-target="#createRequestModal">Agregar una nueva actividad &rarr;</a>
    
<!-- Modal -->
<div class="modal fade" id="createRequestModal" tabindex="-1" role="dialog" aria-labelledby="createRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createRequestModalLabel">Nueva Actividad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title"> Titulo </label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                    </div>

                    <div class="row"> 
                        <div class="col"> 
                            <div class="form-group">
                                <label for="status">Estado</label>
                                <select name="status" class="form-control" id="">
                                    <option value="">-- Elige el status --</option>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="En progreso">En progreso</option>
                                    <option value="Completada">Completada</option>
                                </select>
                            </div>
                    </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="date">Fecha de creación</label>
                                <input type="date" class="form-control" id="date" name="due_date" required>
                            </div>
                        </div>

                </div>
                    <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                </form>
            </div>
        </div>
    </div>
</div>
