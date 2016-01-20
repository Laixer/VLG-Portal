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
                <div class="form-group  {{ $errors->has('name') || $errors->has('last_name') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Naam</label>
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
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Email</label>
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
                <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}"><label class="col-sm-2 control-label">Mobiel</label>
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
                       <!--  <div id="tab-2" class="tab-pane">
                            <div class="panel-body">

                                <fieldset class="form-horizontal">
                                    <div class="form-group"><label class="col-sm-2 control-label">ID:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="543"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Model:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="..."></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Location:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="location"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Tax Class:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" >
                                                <option>option 1</option>
                                                <option>option 2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Quantity:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="Quantity"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Minimum quantity:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="2"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Sort order:</label>
                                        <div class="col-sm-10"><input type="text" class="form-control" placeholder="0"></div>
                                    </div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Status:</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" >
                                                <option>option 1</option>
                                                <option>option 2</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>


                            </div>
                        </div>
                        <div id="tab-3" class="tab-pane">
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-stripped table-bordered">

                                        <thead>
                                        <tr>
                                            <th>
                                                Group
                                            </th>
                                            <th>
                                                Quantity
                                            </th>
                                            <th>
                                                Discount
                                            </th>
                                            <th style="width: 20%">
                                                Date start
                                            </th>
                                            <th style="width: 20%">
                                                Date end
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" >
                                                    <option selected>Group 1</option>
                                                    <option>Group 2</option>
                                                    <option>Group 3</option>
                                                    <option>Group 4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="10">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="$10.00">
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                    <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" >
                                                    <option selected>Group 1</option>
                                                    <option>Group 2</option>
                                                    <option>Group 3</option>
                                                    <option>Group 4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="10">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="$10.00">
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" >
                                                    <option selected>Group 1</option>
                                                    <option>Group 2</option>
                                                    <option>Group 3</option>
                                                    <option>Group 4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="10">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="$10.00">
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" >
                                                    <option selected>Group 1</option>
                                                    <option>Group 2</option>
                                                    <option>Group 3</option>
                                                    <option>Group 4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="10">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="$10.00">
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" >
                                                    <option selected>Group 1</option>
                                                    <option>Group 2</option>
                                                    <option>Group 3</option>
                                                    <option>Group 4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="10">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="$10.00">
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" >
                                                    <option selected>Group 1</option>
                                                    <option>Group 2</option>
                                                    <option>Group 3</option>
                                                    <option>Group 4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="10">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="$10.00">
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <select class="form-control" >
                                                    <option selected>Group 1</option>
                                                    <option>Group 2</option>
                                                    <option>Group 3</option>
                                                    <option>Group 4</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="10">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" placeholder="$10.00">
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group date">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" value="07/01/2014">
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                        <div id="tab-4" class="tab-pane">
                            <div class="panel-body">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-stripped">
                                        <thead>
                                        <tr>
                                            <th>
                                                Image preview
                                            </th>
                                            <th>
                                                Image url
                                            </th>
                                            <th>
                                                Sort order
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/2s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image1.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="1">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/1s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image2.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="2">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/3s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image3.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="3">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/4s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image4.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="4">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/5s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image5.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="5">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/6s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image6.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="6">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="img/gallery/7s.jpg">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled value="http://mydomain.com/images/image7.png">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="7">
                                            </td>
                                            <td>
                                                <button class="btn btn-white"><i class="fa fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div> -->

</div>
@endsection
