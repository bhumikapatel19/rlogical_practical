@extends('layouts.app')
@section('content')
	<div class="container">
	    <div class="row justify-content-center">
	        <div class="col-md-8">
	            <div class="card">
	                <div class="card-header"><h1>Edit Employee</h1></div>

	                <div class="card-body" style="width:80%;">
	                	<?= Form::model($employeeData,['method'=>'patch','route'=>['employee.update',$employeeData->id]]) ?>
	                		<input type="hidden" name="id" value="{{$employeeData->id}}">
	                		<div class="form-group">
	                			<label>First Name: </label>
	                			<?= Form::text('firstname',null,['class'=>'form-control', 'id'=>'firstname']) ?>
	                			<span class="firstname_error text-danger"><?=$errors->first('firstname')?></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Last Name: </label>
	                			<?= Form::text('lastname',null,['class'=>'form-control', 'id'=>'lastname']) ?>
	                			<span class="lastname_error text-danger"><?=$errors->first('lastname')?></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Company: </label>
	                			<?= Form::select('company_id',[''=>'Select']+$company_list, $employeeData->company_id,['class' => 'form-control ','id'=>'company_id']); ?>
	                			<span class="company_id_error text-danger"><?=$errors->first('company_id')?></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Email: </label>
	                			<?= Form::text('email',null,['class'=>'form-control', 'id'=>'email']) ?>
	                			<span class="email_error text-danger"><?=$errors->first('email')?></span>
	                		</div>
	                		<div class="form-group">
	                			<label>Phone: </label>
	                			<?= Form::text('phone',null,['class'=>'form-control', 'id'=>'phone']) ?>
	                			<span class="phone_error text-danger"><?=$errors->first('phone')?></span>
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