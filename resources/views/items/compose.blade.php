@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Compose</div>

                <div class="card-body">
                    <?=Form::open(['route' => 'mail.send', 'method' => 'post'])?>
		            <div class="col-xs-12">
			            <div class="box">
			                <div class="box-body">
			                	{{csrf_field()}}
			                	<div class="row">
				                    <div class="col-md-6">
				                    	<div class="form-group">
					                        <label>Select User<sup class="text-danger">*</sup></label>
					                    	<?=Form::select('user_id',$userList, old('user_id'), ["class" => "form-control select2", "id" => "user_id",'placeholder'=>'Select user']);?>
					                    	<span class="text-danger"><?=$errors->first('user_id')?></span>
					                    </div>
				                    	<div class="form-group">
					                        <label>Subject<sup class="text-danger">*</sup></label>
					                    	<?=Form::text('subject', null, ['class' => 'form-control', 'placeholder' => 'Enter Page Subject']);?>
					                    	<span class="text-danger"><?=$errors->first('subject')?></span>
					                    </div>
					                     <div class="form-group">
					                    	<label>Message<sup class="text-danger">*</sup></label>
						                    	<?=Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Enter Message', 'rows' => '2', 'cols' => '54',]);?>
						                   		<span class="text-danger"><?=$errors->first('message')?></span>
					                	</div>
						            </div>
					            </div>
				        	</div>
			    			<div class="box-footer">
			                    <div class="box-tools pull-right">
			                    	<button type="submit" name="save_button" value="save_new" class="btn btn-success disabled-btn" title="Save & New">Send</button>
			                        <a href="{{route('inbox')}}" class="btn btn-default disabled-btn" title="Cancel">Cancel</a>
			                    </div>
			                </div>
				        </div>
				    </div>
		            <?=Form::close();?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
