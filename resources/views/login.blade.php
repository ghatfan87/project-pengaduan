<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="font-weight:bold">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('NotAllowed'))
	<h2>{{ Session::get('NotAllowed') }}</h2>
@endif
    <style>
      .form-container {
          width: 400px;
          margin: 0 auto;
          text-align: center;
          padding: 30px;
          border: 1px solid #ccc;
          border-radius: 10px;
          margin-top: 50px;
        }
  
        input[type="text"],
        input[type="password"] {
          width: 100%;
          padding: 10px;
          margin-top: 10px;
          border-radius: 5px;
          border: 1px solid #ccc;
          font-size: 18px;
        }
  
        input[type="submit"] {
          width: 100%;
          padding: 10px;
          margin-top: 20px;
          border-radius: 5px;
          border: none;
          background-color: #e3a930;
          color: white;
          font-size: 18px;
          cursor: pointer;
          font-weight: bold;
        }
  
        input[type="submit"]:hover {
          background-color:chocolate;
        }

        .tmbl{
          background-color: #e3a930;
          color: white;
          cursor: pointer;
          width: 95%;
          padding: 10px;
          border-radius: 5px;
          display: block;
          font-weight: bold;
          font-size: 18px;
        }

        .tmbl:hover{
          background-color: chocolate;
        }
    </style>
</head>
<body>
<div class="form-container">
      <form action="{{route('auth')}}" method="POST">
        @csrf
        <h2>Login Form</h2>
        <input type="text" name="email"placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Submit">
        <br><br>
        <a class="tmbl" style="text-decoration: none; "  href="/">Kembali</a>
      </form>
    </div>

</body>

@include('sweetalert::alert')

</html>
