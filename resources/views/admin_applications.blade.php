<?php $nav = 'admin'; ?>

@extends('layouts.app')

@section('title', 'Applicaties')

@section('content')
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Applicaties</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3 text-right">
                            <a href="{{ url('/admin/application/new') }}" class="btn btn-primary ">Nieuwe applicatie</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Applicatie </th>
                                    <th>Endpoint </th>
                                    <th>Public Key</th>
                                    <th>Aangemaakt</th>
                                    <th>Actief</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Application::all() as $application)
                                <tr>
                                    <td><i class="fa {{ $application->icon }}"></i></td>
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->domain }}</td>
                                    <td>{{ $application->public_token }}</td>
                                    <td>{{ $application->created_at->format('d M Y') }}</td>
                                    <td>
                                        @if ($application->isActive())
                                        <i class="fa fa-check text-navy"></i>
                                        @else
                                        <i class="fa fa-times text-danger"></i>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        @if ($application->isActive())
                                        <form method="post" action="{{ url('/admin/application/delete') }}">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="application" value="{{ $application->id }}" />
                                            <div class="btn-group">
                                                <button class="btn-danger btn btn-xs no-margins">Verwijderen</button>
                                            </div>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>
@endsection
