<?php $nav = 'admin'; ?>

@extends('layouts.app')

@section('title', 'Gebruikers')

@section('content')
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">

            @if (session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
            @endif
        
            <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-2"> Gebruiker</a></li>
                        <li class=""><a data-toggle="tab" href="#tab-3"> Applicatie rechten</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-2" class="tab-pane active">
                            <div class="panel-body">

                                <form method="post" action="{{ url('/admin/user/edit') }}" class="form-horizontal">
                                    {!! csrf_field() !!}

                                    <input type="hidden" name="id" class="form-control" value="{{ $user->id }}">
                                    <div class="form-group"><label class="col-sm-2 control-label">ID</label>
                                        <div class="col-sm-10"><input type="text" disabled="disabled" name="id" class="form-control" value="{{ $user->id }}">
                                        </div>
                                    </div>

                                    <div class="form-group {{ $errors->has('name') || $errors->has('last_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Naam <span style="color: #C10000;">*</span></label>
                                        <div class="col-sm-4"><input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                            @if ($errors->has('name'))
                                            <span class="help-block m-b-none">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                        <div class="col-sm-6"><input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}">
                                            @if ($errors->has('last_name'))
                                            <span class="help-block m-b-none">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Email <span style="color: #C10000;">*</span></label>
                                        <div class="col-sm-10"><input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                            @if ($errors->has('email'))
                                            <span class="help-block m-b-none">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Wachtwoord</label>
                                        <div class="col-sm-10"><input type="password" name="password" class="form-control" name="password">
                                            @if ($errors->has('password'))
                                            <span class="help-block m-b-none">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Telefoon</label>
                                        <div class="col-sm-10"><input type="text" name="phone" value="{{ $user->phone }}" class="form-control"></div>
                                    </div>
                                    <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Mobiel <span style="color: #C10000;">*</span></label>
                                        <div class="col-sm-10"><input type="text" name="mobile" value="{{ $user->mobile }}" class="form-control">
                                            @if ($errors->has('mobile'))
                                            <span class="help-block m-b-none">{{ $errors->first('mobile') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group {{ $errors->has('user_type') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Gebruikersgroep <span style="color: #C10000;">*</span></label>
                                        <div class="col-sm-10">
                                            <select class="form-control m-b" name="user_type">
                                                <option>Selecteer</option>
                                                @foreach(App\UserType::all() as $type)
                                                <option {{ $user->user_type_id == $type->id ? 'selected' : '' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('user_type'))
                                            <span class="help-block m-b-none">{{ $errors->first('user_type') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('user_function') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Functie <span style="color: #C10000;">*</span></label>
                                        <div class="col-sm-10">
                                            <select class="form-control m-b" name="user_function">
                                                <option>Selecteer</option>
                                                @foreach(App\UserFunction::all() as $function)
                                                <option {{ $user->functions_id == $function->id ? 'selected' : '' }} value="{{ $function->id }}">{{ $function->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('user_function'))
                                            <span class="help-block m-b-none">{{ $errors->first('user_function') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group {{ $errors->has('company') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Organisatie</label>
                                        <div class="col-sm-10">
                                            <select class="form-control m-b" name="company">
                                                <option value="-1">Selecteer</option>
                                                @foreach(App\Company::all() as $company)
                                                <option {{ $user->companies_id == $company->id ? 'selected' : '' }} value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('company'))
                                            <span class="help-block m-b-none">{{ $errors->first('company') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Overig</label>
                                        <div class="col-sm-10 checkbox-inline">
                                            <div class="i-checks"><label> <input type="checkbox" name="active" {{ $user->isActive() ? 'checked' : '' }}> <i></i> Actief </label></div>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary" type="submit">Opslaan</button>
                                            <a href="{{ url('/admin/user/delete') . '?id=' . $user->id }}" class="btn btn-danger">Verwijderen</a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <form method="post" action="{{ url('/admin/user/application/add') }}">
                                        {!! csrf_field() !!}

                                        <table class="table table-stripped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Applicatie</th>
                                                <th>Leesrechten</th>
                                                <th>Schrijfrechten</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($user->applications as $application)
                                                <tr>
                                                    <td style="vertical-align: middle">{{ $application->name }}</td>
                                                    <td style="vertical-align: middle">
                                                        <div class="i-checks"><label> <input type="checkbox" disabled {{ $application->pivot->read ? 'checked' : '' }}> <i></i> </label></div>
                                                    </td>
                                                    <td style="vertical-align: middle">
                                                        <div class="i-checks"><label> <input type="checkbox" disabled {{ $application->pivot->write ? 'checked' : '' }}> <i></i> </label></div>
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="{{ url('/admin/user/application/remove') . '?id=' . $application->pivot->id }}" class="btn btn-white"><i class="fa fa-trash"></i> Verwijderen</a>
                                                    </td>
                                                </tr>
                                                @endforeach

                                                <tr>
                                                    <td>
                                                        <select class="form-control" name="application">
                                                            <option selected>Selecteer</option>
                                                            @foreach($user->applicationsAvailable() as $application)
                                                            <option value="{{ $application->id }}">{{ $application->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="vertical-align: middle">
                                                        <div class="i-checks"><label> <input type="checkbox" id="permission_read" name="permission_read"/> </label></div>
                                                    </td>
                                                    <td style="vertical-align: middle">
                                                        <div class="i-checks"><label> <input type="checkbox" id="permission_write" name="permission_write"/> </label></div>
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="hidden" name="id" class="form-control" value="{{ $user->id }}">
                                                        <button class="btn btn-white"><i class="fa fa-plus"></i> Toevoegen</button>
                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</div>
@endsection
