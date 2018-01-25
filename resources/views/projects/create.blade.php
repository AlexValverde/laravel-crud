@extends('......layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{ route('projects.store') }}" method="POST">
             {{ csrf_field() }}
                @include('...projects.partials.fields')
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12 no-padder">
                            <a type="button" class="btn btn-success" href="{{ url('/projects') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                            <button type="submit" class="btn btn-success pull-right">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection