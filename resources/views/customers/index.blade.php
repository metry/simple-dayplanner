@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Заказчики</h1>
        <a href="{{route('customers.create')}}" class="btn btn-link">Добавить заказчика</a>
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <td>ФИО</td>
                <td>Телефон</td>
                <td>Email</td>
                <td>Instagram</td>
                <td>Vk</td>
                <td>Адрес</td>
                <td>Тип</td>
                <td>Информация</td>
                <td>Рейтинг лояльности</td>
                <td>Всего заказов</td>
                <td>Изменить</td>
                <td>Удалить</td>
            </tr>
            @foreach($customers as $customer)
                <tr>
                    <td>{{$customer->name}}</td>
                    <td>@if ($customer->phone)<a href="tel:{{$customer->phone}}">{{$customer->phone}}</a>@endif</td>
                    <td>@if ($customer->email)<a href="mailto:{{$customer->email}}">{{$customer->email}}</a>@endif</td>
                    <td>@if ($customer->instagram)<a href="{{$customer->instagram}}"><i class="fab fa-instagram fa-2x"></i></a>@endif</td>
                    <td>@if ($customer->vk)<a href="{{$customer->vk}}"><i class="fab fa-vk fa-2x"></i></a>@endif</td>
                    <td>@if ($customer->address)<span class="ymaps-geolink">{{$customer->address}}</span>@endif</td>
                    <td>@if ($customer->is_confectioner)Кондитер@elseЧастное лицо@endif</td>
                    <td>{{$customer->info}}</td>
                    <td>{{$customer->loyalty}}</td>
                    <td>@if ($customer->orders->count())<a href="{{route('orders.customer', ['id' => $customer->id])}}">{{$customer->orders->count()}}</a>@endif</td>
                    <td><a class="btn btn-default" href="{{route('customers.edit', ['id' => $customer->id])}}">Изменить</a></td>
                    <td><a class="btn btn-danger" href="{{route('customers.delete', ['id' => $customer->id])}}">Удалить</a></td>
                </tr>
            @endforeach
        </table>
        <div class="content-footer__container">
            {{ $customers->links() }}
        </div>
    </div>

@endsection