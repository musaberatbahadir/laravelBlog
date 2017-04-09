<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Blog Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
  </head>

  <body>
    @include('layouts.nav')

    <div class="blog-header">
      <div class="container">
        <h1 class="blog-title">Blog Falan</h1>
        <p class="lead blog-description">Filanzi..</p>
      </div>
    </div>

    <div class="container">
      <div class="row">
        @yield ('content')

        @include ('layouts.sidebar')
      </div>
    </div>

    @include('layouts.footer')
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">
      $( document ).ready(function() {
        $('#btn-search').click(function() {
          $('#btn-search').prop('disabled', true);
          axios.get('/search?q=' + $('#search').val())
          .then(function(response) {
            window.location.href = '/search';
          });
        });
      })
    </script>
    @yield('scripts')
  </body>
</html>