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

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Nieuwe gebruiker</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{ url('/admin/user/new') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->has('name') || $errors->has('last_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Naam <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-4"><input type="text" class="form-control" name="name" placeholder="Voornaam" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="help-block m-b-none">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-6"><input type="text" class="form-control" name="last_name" placeholder="Achternaam" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                <span class="help-block m-b-none">{{ $errors->first('last_name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Email <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                <span class="help-block m-b-none">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Wachtwoord <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="password" name="password" class="form-control" name="password">
                                @if ($errors->has('password'))
                                <span class="help-block m-b-none">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Bevestig <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="password" name="password_confirmation" class="form-control" name="password">
                                @if ($errors->has('password_confirmation'))
                                <span class="help-block m-b-none">{{ $errors->first('password_confirmation') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Telefoon</label>
                            <div class="col-sm-10"><input type="text" name="phone" placeholder="Telefoon" class="form-control" value="{{ old('phone') }}"></div>
                        </div>
                        <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Mobiel <span style="color: #C10000;">*</span></label>
                            <div class="col-sm-10"><input type="text" name="mobile" placeholder="Mobiel" class="form-control" value="{{ old('mobile') }}">
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
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
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
                                    <option value="{{ $function->id }}">{{ $function->name }}</option>
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
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('company'))
                                <span class="help-block m-b-none">{{ $errors->first('company') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Overig</label>
                            <div class="col-sm-10" style="padding-top: 7px;">
                                <div class="i-checks"><label> <input type="checkbox" name="active" checked=""> <i></i> Actief </label></div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Opslaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
