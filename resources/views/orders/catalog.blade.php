@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Каталог</h1>
        <hr>
        @foreach($orders as $order)
        <div class="text-center panel panel-info">
            <div class="panel-heading">
                Цена: <b>{{ number_format($order->price) }}</b> р.
            </div>
            <div class="panel-body">
                <div class="col-md-2">
                    <p>
                        @if ($order->customer->is_confectioner)
                            <span class="glyphicon glyphicon-cutlery text-left"></span>
                        @endif
                        {{$order->customer->name}}
                    </p>
                    <div class="row">
                        <div class="col-xs-3">
                            @if ($order->customer->phone)
                                <a href="tel:{{$order->customer->phone}}">
                                    <span class="glyphicon glyphicon-earphone text-left"></span>
                                </a>
                            @endif
                        </div>
                        <div class="col-xs-3">
                            @if ($order->customer->phone)
                                <a href="https://wa.me/{{$order->customer->phone_numeric}}">
                                    <span class="glyphicon glyphicon-send text-right"></span>
                                </a>
                            @endif
                        </div>
                        <div class="col-xs-3">
                            <a href="{{route('customers.edit', ['id' => $order->customer->id])}}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </div>
                        <div class="col-xs-3">
                            <a href="{{route('orders.customer', ['id' => $order->customer->id])}}">
                                <span class="glyphicon glyphicon-th-list"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 text-left">
                    @if ($order->info)
                        <hr class="hidden-md hidden-lg">
                        <small>{{ str_limit($order->info, 95) }}</small>
                        @if ( mb_strlen($order->info) > 95 )
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg" data-content="{{ $order->info }}">
                                <small class="glyphicon glyphicon-search"></small>
                            </button>
                        @endif
                    @endif
                </div>
                <div class="col-md-3 text-left">
                    @if ($order->subject)
                        <hr class="hidden-md hidden-lg">
                        <small>{{ str_limit($order->subject, 95) }}</small>
                        @if ( mb_strlen($order->subject) > 95 )
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg" data-content="{{ $order->subject }}">
                                <small class="glyphicon glyphicon-search"></small>
                            </button>
                        @endif
                    @endif
                </div>
                <div class="col-md-3 text-left">
                    @if ($order->result)
                        <hr class="hidden-md hidden-lg">
                        <small>{{ str_limit($order->result, 95) }}</small>
                        @if ( mb_strlen($order->result) > 95 )
                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg" data-content="{{ $order->result }}">
                                <small class="glyphicon glyphicon-search"></small>
                            </button>
                        @endif
                    @endif
                </div>
                <div class="col-md-2 text-left">
                    @if ($order->results->count())
                        <hr class="hidden-md hidden-lg">
                        @foreach($order->results as $result)
                            <a data-lightbox="results-{{$order->id}}" href="/upload/results/{{$order->id}}/{{$result->src}}">
                                <img src="/upload/results/{{$order->id}}/{{$result->src}}" alt="" class="img-thumbnail" width="48%">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-xs-12 text-left">
                        <a class="btn btn-default btn-sm" href="{{route('orders.edit', ['id' => $order->id])}}">
                            Изменить заказ
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection