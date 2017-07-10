@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- todo @makary list component -->
                <!-- <list></list> -->

                <ul class="list-group">
                    @foreach($list->items as $item)
                        <li class="list-group-item">
                            {{ $item->title }} <small>{{ $item->created_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
