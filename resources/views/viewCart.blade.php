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
      <a class="btn btn-primary btn-sm pull-right" href="/cart" style="margin-top: -5px;">HOME</a>
    <div class="container">
        <div class="row">
        <div class="col-md-12">
        

    @if(Session::has('product'))
       @foreach(Session::get('product') as $item)
          
          <div class="col-md-4">
             <h3 ><a class="header" style="text-decoration: none;">Item: {{$item['name']}}</a></h3>
             <span>price = ₦{{$item['price']}}</span><br>
             <span>quantity {{$item['quantity']}}</span><br>
          <div >
             <form method="get" action="/cart/remove/{{$item['id']}}">
             {{ csrf_field() }}
             <input type="hidden" name="itemName" value="{{$item['name']}}">
             <input type="submit" name="" value="Remove" class="pull-left" >
             </form>
             
             <form method="get" action="/cart/add/{{$item['id']}}">
             {{ csrf_field() }}
             <input type="number" name="quantity"  style="margin-left: 5px; width:50px;" >
             <!-- <div style="margin-left: -300px;"> -->
             <input type="submit" name="" value="Add"  style="margin-left: -5px;" >
              <!-- </div> -->
             </form>
            
          </div>

          </div>
       @endforeach

    @endif
  
      

    </div>


    </div>

       <br>
      <div class="">
          &nbsp;&nbsp;<p><strong> Total Cost = ₦{{ $totalAmount }}</strong></p>
          <form method="post" action="/cart/remove_all">
                 {{ csrf_field() }}
        <div>
         <input type="submit" name="" value="Clear Cart" class="btn btn-danger">
         </form>
     
           <a href="{{ route('checkout') }}" type="button" class="btn btn-success">Checkout</a>
        </div>
      </div> 
    </div> 

    @endsection

        @section('scripts')
          <script src="{{ asset('js/app.js') }}"></script>
         
        @endsection













         