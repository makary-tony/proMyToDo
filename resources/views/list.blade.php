@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="background-color: #ffffff">
                <!-- todo @makary list component -->
                <!-- <list></list> -->

                <div class="panel-heading" style="text-align: center;margin-left: -55px; font-size: 25px;"> {{$list->name}} </div>
            
                <list :list-id="{{$list->id}}"></list>
    
            </div>
        </div>
    </div>
@endsection
