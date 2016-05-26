@extends('layouts.templateStore')

@section('categories')
    @include('partials._categories')
@stop

@section('content')
    <div class="col-sm-9 padding-right">
        <div class="features_items"><!--features_items-->
            <h2 class="title text-center">{{ $category->name }}</h2>

            @include('partials._product')

        </div><!--features_items-->
    </div>
@stop