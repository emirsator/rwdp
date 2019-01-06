@extends('layouts.app')

@section('title')
    @lang('label.edit-user')
@endsection

@section('content')
<div class="container">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3 form-background padding-20 margin-top-10">            
        @if ($errors->any())
            <div class="col-xs-12 alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            {{ Form::open(array('url' => route('users.edit', [$user->id]), 'method' => 'PUT', 'class' => 'form-horizontal inline col-xs-12' )) }}
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name" class="control-label">@lang('label.email')</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                </div>

                <div class="form-group">
                    {{ Form::submit(Lang::get('label.save'), ['class' => 'btn btn-primary']) }}

                    <a href="{{ route('users.details', [$user->id]) }}" class="btn btn-danger pull-right">{{ Lang::get('label.cancel') }}</a>
                </div>

            {{ Form::close() }}
        </div>
    </div>
@endsection