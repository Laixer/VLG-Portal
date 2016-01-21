<?php $nav = 'account'; ?>

@extends('layouts.app')

@section('title', 'Organisaties')

@section('content')
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-content">

                    <div class="m-b-lg">
                        <strong>Activiteitenlog</strong>
                    </div>

                    <div class="table-responsive">
                    <table class="table table-hover issue-tracker">
                        <tbody>

                            @foreach(App\Audit::where('user_id', Auth::id())->orderBy('created_at', 'desc')->limit(25)->get() as $log)
                            <tr>
                                <td>
                                    <span class="label label-primary">Oke</span>
                                </td>
                                <td class="issue-info">
                                    <strong>{{ $log->payload }}</strong>
                                    <small>{{ $log->user_agent }}</small>
                                </td>
                                <td>[ {{ $log->ip_address }} ]</td>
                                <td class="text-right">{{ $log->created_at }}</td>
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
