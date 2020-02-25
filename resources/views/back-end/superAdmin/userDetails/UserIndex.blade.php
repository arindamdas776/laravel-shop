@extends('back-end/layouts/Masterblade')

@section('title')
	User permission page
@endsection

@push('css')

@endpush

@section('content')
	<div class="card">
                        <div class="header">
                            <h2>
                                User Details and status
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Role Status</th>
                                            <th>Email</th>
                                            <th>Permission</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Role Status</th>
                                            <th>Email</th>
                                
                                            <th>Permission</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       @foreach($user as $row)
                                       	 <tr>
                                            <td>{{$row->name}}</td>
                                       
                                            <td>{{$row->role->name}}</td>

                                            <td><strong>{{$row->role_name}}</strong></td>
                                           
                                            <td>{{$row->email}}</td>
                                          @if($row->role_name =='user')  
                                            <td><a href="{{route('adminuser.confirmation',$row->id)}}" class="btn btn-primary">Permission</a></td>
                                           @else 
                                           <td><button type="button" class="btn btn-success">Seller</button></td>
                                        @endif
                                        </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection

@push('js')

@endpush