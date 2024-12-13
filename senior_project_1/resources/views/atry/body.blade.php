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
                    <p>Notfications Sent</p>
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
                <div class="row" style="display: flex;"> <!-- Added display:flex to ensure both columns have equal height -->
                    <!-- Progress Bar -->
                    <div class="col-8" style="display: flex; flex-direction: column;">
                        <div class="card" style="flex: 1;"> <!-- Ensure the card takes full height -->
                            <div class="card-header">
                                <h3>
                                    Progress bar
                                </h3>
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                            <div class="card-content">
                                <div class="progress-wrapper">
                                    <p>
                                        Less than 1 hour
                                        <span class="float-right">50%</span>
                                    </p>
                                    <div class="progress">
                                        <div class="bg-success" style="width: 50%"></div>
                                    </div>
                                </div>
                                <div class="progress-wrapper">
                                    <p>
                                        1 - 3 hours
                                        <span class="float-right">60%</span>
                                    </p>
                                    <div class="progress">
                                        <div class="bg-primary" style="width:60%"></div>
                                    </div>
                                </div>
                                <div class="progress-wrapper">
                                    <p>
                                        More than 3 hours
                                        <span class="float-right">40%</span>
                                    </p>
                                    <div class="progress">
                                        <div class="bg-warning" style="width:40%"></div>
                                    </div>
                                </div>
                                <div class="progress-wrapper">
                                    <p>
                                        More than 6 hours
                                        <span class="float-right">20%</span>
                                    </p>
                                    <div class="progress">
                                        <div class="bg-danger" style="width:20%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tariff Info -->
                    <div class="col-4" style="display: flex; flex-direction: column;">
                        <div class="card" style="flex: 1;"> <!-- Ensure the card takes full height -->
                            <div class="card-header">
                                <h3>
                                    Tariff Information
                                </h3>
                                <i class="fas fa-ellipsis-h"></i>
                            </div>
                            <div class="card-content">
                                <p><strong>Current Tariff:</strong> 0.10 USD/kWh</p>
                                <p><strong>Peak Tariff:</strong> 0.12 USD/kWh</p>
                                <p><strong>Off-Peak Tariff:</strong> 0.08 USD/kWh</p>
                                <p><strong>Last Updated:</strong> 01/01/2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-m-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Chartjs
                        </h3>
                    </div>
                    <div class="card-content">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
