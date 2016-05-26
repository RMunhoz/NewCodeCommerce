@extends('layouts.templateStore')

@section('categories')
    @include('partials._categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">{{ $tag->name }}</h2>

            @include('partials._product', ['products'=> $products])

        </div><!--features_items-->
    </div>
@stop