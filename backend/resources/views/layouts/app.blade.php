<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/treeview.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery.min.js')}}"></script>

    <link href="{{asset('css/sweetalert2.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/sweetalert2.all.min.js')}}"></script>

    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>

    <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>
<body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('/') }}">E-Commerce</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="@if(Route::currentRouteName() == "category") active @endif"><a href="{{ route('category') }}">Category</a></li>
            <li><a href="{{ route('product') }}">Product</a></li>
          </ul>
        </div>
      </nav>
	<div class="container">     
		{{-- <div class="panel panel-primary"> --}}
            @yield('content')
        {{-- </div> --}}
    </div>
    <script src="{{asset('js/treeview.js')}}"></script>

</body>
</html>