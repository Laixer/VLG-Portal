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
                    <h5>Nieuwe applicatie</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{ url('/admin/application/new') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Naam</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="name" placeholder="Applicatienaam">
                                @if ($errors->has('name'))
                                <span class="help-block m-b-none">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('domain') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Domein</label>
                            <div class="col-sm-10"><input type="text" name="domain" class="form-control" name="domain">
                                @if ($errors->has('domain'))
                                <span class="help-block m-b-none">{{ $errors->first('domain') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">FontAwesome icon</label>
                            <div class="col-sm-10"><input type="text" name="icon" placeholder="icon" value="fa-" class="form-control">
                                @if ($errors->has('icon'))
                                <span class="help-block m-b-none">{{ $errors->first('icon') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('color') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Kleur</label>
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="color">
                                    <option>Selecteer</option>
                                    <option value="gray-bg">gray-bg</option>
                                    <option value="white-bg">white-bg</option>
                                    <option value="navy-bg">navy-bg</option>
                                    <option value="lazur-bg">lazur-bg</option>
                                    <option value="blue-bg">blue-bg</option>
                                    <option value="yellow-bg">yellow-bg</option>
                                    <option value="red-bg">red-bg</option>
                                    <option value="black-bg">black-bg</option>
                                </select>
                                @if ($errors->has('color'))
                                <span class="help-block m-b-none">{{ $errors->first('color') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Overig</label>
                            <div class="col-sm-10 checkbox-inline">
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
