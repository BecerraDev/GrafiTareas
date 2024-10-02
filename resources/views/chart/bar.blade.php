<canvas id="taskChart3"></canvas>

<script>
    // Comprobar si los datos están correctamente presentes en la vista

    const barr = document.getElementById('taskChart3').getContext('2d');
    const myChart = new Chart(barr, {
      type: 'bar',
      data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        datasets: [
          {
            label: 'Pendientes',
            data: @json(array_values($pendientesPorMes)), // Aquí convierte el array a JSON
            backgroundColor: 'rgba(255, 99, 132, 0.6)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
          },
          {
            label: 'En Progreso',
            data: @json(array_values($progresoPorMes)), // Convierte el array a JSON
            backgroundColor: 'rgba(255, 206, 86, 0.6)',
            borderColor: 'rgba(255, 206, 86, 1)',
            borderWidth: 1
          },
          {
            label: 'Completadas',
            data: @json(array_values($completadasPorMes)), // Convierte el array a JSON
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
          }
        ]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>