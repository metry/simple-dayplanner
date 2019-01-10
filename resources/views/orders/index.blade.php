@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-md-2 text-center">
                <a href="{{route('orders.create')}}" class="h1 btn btn-default">Новый заказ</a>
            </div>
        </div>
        <hr>
        @foreach($orders as $order)
        <div class="text-center panel
        @if ($order->status->name == 'Заказ отдан')
            panel-success
        @elseif ($order->status->name == 'Выполнен, ждет доставки')
            panel-info
        @else
            panel-primary
        @endif
        ">
            <div class="panel-heading">
                {{$order->status->name}}
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
                    @if ($order->customer->address)
                    <hr class="hidden-md hidden-lg">
                    <div class="row">
                        <div class="col-xs-12">
                            <span class="ymaps-geolink">{{$order->customer->address}}</span>
                        </div>
                    </div>
                    @endif
                </div>
                <hr class="hidden-md hidden-lg">
                <div class="col-md-3">
                    <div class="row text-left">
                        <div class="col-xs-12">
                            Внесли <b>{{ number_format($order->prepayment) }}</b>
                            из <b>{{ number_format($order->price) }}</b>
                            @if ($order->prepayment < $order->price)(Долг:  <b class="text-danger">{{ number_format($order->price - $order->prepayment)  }}</b> р.)@endif
                        </div>
                    </div>
                    <div class="row text-left">
                        <div class="col-sm-12">
                            Выполнить: <b>{{\Carbon\Carbon::parse($order->finished_at)->format('d.m.Y H:i')}}</b>
                        </div>
                    </div>
                    <div class="row text-left">
                        <div class="col-sm-12">
                            <b>{{$order->delivery->name}}</b>: <b>{{\Carbon\Carbon::parse($order->delivery_at)->format('d.m.Y H:i')}}</b>
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
                <div class="col-md-2 text-left">
                    @if ($order->subjects->count())
                        <hr class="hidden-md hidden-lg">
                        @foreach($order->subjects as $subject)
                            <a data-lightbox="subjects-{{$order->id}}" href="/upload/subjects/{{$order->id}}/{{$subject->src}}">
                                <img src="/upload/subjects/{{$order->id}}/{{$subject->src}}" alt="" class="img-thumbnail" width="30%">
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-xs-6 text-left">
                        <a class="btn btn-default btn-sm" href="{{route('orders.edit', ['id' => $order->id])}}">
                            Изменить заказ
                        </a>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a class="btn btn-default btn-sm" href="{{route('orders.delete', ['id' => $order->id])}}" onclick="return confirm('Вы уверены, что хотите удалить заказ?')">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row">
            {{ $orders->links() }}
        </div>
    </div>
@endsection