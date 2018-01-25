@extends('......layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @if($project->secret)
                <form action="{{ asset('/projects/' . $project->id)}}  " method="POST">
                    {{ method_field('PUT') }}
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
                    @else
                    <form action="{{ route('enter-password')}}  " method="POST">
                        {{ csrf_field() }}
                        <input class="form-control" name="id" type="hidden" placeholder="id"  value="{{ $project->id }}" required/>
                        <div class="form-group">
                            Secret
                            <input class="form-control" name="secret" type="password" placeholder="Secret"  value="{{ $project->secret }}" required/>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 no-padder">
                                    <a type="button" class="btn btn-success" href="{{ url('/projects') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    <button type="submit" class="btn btn-success pull-right">Decrypt</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif

            </div>
        </div>
    </div>
@endsection