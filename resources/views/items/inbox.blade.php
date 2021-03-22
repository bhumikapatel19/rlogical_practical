@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row col-md-12">
                    <a href="{{ route('compose') }}" class="btn btn-primary btn-sm col-md-4">compose</a>
                </div>
                <div class="card-header">Sent item</div>

                <div class="card-body">
                    <table  class="table table-bordered responsiveTable table-hover">
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>subject</th>
                            <th>message</th>
                        </tr>
                        @foreach($mail as $key=>$value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value['user']['name']}}</td>
                                <td>{{$value['subject']}}</td>
                                <td>{{$value['message']}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
