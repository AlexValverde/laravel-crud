@extends('......layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @include('...projects.partials.delete_confirm')
                    <div class="panel-heading">Projects</div>
                        <div class="panel-body">
                            <div class="service-item col-md-12">
                                <div class="service-attribute col-md-3">ID</div><div class="col-md-9">{{ $project->id }}</div>
                            </div>
                            <div class="service-item col-md-12">
                                <div class="service-attribute col-md-3">Name</div><div class="col-md-9">{{ $project->name }}</div>
                            </div>
                            <div class="service-item col-md-12">
                                <div class="service-attribute col-md-3">Content</div><div class="col-md-9" style="overflow-wrap: break-word;">{{ $project->content }}</div>
                            </div>
                        </div>
                    <div class="panel-footer">
                        <div class="text-right">
                            <form id="form-actions" action="{{ route('projects.destroy',['users' => $project->user_id, 'projects' => $project->id])}}" method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <td class="text-center">
                                    <a href="{{ url('/projects') }}" class="btn btn-info btn-xs">
                                        Back
                                    </a>
                                    <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                    <a href="{{ url('/projects/' . $project->id.'/edit') }}" class="btn btn-primary btn-xs">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                </td>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection