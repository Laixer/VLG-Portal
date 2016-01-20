<?php $nav = 'account'; ?>

@extends('layouts.app')

@section('title', 'Account')

@section('content')
<div class="wrapper wrapper-content">

    @if (session('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
    @endif

    <div class="ibox-content">
        <div class="row">
            <div class="col-lg-12">

                <form method="post" action="{{ url('/account') }}" class="form-horizontal">
                    {!! csrf_field() !!}
                    <div class="form-group"><label class="col-sm-2 control-label">Organisatie</label>
                        <div class="col-lg-10">
                            <p class="form-control-static"><strong>{{ Auth::user()->company ? Auth::user()->company->name : 'Geen' }}</strong></p>
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group  {{ $errors->has('name') || $errors->has('last_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Naam <span style="color: #C10000;">*</span></label>
                        <div class="col-sm-4"><input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" placeholder="Voornaam">
                            @if ($errors->has('name'))
                            <span class="help-block m-b-none">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-sm-6"><input type="text" class="form-control" name="last_name" value="{{ Auth::user()->last_name }}" placeholder="Achternaam">
                            @if ($errors->has('last_name'))
                            <span class="help-block m-b-none">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Email <span style="color: #C10000;">*</span></label>
                        <div class="col-sm-10"><input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Email">
                            @if ($errors->has('email'))
                            <span class="help-block m-b-none">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Telefoon</label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" placeholder="Telefoon">
                            @if ($errors->has('phone'))
                            <span class="help-block m-b-none">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Mobiel <span style="color: #C10000;">*</span></label>
                        <div class="col-sm-10"><input type="text" class="form-control" name="mobile" value="{{ Auth::user()->mobile }}" placeholder="Mobiel">
                            @if ($errors->has('mobile'))
                            <span class="help-block m-b-none">{{ $errors->first('mobile') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Huidig wachtwoord</label>
                        <div class="col-sm-10"><input type="password" class="form-control" name="current_password">
                            @if ($errors->has('current_password'))
                            <span class="help-block m-b-none">{{ $errors->first('current_password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Nieuw wachtwoord</label>
                        <div class="col-sm-10"><input type="password" class="form-control" name="password">
                            @if ($errors->has('password'))
                            <span class="help-block m-b-none">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Bevestig</label>
                        <div class="col-sm-10"><input type="password" class="form-control" name="password_confirmation">
                            @if ($errors->has('password_confirmation'))
                            <span class="help-block m-b-none">{{ $errors->first('password_confirmation') }}</span>
                            @endif
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
@endsection
