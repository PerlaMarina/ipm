<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- TODO  -->
      <meta name="author" content="Ricardo Meza<ingricadomeza@gmail.com>" />
      <link rel="icon" type="image/x-icon" href="favicon.ico">

    <title>MIP </title>
    
     {{ HTML::style('bootstrap.css') }}
     {{ HTML::script('jquery-1.11.1.min.js') }}    
     {{ HTML::script('bootstrap.min.js') }}
     {{ HTML::script('bootstrap3-typeahead.min.js') }}    
     {{ HTML::script('js/knockout-3.2.0.js') }}
     {{ HTML::script('js/underscore-min.js') }}
     {{ HTML::style('font-awesome.min.css') }}
     {{ HTML::style('css/main.css') }}
    
</head>
<body>

 <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li class="active">{{ HTML::link('/evento', 'Eventos')}}</li>
              <li>{{ HTML::link('/trampa', 'Trampas')}}</li>
              <li>{{ HTML::link('/graficas', 'Graficas')}}</li>
             <!--  <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li> -->
            </ul>
            
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

<div class="row">
  <div class="col-md-2">
          @yield('sidemenu')
  </div>
  <div class="col-md-10">
    @yield('content')
  </div>
</div>

</body>
</html>

