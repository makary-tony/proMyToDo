@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Your todo lists</div>

                    <div class="panel-body">
                        <!-- todo @makary lists component -->
                        <lists></lists>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
