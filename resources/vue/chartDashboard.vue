<template>
    <div>
        <canvas id="chart"></canvas>
    </div>
</template>
<script>
import Chart from 'chart.js/auto';
export default {
    mounted() {
        this.createChart();
    },
    methods: {
        createChart() {
            const canvas = document.getElementById('chart');
            const data = {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'],
                datasets: [{
                    label: 'Pending Users',
                    data: [2, 9, 5, 10, 15],
                    backgroundColor: 'rgb(50, 205, 50, 0.2)',
                    borderColor: 'rgb(34, 139, 34, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Baned Users',
                    data: [5, 7, 10, 8, 12],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            };
            const options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };
            const chart = new Chart(canvas, {
                type: 'line',
                data: data,
                options: options
            });
        }
    }
}
</script>
