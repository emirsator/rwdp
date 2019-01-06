@extends('layouts.app')

@section('content')

@section('title')
    @lang('label.roles-management')
@endsection

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 padding-sides-10 margin-top-10">
            <div class="container-box col-xs-12">
                <h3 class="col-xs-12 padding-0">@lang('label.included-roles')</h3>
                <roles-grid :roles="{{ json_encode($user->roles) }}" 
                    removeurl="{{ route('users.deleterole', ['id' => $user->id]) }}"
                    descriptiontext="@lang('messages.click-on-row-text')"></roles-grid>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 padding-sides-10 margin-top-10">
            <div class="container-box col-xs-12">
                <h3 class="col-xs-12 padding-0">@lang('label.add-role')</h3>
                @if ($errors->any())
                    <div class="col-xs-12 alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-xs-12 padding-0">
                    @if (count($unassignedroles) > 0)
                        {{ Form::open(array('url' => route('users.addrole'))) }}
                            <div class="form-group">
                                <label for="role_id">@lang('label.unassigned-roles')</label>
                                {{ Form::select('role_id', $unassignedroles, null, ['class' => 'form-control']) }}
                            </div>
                            {{ Form::submit(Lang::get('label.add'), ['class' => 'btn btn-primary pull-right', 'disabled' => count($unassignedroles) == 0]) }}

                            {{ Form::hidden('user_id', $user->id) }}
                        {{ Form::close() }}
                    @else
                        @lang('label.no-roles-to-add')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection