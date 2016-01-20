<?php $nav = 'faq'; ?>

@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="wrapper wrapper-content">

    <div class="ibox-content m-b-sm border-bottom">
        <div class="text-center p-lg">
            <h2>Frequently Asked Questions</h2>
        </div>
    </div>

    @if (Auth::user()->isAdmin())
    <form action="{{ url('/admin/faq') }}" method="post">
        {!! csrf_field() !!}
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label" for="product_name">Topic</label>
                        <input type="text" name="name" placeholder="Onderwerp" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label class="control-label" for="price">Omschijving</label>
                        <textarea id="price" name="description" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group text-right">
                        <button class="btn btn-primary" type="submit">Opslaan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif

    @foreach(App\Faq::all() as $faq)
    <div class="faq-item">
        <div class="row">
            <div class="col-md-7">
                <a data-toggle="collapse" href="#faq{{ $faq->id }}" class="faq-question">{{ $faq->name }}</a>
            </div>
            @if (Auth::user()->isAdmin())
            <div class="col-md-5 text-right">
                <a href="{{ url('/admin/faq/delete') . '?id=' . $faq->id }}" class="btn-danger btn btn-sm">Verwijderen</a>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div id="faq{{ $faq->id }}" class="panel-collapse collapse ">
                    <div class="faq-answer">
                        <p>{{ $faq->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

</div>
@endsection
