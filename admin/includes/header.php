<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PanpacificU Library Attendance System - Admin</title>
    
    <!-- Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/ui-lightness/jquery-ui.css">
    <!-- Bootstrap Daterangepicker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- Bootstrap Timepicker -->
    <link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            background: #f5f5f5;
            color: #333;
        }
        
        .navbar {
            background: linear-gradient(135deg, #4285f4, #34a853);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-left: 280px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 999;
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 1.5rem;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }
        
        .navbar .btn-link {
            color: white !important;
            border: none;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 8px 12px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .navbar .btn-link:hover {
            background: rgba(255,255,255,0.2);
            transform: scale(1.05);
        }
        
        .navbar .btn-link:focus {
            box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
        }
        
        .sidebar {
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
            border-right: 1px solid #e9ecef;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            overflow-x: hidden;
            backdrop-filter: blur(10px);
            display: flex;
            flex-direction: column;
        }
        
        /* Custom scrollbar for sidebar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 2px;
        }
        
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
        
        .sidebar.collapsed {
            width: 80px;
        }
        
        .sidebar.collapsed .sidebar-menu span:not(.material-icons) {
            display: none;
        }
        
        .sidebar.collapsed .menu-header {
            display: none;
        }
        
        .sidebar.collapsed .sidebar-menu a {
            justify-content: center;
            padding: 15px 10px;
        }
        
        .sidebar.collapsed .sidebar-brand {
            display: none;
        }
        
        .sidebar.collapsed .sidebar-header {
            justify-content: center;
        }
        
        .navbar.expanded {
            margin-left: 80px;
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
        }
        
        .sidebar-brand {
            font-weight: 600;
            color: #2d3748;
            font-size: 1.1rem;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            color: #5a6c7d;
            padding: 8px;
            border-radius: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .sidebar-toggle:hover {
            background: rgba(66, 133, 244, 0.1);
            color: #4285f4;
        }
        
        .sidebar-menu {
        list-style: none;
            padding: 15px 0;
            margin: 0;
            flex: 1;
        }
        
        .sidebar-menu li {
            margin: 2px 0;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #5a6c7d;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 0 30px 30px 0;
            margin-right: 15px;
            font-weight: 500;
        position: relative;
        }
        
        .sidebar-menu a:hover {
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            transform: translateX(8px);
            box-shadow: 0 4px 12px rgba(66, 133, 244, 0.3);
        }
        
        .sidebar-menu a.active {
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            transform: translateX(8px);
            box-shadow: 0 4px 12px rgba(66, 133, 244, 0.3);
        }
        
        .sidebar-menu a.active::before {
            content: '';
        position: absolute;
            left: -15px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: #4285f4;
            border-radius: 2px;
        }
        
        .sidebar-menu .material-icons {
            margin-right: 12px;
            font-size: 22px;
            transition: all 0.3s ease;
        }
        
        .menu-header {
            padding: 25px 20px 15px 20px;
            font-size: 11px;
            font-weight: 700;
            color: #8b9dc3;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 10px;
        }
        
        .menu-header .material-icons {
            margin-right: 8px;
            font-size: 16px;
            opacity: 0.7;
        }
        
        .main-content {
            margin-left: 280px;
            padding: 30px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .main-content.expanded {
            margin-left: 80px;
        }
        
        .content {
            flex: 1;
            padding-bottom: 20px;
        }
        
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border: none;
            margin-bottom: 30px;
        }
        
        .card-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 15px 15px 0 0;
            border-bottom: none;
            padding: 20px 25px;
        }
        
        .card-title {
            color: #333;
            font-weight: 500;
            margin: 0;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 10px 20px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        .btn .material-icons {
            font-size: 18px;
        }
        
        /* Search box styling */
        .input-group-text {
            background: #f8f9fa;
            border-color: #dee2e6;
        }
        
        .form-control:focus {
            border-color: #4285f4;
            box-shadow: 0 0 0 0.2rem rgba(66, 133, 244, 0.25);
        }
        
        .input-group:focus-within .input-group-text {
            border-color: #4285f4;
            background: #f0f7ff;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #4285f4, #34a853);
            border: none;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(66, 133, 244, 0.3);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #34a853, #0f9d58);
            border: none;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #ea4335, #d33b2c);
            border: none;
        }
        
        .table {
            border-radius: 10px;
            overflow: hidden;
            table-layout: auto;
            width: 100%;
        }
        
        .table th,
        .table td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }
        
        .table th {
            white-space: nowrap;
        }
        
        .table td {
            word-wrap: break-word;
        }
        
        .table thead th {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: none;
            font-weight: 500;
            color: #333;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa;
            transform: scale(1.01);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #e8f5e8, #c8e6c9);
            color: #2e7d32;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
        }
        
        .stats-card {
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(66, 133, 244, 0.3);
        height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        
        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            line-height: 1;
        }
        
        .stats-card p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 15px;
        }
        
        .stats-card .btn {
            margin-top: auto;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        .material-icons {
            font-size: 24px;
        }
        
        /* DataTables alignment fixes */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            margin: 0;
            padding: 0;
        }
        
        .dataTables_wrapper .dataTables_length {
            float: left;
            margin-bottom: 15px;
        }
        
        .dataTables_wrapper .dataTables_filter {
            float: right;
            text-align: right;
            margin-bottom: 15px;
        }
        
        .dataTables_wrapper .dataTables_filter input {
            margin-left: 10px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            font-size: 14px;
        }
        
        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: #4285f4;
            box-shadow: 0 0 0 0.2rem rgba(66, 133, 244, 0.25);
            outline: none;
        }
        
        .dataTables_wrapper .dataTables_info {
            float: left;
            margin-top: 15px;
            color: #6c757d;
            font-size: 14px;
        }
        
        .dataTables_wrapper .dataTables_paginate {
            float: right;
            text-align: right;
            margin-top: 15px;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 8px 12px;
            margin: 0 2px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            color: #4285f4;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #4285f4;
            color: white;
            border-color: #4285f4;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4285f4;
            color: white;
            border-color: #4285f4;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
            color: #6c757d;
            cursor: not-allowed;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            background: transparent;
            color: #6c757d;
            border-color: #dee2e6;
        }
        
        /* Clear floats */
        .dataTables_wrapper:after {
            content: "";
            display: table;
            clear: both;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
                z-index: 1050;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }
            
            .main-content.expanded {
                margin-left: 0;
            }
            
            .stats-card h3 {
                font-size: 2rem;
            }
            
            .navbar {
                margin-left: 0;
                padding-left: 20px;
            }
            
            .navbar.expanded {
                margin-left: 0;
            }
            
            /* DataTables responsive adjustments */
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none;
                text-align: left;
                margin-bottom: 10px;
            }
            
            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                margin-left: 0;
                margin-top: 5px;
            }
            
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                float: none;
                text-align: center;
                margin-top: 10px;
            }
        }
        
        /* Ensure footer doesn't get blocked */
        body {
            margin: 0;
            padding: 0;
        }
        
        .footer {
            margin-left: 280px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .footer.expanded {
            margin-left: 80px;
        }
        
        @media (max-width: 768px) {
            .footer {
                margin-left: 0;
            }
            
            .footer.expanded {
                margin-left: 0;
            }
        }
        
        /* Loading Animation */
        .loading {
            display: none;
            text-align: center;
            padding: 20px;
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
</head>