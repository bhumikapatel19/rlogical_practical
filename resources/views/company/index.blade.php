@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Company listing</h1></div>

                <div class="card-body">
                    <a class="btn btn-primary pull-right mb-2" href="{{route('company.create')}}">Add Company</a>
                   <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Website</th>
                            <th>Logo</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($company_data as $company_key=>$company_value)
                        <tr>
                            <td>{{$company_key+1}}</td>
                            <td>{{ $company_value['name'] }}</td>
                            <td>{{ $company_value['email'] }}</td>
                            <td>{{ $company_value['website'] }}</td>
                            <td><img src="{{(IMAGE_PATH.'storage/'.$company_value['logo'])}}" height="100px" width="100px"></td>
                            <td>{{ $company_value['status'] }}</td>
                            <td>
                                <a href="{{route('company.edit',$company_value['id'])}}">Edit</a>&nbsp; 
                                <button type="button" onclick="deleteCompany({{$company_value['id']}})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="pull-right">
        {{ $company_data->links() }}
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    function deleteCompany(id){
        var url = "{{ route('company.destroy',[':id']) }}";
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