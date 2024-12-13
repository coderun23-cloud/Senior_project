<!DOCTYPE html>
<html lang="en">
<head>
    @include('meterreader.css')
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Meter Reading Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .title {
            font-size: 36px;
            font-weight: 700;
            color: #000;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .btn-group .btn {
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-group .btn.active {
            border: #5d5d5d solid 3px;
            color: white;
        }
        .card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            background: #e1e8f4;
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
        .form-control:focus {
            border-color: #3948bb;
            outline: none;
            background: #fff;
        }
        .hidden {
            display: none;
        }
        #videoElement {
            width: 100%;
            height: 100%;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        #camera-container {
            text-align: center;
            position: relative;
            overflow: hidden;
            width: 50%;
            height: 50%;
        }
        #rotateLeftButton, #rotateRightButton {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 50%;
            cursor: pointer;
        }
        #rotateRightButton {
            right: 10px;
            left: auto;
        }
        #captureButton, #stopButton, #startButton {
            margin-top: 20px;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
        }
        #stopButton {
            background-color: #dc3545;
            color: white;
        }
        #stopButton:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        @include('meterreader.sidebar')
        <div class="main">
            @include('meterreader.header')
            <br>
    <div class="container">
        <div class="title">
            <i style="color: #3498db;" class="fas fa-tachometer-alt"></i> Meter Reading Registration Form
        </div>

        <!-- Toggle Buttons for Switching Between Manual and Scanning -->
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-secondary" id="manualTabBtn">Manual Bill Registration</button>
            <button type="button" class="btn btn-secondary" id="scanTabBtn">Scan Bill Registration</button>
        </div>
<br>
<br>

        <!-- Bill Registration Forms - Hidden by Default, Shown Based on Tab Selection -->
        <div class="row">
            <!-- Manual Bill Registration Form -->
            <form action="{{ url('manual_reading') }}" method="post" class="col hidden" id="manualSection">
                @csrf
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
                @elseif (session('alert'))
                    <div class="alert alert-danger alert-dismissible">{{ session('alert') }}</div>
                @endif
                    <div class="card-header">
                        <h5>Manual Bill Registration</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter customer name">
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter bill amount">
                        </div>
                        <button type="submit" class="btn btn-secondary">Register Bill</button>
                    </div>
                </div>
            </form>

            <!-- Scan Bill Registration Form -->
            <div class="col hidden" id="scanSection">
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible">{{ session('success') }}</div>
                @elseif (session('alert'))
                    <div class="alert alert-danger alert-dismissible">{{ session('alert') }}</div>
                @endif
                    <div class="card-header">
                        <h5>Scan Bill Registration</h5>
                    </div>
                    <div class="card-body">
                        <div id="camera-container">
                            <video id="videoElement" autoplay></video>
                            <button id="rotateLeftButton">◁</button>
                            <button id="rotateRightButton">▷</button>
                            <button id="startButton" class="btn btn-secondary">Start Scanning</button>
                            <button id="stopButton" class="hidden">Stop Scanning</button>
                            <button id="captureButton" class="hidden">Scan Reading</button>
                        </div>
                        <div id="ocr-result" class="hidden">
                            <h3>OCR Result:</h3>
                            <p id="ocrAmount">Amount: Not found</p>
                        </div>
                        <div id="savedNumber" class="hidden">
                            <p><strong>Saved Number from Scan:</strong> <span id="savedAmount"></span></p>
                        </div>
                        <button id="discardButton" class="hidden">Discard</button>

                        <form id="saveForm" method="POST" action="{{ url('save-bill-reading') }}">
                            @csrf
                            <input type="text" name="customer_name" id="formCustomerName" class="form-control" placeholder="Enter customer name" required>
                            <input type="text" name="scanned_amount" id="scanned_amount" class="form-control" placeholder="Amount will be displayed here" readonly><br><br>
                            <button type="submit" id="saveButton" class="btn btn-secondary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    @include('meterreader.footer')
</div>
</div>
    <script>

    // Get references to the buttons and sections
    const manualTabBtn = document.getElementById('manualTabBtn');
    const scanTabBtn = document.getElementById('scanTabBtn');
    const manualSection = document.getElementById('manualSection');
    const scanSection = document.getElementById('scanSection');
    const startButton = document.getElementById('startButton');
    const stopButton = document.getElementById('stopButton');
    const captureButton = document.getElementById('captureButton');
    const videoElement = document.getElementById('videoElement');
    const ocrResult = document.getElementById('ocr-result');
    const ocrAmount = document.getElementById('ocrAmount');
    const savedNumber = document.getElementById('savedNumber');
    const savedAmount = document.getElementById('savedAmount');
    const saveButton = document.getElementById('saveButton');
    const discardButton = document.getElementById('discardButton');
    let mediaStream = null;
    let currentAmount = null;

    // Set initial active state for buttons
    manualTabBtn.classList.add('active');
    scanTabBtn.classList.remove('active');
    manualSection.classList.remove('hidden');
    scanSection.classList.add('hidden');

    // Toggle the manual section active state when clicked
    manualTabBtn.addEventListener('click', function() {
        manualTabBtn.classList.add('active');
        scanTabBtn.classList.remove('active');
        manualSection.classList.remove('hidden');
        scanSection.classList.add('hidden');
    });

    // Toggle the scan section active state when clicked
    scanTabBtn.addEventListener('click', function() {
        scanTabBtn.classList.add('active');
        manualTabBtn.classList.remove('active');
        scanSection.classList.remove('hidden');
        manualSection.classList.add('hidden');
    });

    // Start Camera function
    startButton.addEventListener('click', function() {
        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
            .then(function(stream) {
                mediaStream = stream;
                videoElement.srcObject = stream;
                startButton.classList.add('hidden');
                stopButton.classList.remove('hidden');
                captureButton.classList.remove('hidden');
            })
            .catch(function(err) {
                console.log("Error accessing camera: " + err);
            });
    });

    // Stop Camera function
    stopButton.addEventListener('click', function() {
        if (mediaStream) {
            const tracks = mediaStream.getTracks();
            tracks.forEach(track => track.stop());
            videoElement.srcObject = null;
            startButton.classList.remove('hidden');
            stopButton.classList.add('hidden');
            captureButton.classList.add('hidden');
        }
    });

    // Capture button logic
    captureButton.addEventListener('click', function() {
        const canvas = document.createElement('canvas');
        canvas.width = videoElement.videoWidth;
        canvas.height = videoElement.videoHeight;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

        // Convert canvas to image data URL (base64)
        const imageUrl = canvas.toDataURL('image/png');

        // Call Google Vision API
        callGoogleVisionAPI(imageUrl);
    });

    // Function to call Google Vision API
    function callGoogleVisionAPI(imageUrl) {
        const apiKey = 'YOUR_GOOGLE_CLOUD_API_KEY'; // Replace with your actual API key

        fetch(`https://vision.googleapis.com/v1/images:annotate?key=${apiKey}`, {
            method: 'POST',
            body: JSON.stringify({
                requests: [{
                    image: {
                        content: imageUrl.split(',')[1] // Only the base64 part
                    },
                    features: [{
                        type: "DOCUMENT_TEXT_DETECTION"
                    }]
                }]
            }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const text = data.responses[0].fullTextAnnotation.text;
            console.log(text);
            const amount = extractAmount(text);

            if (amount) {
                ocrAmount.textContent = `Amount: ${amount}`;
                savedAmount.textContent = amount;
                document.getElementById('scanned_amount').value = amount;
                ocrResult.classList.remove('hidden');
                savedNumber.classList.remove('hidden');
                currentAmount = amount;
                discardButton.classList.remove('hidden'); // Show discard button after scanning
            } else {
                ocrAmount.textContent = "Amount not found.";
            }
        })
        .catch(error => {
            console.error('Error calling Google Vision API:', error);
        });
    }

    // Function to extract the amount (simplified regex)
    function extractAmount(text) {
        const regex = /\b\d+(\.\d{1,2})?\b/;
        const match = text.match(regex);
        return match ? match[0] : null;
    }

    // Discard button
    discardButton.addEventListener('click', function() {
        ocrResult.classList.add('hidden');
        savedNumber.classList.add('hidden');
        currentAmount = null;
        discardButton.classList.add('hidden'); // Hide discard button after discarding
        startButton.classList.remove('hidden'); // Re-enable start scanning
    });


    </script>
</body>
</html>
