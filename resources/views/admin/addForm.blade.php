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
                    <h3>Product Add Form</h3>
                        
                        <div class="container">
                         <div class="row" >
      
     
        <form style="width:70%;" class="form-group " method="post" action="/admin/addProduct" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input style="margin: 30px;" type="text" name="itemName" class="form-control form-class" placeholder="Name">
        <input style="margin: 30px;" type="number" name="price" class="form-control form-class" placeholder="price">
        <input style="margin: 30px;" type="number" name="quantity" class="form-control form-class" placeholder="quantity">
        <input type="file" name="image" id="image" style="margin: 30px;"> 
        <input style="margin: 30px;" type="submit" name="" value="Add Product" class="btn btn-primary">
                    
        </form>

        </div>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


