@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 text-center">
                <form class="form-inline" action="{{route('customers.search')}}">
                    <div class="input-group h1">
                        <input type="text" class="form-control" placeholder="Искать..." name="q">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
            </div>
            <div class="col-md-8 text-center">
                <h1>{{ $title }}</h1>
            </div>
            <div class="col-md-2 text-center">
                <a href="{{route('customers.create')}}" class="h1 btn btn-default">Добавить заказчика</a>
            </div>
        </div>
        <hr>
        @foreach($customers as $customer)
        <div class="text-center panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-4 text-left">
                        @if ($customer->is_confectioner)Кондитер <span class="glyphicon glyphicon-cutlery text-left"></span>@elseЧастное лицо@endif
                    </div>
                    <div class="col-xs-4 text-center">
                        <b>{{ $customer->name }}</b>
                    </div>
                    <div class="col-xs-4 text-right">
                        {{ $customer->phone }}
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-xs-2">
                            @if ($customer->phone)
                                <a href="tel:{{$customer->phone}}">
                                    <span class="glyphicon glyphicon-earphone text-left"></span>
                                </a>
                            @endif
                        </div>
                        <div class="col-xs-2">
                            @if ($customer->phone)
                                <a href="https://wa.me/{{$customer->phone_numeric}}">
                                    <span class="glyphicon glyphicon-send text-right"></span>
                                </a>
                            @endif
                        </div>
                        <div class="col-xs-2">
                            <a href="{{route('customers.edit', ['id' => $customer->id])}}">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            <a href="{{route('orders.customer', ['id' => $customer->id])}}">
                                <span class="glyphicon glyphicon-th-list"></span>
                            </a>
                        </div>
                        <div class="col-xs-2">
                            @if ($customer->instagram)
                                <a href="{{$customer->instagram}}">
                                    <i class="fab fa-instagram" style="font-size:17px;"></i>
                                </a>
                            @endif
                        </div>
                        <div class="col-xs-2">
                            @if ($customer->vk)
                                <a href="{{$customer->vk}}">
                                    <i class="fab fa-vk" style="font-size:17px;"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="hidden-md hidden-lg">
                <div class="col-md-3">
                    <div class="row text-left">
                        <div class="col-xs-12">
                            @if ($customer->address)
                                <span class="ymaps-geolink">{{$customer->address}}</span>
                            @else
                                Адрес не указан
                            @endif
                        </div>
                    </div>
                </div>
                <hr class="hidden-md hidden-lg">
                <div class="col-md-2 text-left">
                    @if ($customer->email)
                        <a href="mailto:{{$customer->email}}">
                            {{$customer->email}}
                        </a>
                    @else
                        E-mail не указан
                    @endif
                </div>
                <hr class="hidden-md hidden-lg">
                <div class="col-md-2 col-xs-4 text-left">
                    <small>{{$customer->info}}</small>
                </div>
                <div class="col-md-1 col-xs-4 text-center">
                    @if ($customer->loyalty > 0)
                        <span class="glyphicon glyphicon-thumbs-up"></span> +{{$customer->loyalty}}
                    @elseif ($customer->loyalty == 0)
                        <span class="glyphicon glyphicon-question-sign"></span>
                    @else
                        <span class="glyphicon glyphicon-thumbs-down"></span> {{$customer->loyalty}}
                    @endif
                </div>
                <div class="col-md-1 col-xs-4 text-right">
                    Зак: <b>{{$customer->orders->count()}}</b>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-xs-6 text-left">
                        <a class="btn btn-default btn-sm" href="{{route('customers.edit', ['id' => $customer->id])}}">
                            Изменить заказчика
                        </a>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a class="btn btn-default btn-sm" href="{{route('customers.delete', ['id' => $customer->id])}}" onclick="return confirm('Вы уверены, что хотите удалить заказчика?')">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row">
            {{ $customers->appends(['q' => Request::get('q')])->links() }}
        </div>
    </div>

@endsection