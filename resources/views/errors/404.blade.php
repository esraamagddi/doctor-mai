@extends('layouts.front.app')

@section('title', 'الصفحة غير موجودة')

@section('content')
 <style>
     
        .error-container {
            max-width: 500px;
            padding: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(6px);
text-align: center;      
margin: auto;
    margin: auto;
  margin-top: 50px;
  }

        .error-container h1 {
            font-size: 100px;
            margin: 0;
            text-shadow: 2px 2px 6px rgba(0,0,0,0.6);
        }

        .error-container h2 {
            font-size: 26px;
            margin: 15px 0;
        }

        .error-container p {
            margin: 10px 0 25px;
            font-size: 16px;
            line-height: 1.6;
        }

        .error-container a {
            display: inline-block;
            padding: 12px 25px;
            background: #ffcc00;
            color: #000;
            font-weight: bold;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .error-container a:hover {
            transform: scale(1.05);
        }
    </style>
    <section class="relative h-screen flex items-center">
    <div class="error-container">
        <h1>404</h1>
        <h2>الصفحة غير موجودة</h2>
        <p>الصفحة اللي بتدور عليها مش متاحة أو ممكن تكون اتنقلت.  
           جرب ترجع للصفحة الرئيسية.</p>
        <a href="{{ url('/') }}">الرجوع للرئيسية</a>
    </div>
    </section>
@endsection