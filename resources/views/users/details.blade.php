@extends('layouts.app')

@section('title')
    @lang('label.user-details')
@endsection

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12 padding-sides-10 margin-top-10">
        <div class="container-box col-xs-12">
            <h3 class="col-xs-12 padding-0 margin-top-0">@lang('label.basic-info')</h3>
            <div class="col-xs-12 padding-0 margin-top-10">
                <label class="col-xs-4 label-details">@lang('label.email')</label>
                <span class="col-xs-12 padding-0">{{ $user->email }}</span>
            </div>

            <div class="col-xs-12 padding-0">
                <a class="btn btn-primary pull-right" href="{{ route('users.editview', [$user->id]) }}">@lang('label.edit')</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-6 col-xs-12 padding-sides-10 margin-top-10">
        <div class="container-box col-xs-12">
            <h3 class="col-xs-12 padding-0 margin-top-0">@lang('label.roles-assigned-to-user')</h3>
            
            <div class="col-xs-12 padding-0">
                <parent-child-management
                    :childdropdownitems="{{ json_encode($roles) }}"
                    :childitems="{{ json_encode($userRoles) }}"
                    :parentid="{{ json_encode($user->id) }}"
                    childdropdownlabel="@lang('label.roles')"
                    datamodifyurl="{{$userRoleModifyUrl}}"
                    descriptiontext="@lang('messages.click-on-row-text')">
                </parent-child-management>
            </div>
        </div>
    </div>

    <div class="clearfix hidden-md hidden-lg"></div>

    <div class="col-md-5 col-sm-6 col-xs-12 padding-sides-10 margin-top-10">
        <div class="container-box col-xs-12">
            <h3 class="col-xs-12 margin-top-0">@lang('label.user-files')</h3>

            <div class="col-xs-12 padding-0">
                <span>{{Lang::get('label.number-of-documents')}} {{sizeof($documents)}}</span>
                <hr>
                {{ Form::open(array('url' => route('users.adddocument', [$user->id]), 'method' => 'POST', 'files'=>'true',
                     'class' => 'form-horizontal inline col-xs-12' )) }}
                    {{ csrf_field() }}

                    <label class="custom-file">
                        {{Form::file('document', ['class' => 'form-control-file'])}}
                        <span class="custom-file-control"></span>
                    </label>

                    {{ Form::submit(Lang::get('label.upload'), ['class' => 'btn btn-primary pull-right']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>

</div>

@endsection