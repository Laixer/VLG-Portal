<?php $nav = 'admin'; ?>

@extends('layouts.app')

@section('title', 'Sessies')

@section('content')
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Actieve sessies</h5>
                </div>
                <div class="ibox-content">

                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                        <thead>
                            <tr>

                                <th data-sort-ignore="true">SessieID</th>
                                <th>Gebruiker</th>
                                <th data-hide="all">Agent</th>
                                <th>Interface</th>
                                <th>IP</th>
                                <th>Domein</th>
                                <th data-sort-ignore="true">Actief</th>
                                <th class="text-right" data-sort-ignore="true"></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Session::all() as $session)
                            <tr>
                                <td>{{ $session->getId() }}</td>
                                <td>{{ $session->user ? $session->user->formalName() : '-' }}</td>
                                <td>{{ $session->user_agent }}</td>
                                <td>{{ $session->interface }}</td>
                                <td>{{ $session->ip_address }}</td>
                                <td>{{ $session->domain }}</td>
                                <td>{{ date('d M Y H:i:s', $session->last_activity) }}</td>
                                <td class="text-right">
                                    <form method="post" action="{{ url('/admin/session/terminate') }}">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="session" value="{{ $session->getId() }}" />
                                        <div class="btn-group">
                                            <button class="btn-danger btn btn-xs">Verwijderen</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
