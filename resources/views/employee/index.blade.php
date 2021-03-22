@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Employee listing</h1></div>

                <div class="card-body">
                    <a class="btn btn-primary pull-right mb-2" href="{{route('employee.create')}}">Add Employee</a>
                   <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Company Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($employee_data))
                            @foreach($employee_data as $employee_key=>$employee_value)
                            <tr>
                                <td>{{$employee_key+1}}</td>
                                <td>{{ $employee_value['firstname'].'  '.$employee_value['lastname'] }}</td>
                                <td>{{ $employee_value['company']['name'] }}</td>
                                <td>{{ $employee_value['email'] }}</td>
                                <td>{{ $employee_value['phone'] }}</td>
                                <td>{{ $employee_value['status'] }}</td>
                                <td>
                                    <a href="{{route('employee.edit',$employee_value['id'])}}">Edit</a>&nbsp; 
                                    <button type="button" onclick="deleteEmployee({{$employee_value['id']}})">Delete</button>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>No data available.</tr>
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-right">
        {{ $employee_data->links() }}
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function deleteEmployee(id){
        var url = "{{ route('employee.destroy',[':id']) }}";
        url = url.replace(":id",id);
        var token = "{{ csrf_token() }}";

        $.ajax({
            url: url,
            type:"DELETE",
            dataType:'json',
            data:{id:id,_token:token },
            beforeSend:function(){                
            },
            complete:function(){
                window.location.reload();
            }
        });
        
    }
</script>
@stop