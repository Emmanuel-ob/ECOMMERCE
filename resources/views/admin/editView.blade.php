@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- <div class="col-md-8 col-md-offset-2"> -->
            @if (\Session::has('message'))
				<div class="alert alert-success">{{ \Session::get('message') }}</div>
		     @endif
           <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard <a class="btn btn-primary btn-sm pull-right" href="/admin">HOME</a></div>

                <div class="panel-body">
                    <h3>Product Edit Form</h3>
                        
                        <div class="container">
                         <div class="row" >
      
     
        <form style="width:70%;" class="form-group " method="post" action="/admin/edit/{{ $item->id }}" enctype="multipart/form-data" >

        {{ csrf_field() }}
        <div class="{{ $errors->has('itemName') ? ' has-error' : '' }}">
            <input style="margin: 30px;" type="text" name="itemName" class="form-control form-class" value="{{ $item->name }}">
            @if ($errors->has('itemName'))
                <span class="help-block">
                    <strong>{{ $errors->first('itemName') }}</strong>
                </span>
            @endif   
        </div>
        
        <div class="{{ $errors->has('price') ? ' has-error' : '' }}">
        <input style="margin: 30px;" type="number" name="price" class="form-control form-class"  value="{{ $item->price }}">
        @if ($errors->has('price'))
                <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                </span>
            @endif   
        </div>
        
         <div class="{{ $errors->has('quantity') ? ' has-error' : '' }}">
        <input style="margin: 30px;" type="number" name="quantity" class="form-control form-class"  value="{{ $item->quantity }}">
        @if ($errors->has('quantity'))
                <span class="help-block">
                    <strong>{{ $errors->first('quantity') }}</strong>
                </span>
            @endif   
        </div>

         <div class="{{ $errors->has('image') ? ' has-error' : '' }}">
        <input type="file" name="image" id="image" style="margin: 30px;" > 
         @if ($errors->has('image'))
                <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
            @endif   
        </div>
        
        <input style="margin: 30px;" type="submit" value="SUBMIT" class="btn btn-primary">
       <!--  <input type="submit" value="sumbmit"> -->
                    
        </form>

        </div>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


