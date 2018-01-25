
@include('...projects.partials.delete_confirm')

@if(count($projects) > 0)
    <table class="table table-bordered table-striped" id="ProjectsTable">
        <thead>
        <tr>
            <th class="text-center" style="width: 60px">ID</th>
            <th class="text-center" style="width: 120px">Name</th>
            <th class="text-center" style="width: 120px">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr>
                <td class="text-center">{{ $project->id }}</td>
                <td class="text-left">{{ $project->name }}</td>
                <td class="text-center">
                    <form id="form-actions" action="{{ route('projects.destroy',['projects' => $project->id])}}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}

                        <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Service" data-message="Are you sure you want to delete this service?">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                        <a href="{{ url('/projects/' . $project->id.'/edit') }}" class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </a>
                        <a href="{{ url('/projects/' . $project->id) }}" class="btn btn-info btn-xs">
                            <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                        </a>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Name</th>
            <th class="text-center">Actions</th>
        </tr>
        </tfoot>
    </table>
@else
    <div>
        <h3>
            You have no Projects
        </h3>
    </div>
@endif