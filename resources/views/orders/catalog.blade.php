@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Заказы</h1>
        <a href="{{route('orders.create')}}" class="btn btn-link">Новый заказ</a>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td>Заказчик</td>
                <td>Цена, руб.</td>
                <td>Информация</td>
                <td>Заказ</td>
                <td>Итог</td>
                <td>Итог (фото)</td>
                <td>Изменить</td>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>
                        <a href="{{route('customers.edit', ['id' => $order->customer->id])}}">{{$order->customer->name}}</a>
                        <br>
                        @if ($order->customer->phone)<a href="tel:{{$order->customer->phone}}">{{$order->customer->phone}}</a>@endif
                    </td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->info}}</td>
                    <td>{{$order->subject}}</td>
                    <td>{{$order->result}}</td>
                    <td>
                        @if ($order->results->count())
                            @foreach($order->results as $result)
                                <a data-lightbox="results-{{$order->id}}" href="/upload/results/{{$order->id}}/{{$result->src}}">
                                    <img src="/upload/results/{{$order->id}}/{{$result->src}}" alt="" class="img-thumbnail" width="300">
                                </a>
                            @endforeach
                        @endif
                    </td>
                    <td><a class="btn btn-default" href="{{route('orders.edit', ['id' => $order->id])}}">Изменить</a></td>
                </tr>
            @endforeach
        </table>
    </div>

@endsection