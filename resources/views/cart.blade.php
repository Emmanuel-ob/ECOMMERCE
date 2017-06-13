<!-- <!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title> -->

        <!-- Fonts -->
       <!--  <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
         <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css">

        
    </head>
    <body> -->


@extends('layouts.master')

      @section('title')
          Laravel Shopping Cart
      @endsection

   @section('content')
    @if(Session::has('success'))
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    @endif
        
  
        <!-- <br>
        <br> -->
        
         

     
                <!-- <div class="panel-body"> -->

        
        <!-- <section class="container"> -->
       <!--  <div class="container"> -->
        <div class="row">
      
            

        <!-- <ul class="list-group"> -->
            @foreach ($items as $item)
                <div class="col-md-4">
                  <div class="thumbnail">
                    
                      
                    <img src="{{ asset('cartImages/' . $item->image )}}" class="img-responsive">
                  <div class="caption">
                    <h3><a class="header" style="text-decoration: none;">{{$item->name}}</a></h3>
                  <div class="clearfix">
                    <div class="pull-left price"><span style="word-break: break-all;"> ₦{{$item->price}}</span></div>
                   <!--  <br> -->
                    <form method="get" action="/cart/add/{{$item->id}}">
                     {{ csrf_field() }}
                    
                        <input type="hidden" name="quantity" value="1">
                    <input type="submit" name="" value="Add to Cart"  class="btn btn-success pull-right">
                    
                    </form>

                  </div>              

                  </div>
                </div>
                </div>
            @endforeach
        <!-- </ul> -->

        </div>
       <!--  </div> -->
       
    <!-- </section> --> 


              <!-- </div> -->
           
      @endsection

        @section('scripts')
          <script src="{{ asset('js/app.js') }}"></script>
         
        @endsection



