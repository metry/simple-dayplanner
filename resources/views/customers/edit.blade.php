@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h1 class="text-center">Изменить заказчика</h1>
            </div>
            @if ($customer->orders->count())
            <div class="col-md-2 text-center">
                <a href="{{route('orders.customer', ['id' => $customer->id])}}" class="h1 btn btn-default">Все заказы данного заказчика</a>
            </div>
            @endif
        </div>
        <hr>
        <form action="{{route('customers.update', ['id' => $customer->id])}}" method="post">
            {{csrf_field()}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-group">
                <label for="name">ФИО</label>
                <input type="text" class="form-control" id="name" placeholder="Ввидите ФИО" name="name" value="{{$customer->name}}">
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="tel" class="form-control" id="phone" placeholder="+7 111 111-11-11" name="phone" value="{{$customer->phone}}">
            </div>
            <div class="form-group">
                <label for="email">Адрес электронной почты</label>
                <input type="email" class="form-control" id="phone" placeholder="user@mail.me" name="email" value="{{$customer->email}}">
            </div>
            <div class="form-group">
                <label for="instagram">Instagram</label>
                <input type="text" class="form-control" id="instagram" placeholder="https://www.instagram.com/instagram/" name="instagram" value="{{$customer->instagram}}">
            </div>
            <div class="form-group">
                <label for="vk">Vk</label>
                <input type="text" class="form-control" id="vk" placeholder="https://vk.com/id1" name="vk" value="{{$customer->vk}}">
            </div>
            <div class="form-group">
                <label for="address">Расположение (адрес)</label>
                <input type="text" class="form-control" id="address" placeholder="Москва, Тверская, 13" name="address" value="{{$customer->address}}">
            </div>
            <div class="form-group">
                <label for="is_confectioner">Частное лицо/Кондитер</label>
                <select id="is_confectioner" name="is_confectioner" class="form-control">
                    <option value="0" @if ($customer->is_confectioner==0) selected @endif >Частное лицо</option>
                    <option value="1" @if ($customer->is_confectioner==1) selected @endif >Кондитер</option>
                </select>
            </div>
            <div class="form-group">
                <label for="info">Информация</label>
                <textarea class="form-control" id="info" rows="3" name="info">{{$customer->info}}</textarea>
            </div>
            <div class="form-group">
                <label for="loyalty">Рейтинг лояльности</label>
                <select id="loyalty" name="loyalty" class="form-control">
                    @for ($i = -5; $i < 6; $i++)
                        <option value="{{ $i }}" @if ($i == $customer->loyalty) selected @endif >{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="text-center">
                <hr>
                <button type="submit" class="btn btn-primary btn-lg">Обновить</button>
                <hr>
            </div>
        </form>
    </div>
@endsection