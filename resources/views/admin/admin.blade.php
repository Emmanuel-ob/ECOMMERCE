@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- <div class="col-md-8 col-md-offset-2"> -->
           <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard <a class="btn btn-primary btn-sm pull-right" href="/admin/addForm">ADD PRODUCT</a></div>

                <div class="panel-body">
                    You are logged in to Admin Dashboard!
                        
                        <div class="container">
                         <div class="row"> 
      
            

        <!-- <ul class="list-group"> -->
            @foreach ($products as $item)
              
                <div class="col-md-4" style="padding-bottom: 30px;" >
                     <div>
                     <img src="{{ asset('cartImages/' . $item->image )}}" height="100" width="200">
                     </div>
                    <h3><a class="header" style="text-decoration: none;">{{$item->name}}</a></h3>
                    <span style="word-break: break-all;">Price :{{$item->price}}</span><br>
                    <span style="word-break: break-all;">Quantity :{{$item->quantity}}</span>
                    <br>
                     <div class="container">
                    <!--<form method="get" action="/admin/editView/{{$item->id}}" class="pull-left">
                     {{ csrf_field() }}
                    <input type="hidden" name="itemId" value="{{$item->id}}">
                    
                    
                    </form> -->
                     <a href="/admin/editView/{{$item->id}}" class="pull-left"> <input type="submit" style="margin-left: -20px;" class="btn btn-primary" value="Edit"></a>
                    
                    <a href="#" style="margin-left: 10px;" class="btn btn-danger" data-toggle="modal" data-target="#delete{{$item->id}}" class="pull-right">DELETE</a>
                    </div>

                    <!--delete modal start-->
                <div class="modal fade" id="delete{{$item->id}}"  tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="btn pull-right btncancel">&times;</button>
                        <h4>Delete Stock</h4>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="/admin/delete/{{$item->id}}" class="form">
                            {{ csrf_field() }}
                            
                          <div class="form-group">
                            <p>Are you sure you want to permanently delete this item?</p>
                            <p> Click 'DELETE' to continue or 'CANCEL' to cancel action.</p>
                          </div>
                          
                          <button type="submit" class="btn btn-primary btn-lg submitcolor">DELETE</button>
                        </form>
                        <!-- <button type="submit" class="btn btn-primary btn-lg submitcolor">CANCEL</button> -->
                      </div>
                      
                    </div>  
                  </div>
                </div>
              <!-- delete modal end-->

                </div>
            @endforeach
        <!-- </ul> -->

        </div>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



