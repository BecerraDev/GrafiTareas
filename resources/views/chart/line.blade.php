<canvas id="taskChart"></canvas>

<script>
    var line = document.getElementById('taskChart').getContext('2d');
    var taskChart = new Chart(line, {
        type: 'line', // Tipo de gráfico
        data: {
            labels: ['Pendiente', 'En Progreso', 'Completadas'], // Etiquetas
            datasets: [{
                label: 'Tareas',
                data: [
                    {{ $pendientes }},
                    {{ $progreso }},
                    {{ $completadas }}
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)', // Color para Pendiente
                    'rgba(54, 162, 235, 0.6)', // Color para En Progreso
                    'rgba(75, 192, 192, 0.6)'  // Color para Completadas
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)', // Color del borde para Pendiente
                    'rgba(54, 162, 235, 1)', // Color del borde para En Progreso
                    'rgba(75, 192, 192, 1)'  // Color del borde para Completadas
                ],
                borderWidth: 1 // Grosor del borde
            }]
        },
        options: {
            cutout: '80%', // Ajustar el tamaño del corte
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom', // Cambiar la posición de la leyenda a 'bottom'
                    labels: {
                        boxWidth: 20, // Ajustar el tamaño de la caja del color
                        padding: 15 // Espaciado entre las etiquetas
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw; // Mostrar etiqueta y valor
                        }
                    }
                }
            }
        }
    });
</script>
