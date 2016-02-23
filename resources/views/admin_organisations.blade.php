<?php $nav = 'admin'; ?>

@extends('layouts.app')

@section('title', 'Organisaties')

@section('content')
<div class="wrapper wrapper-content">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Organisaties</h5>
                </div>
                <div class="ibox-content">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <input type="text" class="form-control" id="filter" placeholder="Zoek in organisaties">
                                <span class="input-group-btn">
                                    <a href="{{ url('/admin/company/new') }}" class="btn btn-primary ">Nieuwe organisatie</a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <table class="footable table table-stripped" style="margin-top:20px;" data-page-size="8" data-filter=#filter>
                        <thead>
                            <tr>
                                <th>Organisatie</th>
                                <th data-sort-ignore="true">Email</th>
                                <th data-sort-ignore="true">Website</th>
                                <th>Actief</th>
                                <th data-sort-ignore="true"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(App\Company::all() as $company)
                            <tr>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->website }}</td>
                                <td>
                                    @if ($company->isActive())
                                    <i class="fa fa-check text-navy"></i>
                                    @else
                                    <i class="fa fa-times text-danger"></i>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{ url('/admin/company') . '?id=' . $company->id }}" class="btn-white btn btn-xs no-margins">Bekijken</a>
                                        <a href="{{ url('/admin/company/edit') . '?id=' . $company->id }}" class="btn-white btn btn-xs no-margins">Bewerk</a>
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
