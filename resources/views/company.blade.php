<?php
$nav = 'account';
$company = Auth::user()->company;
$company_member_count = App\User::where('companies_id', $company->id)->count();
?>

@extends('layouts.app')

@section('title', 'Organisaties')

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

</div>
@endsection
