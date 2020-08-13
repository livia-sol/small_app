@extends('layout.app')

@section('content')

<div class="centered">
    <div class="card" style="width: 25rem;">
        <div class="card-body">
            <h5 class="card-title">{{ __('app.title_quiz') }}</h5>
            <hr>

            {{ Form::open( ['url' => route('user.store') ] ) }}
            <p class="card-text">
                <div class="text-primary">
                    <div class="row form-group">
                        <label class="col-3">{{ __('app.name') }}</label>
                        <div class="col-9">
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="col-3">{{ __('app.email') }}</label>
                        <div class="col-9">
                            {{ Form::text('email', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="row">
                        <p class="col-12">{{ __('app.question') }}</p>
                    </div>
                    <ul class="list-group">
                        @foreach($responses as $key => $response)    
                        <li class="list-group-item">
                            {{ Form::radio( "response", $response, false, ['id' => "check".$key] ) }}
                            <label for="check-{{ $key }}">{{ $response }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>
              </p>
                <div class = 'centered'>
                {{ Form::submit( __('app.submit'), ['class' => 'btn btn-primary px-5'] )  }}
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

@endsection