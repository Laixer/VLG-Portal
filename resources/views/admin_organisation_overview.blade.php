<?php
$nav = 'admin';
$company_member_count = App\User::where('companies_id', $company->id)->count();
?>

@extends('layouts.app')

@section('title', 'Organisatie')

@section('content')
<div class="wrapper wrapper-content">

    <div class="ibox">
        <div class="ibox-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-b-md">
                        <h2>{{ $company->name }}</h2>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>Status</dt> <dd>{{ $company->isActive() ? 'Actief' : 'Inactief' }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <dl class="dl-horizontal">
                        <dt>Bezoekersadres</dt> <dd>{{ $company->visit_address . ' ' . $company->visit_address_number }}</dd>
                        <dt>Postcode</dt> <dd> {{ $company->visit_postal }}</dd>
                        <dt>Telefoon</dt> <dd> {{ $company->phone }}</dd>
                        <dt>Gebruikers</dt> <dd>{{ $company_member_count }}</dd>
                    </dl>
                </div>
                <div class="col-lg-7" id="cluster_info">
                    <dl class="dl-horizontal" >
                        <dt>Postadres</dt> <dd>{{ $company->post_address . ' ' . $company->post_address_number }}</dd>
                        <dt>Postcode</dt> <dd> {{ $company->post_postal }}</dd>
                        <dt>Postbus</dt> <dd> {{ $company->postbox }}</dd>
                    </dl>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <dl class="dl-horizontal">
                        <dt>Email</dt> <dd> {{ $company->email }}</dd>
                        <dt>Website</dt> <dd><a href="{{ $company->website }}" class="text-navy"> {{ $company->website }}</a> </dd>
                    </dl>
                </div>
            </div>

        </div>
    </div>

    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Gebruikers in {{ $company->name }}</h5>
        </div>
        <div class="ibox-content">

            <div class="row">
                <div class="col-sm-12">
                    <input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Zoek in gebruikers">
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
                    @foreach($company->users as $user)
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
@endsection
