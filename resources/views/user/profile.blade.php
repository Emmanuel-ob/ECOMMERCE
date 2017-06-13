@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
           <!--  <h1>User Profile</h1> -->
            <a class="btn btn-primary btn-sm pull-right" href="/cart" style="margin-top: -5px;">HOME</a>
            
            <h2>My Orders</h2>
            <hr>
        @if(!$orders == null)
            @foreach($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($order as $item )
                                <li class="list-group-item">
                                    <span class="badge">${{ $item['price'] }}</span>
                                    {{ $item['name'] }} | {{ $item['quantity'] }} Units
                                </li>
                                
                            @endforeach

                            
                        </ul>
                    </div>
                    <!-- <div class="panel-footer">
                        <strong>Total Price: </strong>
                    </div> -->
                </div>
            @endforeach
        @endif
        </div>
    </div>
@endsection

 @section('scripts')
          <script src="{{ asset('js/app.js') }}"></script>
         
 @endsection