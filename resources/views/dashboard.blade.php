<?php $nav = 'dashboard'; ?>

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="wrapper wrapper-content">
    <div class="container">

        <div class="row m-b-lg m-t-lg">
            <div class="col-md-6">

                <div class="profile-image">
                    <img src="http://gurucul.com/wp-content/uploads/2015/01/default-user-icon-profile.png" class="img-circle circle-border m-b-md" alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                {{ Auth::user()->formalName() }}
                            </h2>
                            <h4>{{ Auth::user()->type->name }}</h4>
                            <!-- <small>
                                There are many variations of passages of Lorem Ipsum available, but the majority
                                have suffered alteration in some form Ipsum available.
                            </small> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <small>Laatste login</small>
                <h2 class="no-margins">{{ Auth::user()->updated_at->format('d M Y') }}</h2>
            </div>

        </div>

    <h2 class="font-bold">Applicaties</h2>

    <div class="row">
        @foreach(Auth::user()->applications()->get() as $application)
        <div class="col-lg-3">
            <a href="https://{{ $application->domain }}">
                <div class="widget style1 {{ $application->color }}">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa {{ $application->icon }} fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <h2 class="font-bold">{{ $application->name }}</h2>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>

</div>
@endsection
