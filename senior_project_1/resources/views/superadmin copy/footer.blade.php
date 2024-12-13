<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="at-pro-admin-template-master/index.js"></script>
<!-- end import script -->
<body class="dark-mode"> <!-- Add this class when dark mode is activated -->
    <div class="wrapper">
      
        <!-- Footer Section -->
        <div class="footer" style="background-color: #e5e5e5; color: #fff; padding: 20px; text-align: center; margin-top: 20px;">
            <p>&copy; 2024 Ethiopian Electricity Billing System. All Rights Reserved.</p>
            <p>Empowering Ethiopia with smarter, sustainable energy solutions.</p>
            <p>Contact us: <a href="mailto:info@ethiopianelectricity.com" style="color: #00aced;">info@ethiopianelectricity.com</a></p>
        </div>
    </div>
  
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // General Chart Example
        const ctx1 = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Sample Data',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
  
        // Energy Usage Chart for Ethiopia
        const ctx2 = document.getElementById('energyUsageChart').getContext('2d');
        const energyUsageChart = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: ['2018', '2019', '2020', '2021', '2022'],
                datasets: [{
                    label: 'Energy Usage (GWh)',
                    data: [5000, 5200, 5500, 5800, 6000],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        title: {
                            display: true,
                            text: 'Energy Usage (GWh)'
                        },
                        beginAtZero: false
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Year'
                        }
                    }
                }
            }
        });
    </script>
  </body>
  