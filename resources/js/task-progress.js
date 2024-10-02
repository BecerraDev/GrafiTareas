// task-progress.js

document.addEventListener('DOMContentLoaded', function () {
    // Busca todos los elementos con la clase 'task-progress'
    let tasks = document.querySelectorAll('.task-progress');

    tasks.forEach(function (task) {
        let status = task.getAttribute('data-status');
        let progressBar = task.querySelector('.progress-bar');

        // Cambia el progreso y color dependiendo del estado
        if (status === 'Pendiente') {
            progressBar.style.width = '20%';
            progressBar.classList.add('bg-danger');
        } else if (status === 'En Progreso') {
            progressBar.style.width = '50%';
            progressBar.classList.add('bg-warning');
        } else if (status === 'Completada') {
            progressBar.style.width = '100%';
            progressBar.classList.add('bg-success');
        }
    });
});
