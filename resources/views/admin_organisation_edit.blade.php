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
                    <h5>Nieuwe organisatie</h5>
                </div>
                <div class="ibox-content">
                    <form method="post" action="{{ url('/admin/company/edit') }}" class="form-horizontal">
                        {!! csrf_field() !!}

                        <input type="hidden" name="id" class="form-control" value="{{ $company->id }}">
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Naam</label>
                            <div class="col-sm-10"><input type="text" class="form-control" name="name" value="{{ $company->name }}">
                                @if ($errors->has('name'))
                                <span class="help-block m-b-none">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10"><input type="email" name="email" class="form-control" value="{{ $company->email }}">
                                @if ($errors->has('email'))
                                <span class="help-block m-b-none">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Website</label>
                            <div class="col-sm-10"><input type="text" name="website" class="form-control" value="{{ $company->website }}">
                                @if ($errors->has('website'))
                                <span class="help-block m-b-none">{{ $errors->first('website') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('visit_address') || $errors->has('visit_address_number') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Bezoekadres</label>
                            <div class="col-sm-8"><input type="text" name="visit_address" class="form-control" value="{{ $company->visit_address }}">
                                @if ($errors->has('visit_address'))
                                <span class="help-block m-b-none">{{ $errors->first('visit_address') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-2"><input type="text" name="visit_address_number" class="form-control" value="{{ $company->visit_address_number }}">
                                @if ($errors->has('visit_address_number'))
                                <span class="help-block m-b-none">{{ $errors->first('visit_address_number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('visit_postal') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Postcode</label>
                            <div class="col-sm-10"><input type="text" name="visit_postal" class="form-control" value="{{ $company->visit_postal }}">
                                @if ($errors->has('visit_postal'))
                                <span class="help-block m-b-none">{{ $errors->first('visit_postal') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group {{ $errors->has('post_address') || $errors->has('post_address_number') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Postadres</label>
                            <div class="col-sm-8"><input type="text" name="post_address" class="form-control" value="{{ $company->post_address }}">
                                @if ($errors->has('post_address'))
                                <span class="help-block m-b-none">{{ $errors->first('post_address') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-2"><input type="text" name="post_address_number" class="form-control" value="{{ $company->post_address_number }}">
                                @if ($errors->has('post_address_number'))
                                <span class="help-block m-b-none">{{ $errors->first('post_address_number') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('post_postal') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Postcode</label>
                            <div class="col-sm-10"><input type="text" name="post_postal" class="form-control" value="{{ $company->post_postal }}">
                                @if ($errors->has('post_postal'))
                                <span class="help-block m-b-none">{{ $errors->first('post_postal') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('postbox') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Postbus</label>
                            <div class="col-sm-10"><input type="text" name="postbox" class="form-control" value="{{ $company->postbox }}">
                                @if ($errors->has('postbox'))
                                <span class="help-block m-b-none">{{ $errors->first('postbox') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Telefoon</label>
                            <div class="col-sm-10"><input type="text" name="phone" value="{{ $company->phone }}" class="form-control"></div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group"><label class="col-sm-2 control-label">Overig</label>
                            <div class="col-sm-10 checkbox-inline">
                                <div class="i-checks"><label> <input type="checkbox" name="active" {{ $company->active ? 'checked' : '' }}> <i></i> Actief </label></div>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary" type="submit">Opslaan</button>
                                <a href="{{ url('/admin/company/delete') . '?id=' . $company->id }}" class="btn btn-danger">Verwijderen</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
