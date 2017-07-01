@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @foreach ($categories as $parent)
                        <ul>{{ $parent['title'] }}</ul>
                        @if (isset($parent['childs']))
                            <ul>
                                @foreach ($parent['childs'] as $child)
                                    <li>{{ $child['title'] }}</li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
