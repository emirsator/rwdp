@extends('layouts.app')

@section('title')
    @lang('label.users')
@endsection

@section('content')

<div class="row">
    <div class="col-12 container-box margin-top-10">
        <a href="{{ route('users.createview') }}" class="btn btn-default">@lang('label.new-user')</a>
    </div>
    <div class="container-box margin-top-10">
        <div class="col-12">
            {!! $grid->render() !!}
        </div>
    </div>
</div>

@endsection