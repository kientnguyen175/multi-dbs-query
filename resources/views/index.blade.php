<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Index</title>
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- AdminLTE Theme Style -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/adminlte.min.css') }}">
    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed" 
    ng-app="sqlModule" 
    ng-controller="SqlController">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" 
                src="{{ asset('images/logo.png') }}" 
                height="60" 
                width="60">
        </div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" 
                        data-widget="pushmenu" 
                        href="#" 
                        role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Home</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" 
                        data-widget="fullscreen" 
                        href="#" 
                        role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img class="img-circle elevation-2" src="{{ asset('images/logo.png') }}">
                    </div>
                    <div class="info">
                        <a class="d-block" href="#">Megaads</a>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" 
                            type="search" 
                            placeholder="Search" 
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" 
                        data-widget="treeview" 
                        role="menu" 
                        data-accordion="false">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="nav-icon fas fa-database"></i>
                                <p>Multiple DBs Query</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="content-wrapper">
            <br>
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3>Multiple DBs Query</h3>
                        </div>
                        <div class="card-body">
                            <form ng-submit="execute()">
                                <div class="form-group">
                                    <label>Select Databases <span class="required">*</span></label>
                                    <select class="select2bs4" 
                                        multiple="multiple" 
                                        ng-model="rdbmss" 
                                        required>
                                        @foreach (config('rdbmss') as $rdbms => $database)
                                            <option value="{{ $rdbms }}">{{ $database }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>SQL Command <span class="required">*</span></label>
                                    <textarea class="form-control" 
                                        rows="8" 
                                        ng-model="sql" 
                                        required></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-block btn-outline-primary"  
                                        type="submit" 
                                        ng-click="log = null">
                                        Execute
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <label>Log</label>
                                <div id="log" ng-bind-html="log"></div>
                            </div>
                        </div>
                        <div class="overlay" ng-show="loading == true">
                            <i class="fas fa-2x fa-spinner fa-spin"></i>
                        </div>
                    </div>
                </div>
            </section>
            <br>
        </div>
        <footer class="main-footer">
            <strong>&copy; Megaads</strong>
        </footer>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('bower_components/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('bower_components/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('bower_components/admin-lte/plugins/select2/js/select2.full.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <!-- AngularJS -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>
    <script src="{{ asset('bower_components/angular-sanitize/angular-sanitize.min.js') }}"></script>
    <!-- Custom Script -->
    <script src="{{ asset('js/select2.js') }}"></script>
    <script src="{{ asset('js/index.js') }}"></script>
</body>
</html>
