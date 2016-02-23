<?php $nav = 'admin'; ?>

@extends('layouts.app')

@section('title', 'Gebruikers')

@section('content')
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Gebruikers</h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="filter" placeholder="Zoek in gebruikers">
                                <span class="input-group-btn">
                                    <a href="{{ url('/admin/user/new') }}" class="btn btn-primary ">Nieuwe gebruiker</a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <table class="footable table table-stripped" style="margin-top:20px;" data-page-size="10" data-filter=#filter>
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Email</th>
                                <th>Functie</th>
                                <th>Bedrijf</th>
                                <th>Laatste login</th>
                                <th>Actief</th>
                                <th class="text-right" data-sort-ignore="true"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\User::all() as $user)
                            <tr>
                                <td>{{ $user->formalName() }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->userFunction->name }}</td>
                                <td>{{ $user->company ? $user->company->name : '-' }}</td>
                                <td>{{ $user->updated_at->format('d M Y') }}</td>
                                <td>
                                    @if ($user->isActive())
                                    <i class="fa fa-check text-navy"></i>
                                    @else
                                    <i class="fa fa-times text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{ url('admin/user/edit') . '?id=' . $user->id }}" class="btn-white btn btn-xs no-margins">Bewerk</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
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
