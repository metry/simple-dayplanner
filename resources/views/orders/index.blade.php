@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Заказы</h1>
        <a href="{{route('orders.create')}}" class="btn btn-link">Новый заказ</a>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td>Заказчик</td>
                <td>Цена, руб.</td>
                <td>Внесено, руб.</td>
                <td>Выполнить</td>
                <td>Тип доставки</td>
                <td>Время доставки/самовывоза</td>
                <td>Информация</td>
                <td>Заказ</td>
                <td>Заказ (фото, примеры)</td>
                <td>Статус</td>
                <td>Изменить</td>
                <td>Удалить</td>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{{route('customers.edit', ['id' => $order->customer->id])}}">{{$order->customer->name}}</a>
                        <br>
                        @if ($order->customer->phone)<a href="tel:{{$order->customer->phone}}">{{$order->customer->phone}}</a>@endif
                    </td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->prepayment}}</td>
                    <td>{{\Carbon\Carbon::parse($order->finished_at)->format('d.m.Y H:i')}}</td>
                    <td>{{$order->delivery->name}}</td>
                    <td>{{\Carbon\Carbon::parse($order->delivery_at)->format('d.m.Y H:i')}}</td>
                    <td>{{$order->info}}</td>
                    <td>{{$order->subject}}</td>
                    <td>
                        @if ($order->subjects->count())
                            @foreach($order->subjects as $subject)
                                <a data-lightbox="subjects-{{$order->id}}" href="/upload/subjects/{{$order->id}}/{{$subject->src}}">
                                    <img src="/upload/subjects/{{$order->id}}/{{$subject->src}}" alt="" class="img-thumbnail" width="32%">
                                </a>
                            @endforeach
                        @endif
                    </td>
                    <td>{{$order->status->name}}</td>
                    <td><a class="btn btn-default" href="{{route('orders.edit', ['id' => $order->id])}}">Изменить</a></td>
                    <td><a class="btn btn-danger" href="{{route('orders.delete', ['id' => $order->id])}}">Удалить</a></td>
                </tr>
            @endforeach
        </table>
        <div class="content-footer__container">
            {{ $orders->links() }}
        </div>
    </div>

@endsection