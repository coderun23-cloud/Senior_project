<body class="dark-mode"> <!-- Add this class when dark mode is activated -->
  <div class="wrapper">
      <div class="row" style="color: black;">
          <!-- Counter Cards -->
          <div class="col-3 col-m-6 col-sm-6">
              <div class="counter bg-info" style="color: black;"> <!-- Changed to bg-info for consistency -->
                  <p>
                      <i class="fas fa-users"></i>
                  </p>
                  <h3>10+</h3>
                  <p>Admin</p>
              </div>
          </div>
          <div class="col-3 col-m-6 col-sm-6">
              <div class="counter bg-info" style="color: black;"> <!-- Changed to bg-info for consistency -->
                  <p>
                      <i class="fas fa-check-circle"></i>
                  </p>
                  <h3>100+</h3>
                  <p>Notifications Sent</p>
              </div>
          </div>
          <div class="col-3 col-m-6 col-sm-6">
              <div class="counter bg-info" style="color: black;"> <!-- Changed to bg-info for consistency -->
                  <p>
                      <i class="fas fa-check-circle"></i>
                  </p>
                  <h3>10+</h3>
                  <p>Tariff</p>
              </div>
          </div>
          <div class="col-3 col-m-6 col-sm-6">
              <div class="counter bg-info" style="color: black;"> <!-- Changed to bg-info for consistency -->
                  <p>
                      <i class="fas fa-users"></i>
                  </p>
                  <h3>100+</h3>
                  <p>Meter Reader</p>
              </div>
          </div>
      </div>

      <div class="row">
          <!-- Progress Bar and Tariff Info -->
          <div class="col-8 col-m-12 col-sm-12" style="width: 100%;">
          </div>
      </div>

      <div class="row">
          <div class="col-6 col-m-12 col-sm-12">
              <div class="card">
                  <div class="card-header">
                      <h3>
                          Energy Usage in Ethiopia
                      </h3>
                  </div>
                  <div class="card-content">
                      <canvas id="energyUsageChart"></canvas>
                  </div>
              </div>
          </div>
          <div class="col-6 col-m-12 col-sm-12">
              <div class="card">
                  <div class="card-header">
                      <h3>
                          General Chart
                      </h3>
                  </div>
                  <div class="card-content">
                      <canvas id="myChart"></canvas>
                  </div>
              </div>
          </div>
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
