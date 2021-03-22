@extends('layouts.app')
@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header"><h1>Edit Company</h1></div>

	                <div class="card-body" style="width:80%;">
	                	<?= Form::model($companyData,['method'=>'patch','route'=>['company.update',$companyData->id],'files'=>true]) ?>
	                		<input type="hidden" name="id" value="{{$companyData->id}}">
	                		<div class="form-group">
	                			<label>Name: </label>
	                			<?= Form::text('name',null,['class'=>'form-control', 'id'=>'name']) ?>
	                			<span class="name_error text-danger"><?=$errors->first('name')?></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Email: </label>
	                			<?= Form::text('email',null,['class'=>'form-control', 'id'=>'email']) ?>
	                			<span class="email_error text-danger"><?=$errors->first('email')?></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Website: </label>
	                			<?= Form::text('website',null,['class'=>'form-control', 'id'=>'website']) ?>
	                			<span class="website_error text-danger"><?=$errors->first('website')?></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Logo: </label>
	                			<?= Form::file('logo',null,['class'=>'form-control', 'id'=>'logo']) ?>
	                			<img src="{{(IMAGE_PATH.'storage/'.$companyData->logo)}}" height="100px" width="100px">
	                			<span class="logo_error text-danger"><?=$errors->first('logo')?></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Status: </label>
	                			<?= Form::radio('status', 'active', true); ?> Active
	                			<?= Form::radio('status', 'inactive'); ?> Inactive
	                		</div>
	                		
	                		<button class="btn btn-primary" type="submit">Submit</button>
	                		<a href="{{route('company.index')}}" class="btn btn-default">Cancel</a>
	                	<?= Form::close() ?>
                	</div>
                </div>
            </div>
        </div>
    </div>
@stop