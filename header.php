<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PanpacificU Library Attendance System</title>
    
    <!-- Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            position: relative;
            overflow: hidden;
        }
        
        .admin-button {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }
        
        .btn-admin {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            text-decoration: none;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(66, 133, 244, 0.3);
        }
        
        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(66, 133, 244, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .btn-admin .material-icons {
            font-size: 18px;
        }
        
        .admin-text {
            font-size: 13px;
        }
        
        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4285f4, #34a853, #fbbc05, #ea4335);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo img {
            max-width: 80px;
            height: auto;
            border-radius: 50%;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }
        
        .title {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .title h1 {
            color: #1a1a1a;
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .title p {
            color: #666;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 24px;
            position: relative;
        }
        
        .form-control {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #4285f4;
            background: white;
            box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.1);
        }
        
        .form-control::placeholder {
            color: #999;
        }
        
        .btn {
            width: 100%;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(66, 133, 244, 0.3);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin: 20px 0;
            border: none;
            font-weight: 500;
        }
        
        .alert-success {
            background: #e8f5e8;
            color: #2e7d32;
            border-left: 4px solid #4caf50;
        }
        
        .alert-danger {
            background: #ffebee;
            color: #c62828;
            border-left: 4px solid #f44336;
        }
        
        .datetime {
            text-align: center;
            margin-top: 30px;
            padding: 20px;
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }
        
        .datetime p {
            color: white;
            margin: 0;
        }
        
        #date {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 4px;
        }
        
        #time {
            font-size: 24px;
            font-weight: 700;
        }
        
        .material-icons {
            font-size: 20px;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .container {
                padding: 30px 20px;
                border-radius: 16px;
            }
            
            .admin-button {
                top: 15px;
                right: 15px;
            }
            
            .btn-admin {
                padding: 6px 12px;
                font-size: 12px;
            }
            
            .admin-text {
                display: none;
            }
            
            .title h1 {
                font-size: 20px;
            }
            
            .form-control {
                padding: 14px 16px;
                font-size: 16px;
            }
            
            .btn {
                padding: 14px;
                font-size: 16px;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                padding: 20px 15px;
            }
            
            .title h1 {
                font-size: 18px;
            }
            
            .form-control {
                padding: 12px 14px;
            }
        }
        
        /* Loading Animation */
        .loading {
            display: none;
            text-align: center;
            margin: 20px 0;
        }
        
        .spinner {
            border: 3px solid #f3f3f3;
            border-top: 3px solid #4285f4;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    
    <script>
        $(function() {
            $("#employee").autocomplete({
                source: 'search.php',
                minLength: 2,
                classes: {
                    "ui-autocomplete": "ui-autocomplete-custom"
                }
            });
        });
    </script>
</head>