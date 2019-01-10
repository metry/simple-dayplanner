@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Новый заказ</h1>
        <hr>
        <form action="{{route('orders.store')}}" method="post" enctype="multipart/form-data">
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
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="customer_id">Заказчик</label>
                    <select class="form-control" id="customer_id" name="customer_id">
                        @foreach ($customers as $customer)
                            <option @if (old('customer_id')==$customer->id) selected @endif value="{{$customer->id}}">{{$customer->phone}} / {{$customer->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="customer_search">Поиск</label>
                    <input class="form-control" type="text" id="customer_search">
                </div>
                <div class="form-group col-md-4">
                    <label for="customer_search">Добавить нового заказчика</label>
                    <a class="form-control btn btn-primary" href="{{route('customers.create')}}">Добавить</a>
                </div>
            </div>
            <hr class="hidden-md hidden-lg">
            <div class="form-group">
                <label for="price">Цена, руб.</label>
                <input type="number" min="0" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}">
            </div>
            <div class="form-group">
                <label for="prepayment">Внесено, руб.</label>
                <input type="number" min="0" step="0.01" class="form-control" id="prepayment" name="prepayment" value="{{ old('prepayment') ? old('prepayment') : 0 }}">
            </div>
            <hr class="hidden-md hidden-lg">
            <div class="form-group">
                <label for="finished_at">Выполнить</label>
                <input type="datetime-local" class="form-control" id="finished_at" name="finished_at" value="{{ old('finished_at') }}">
            </div>
            <div class="form-group">
                <label for="delivery_id">Тип доставки</label>
                <select class="form-control" id="delivery_id" name="delivery_id">
                    @foreach ($deliveries as $delivery)
                        <option @if (old('delivery_id')==$delivery->id) selected @endif value="{{$delivery->id}}">{{$delivery->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="delivery_at">Время доставки/самовывоза</label>
                    <input type="datetime-local" class="form-control" id="delivery_at" name="delivery_at" value="{{ old('delivery_at') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="copy_finished_at">Продублировать из "Выполнить"</label>
                    <button type="button" class="form-control btn btn-primary copy_finished_at">Продублировать</button>
                </div>
            </div>
            <div class="form-group">
                <label for="info">Информация</label>
                <textarea class="form-control" id="info" rows="3" name="info">{{ old('info') }}</textarea>
            </div>
            <hr class="hidden-md hidden-lg">
            <div class="form-group">
                <label for="is_need_cake">Хотел ли торт</label>
                <select id="is_need_cake" name="is_need_cake" class="form-control">
                    <option value="0" @if (old("is_need_cake")==0) selected @endif >Нет</option>
                    <option value="1" @if (old("is_need_cake")==1) selected @endif >Да</option>
                </select>
            </div>
            <hr class="hidden-md hidden-lg">
            <div class="form-group">
                <label for="subject">Заказ</label>
                <textarea class="form-control" id="subject" rows="8" name="subject">{{ old('subject') }}</textarea>
            </div>
            <div class="form-group">
                <label for="subject_photo">Заказ (фото, примеры)</label>
                <input type="file" class="form-control-file" id="subject_photo" multiple name="subject_photo[]">
            </div>
            <hr class="hidden-md hidden-lg">
            <div class="form-group">
                <label for="result">Итог</label>
                <textarea class="form-control" id="result" rows="3" name="result">{{ old('result') }}</textarea>
            </div>
            <div class="form-group">
                <label for="result_photo">Итог (фото)</label>
                <input type="file" class="form-control-file" id="result_photo" multiple name="result_photo[]">
            </div>
            <hr class="hidden-md hidden-lg">
            <div class="form-group">
                <label for="is_in_catalog">Отображать в каталоге</label>
                <select id="is_in_catalog" name="is_in_catalog" class="form-control">
                    <option value="0" @if (old("is_in_catalog")==0) selected @endif >Нет</option>
                    <option value="1" @if (old("is_in_catalog")==1) selected @endif >Да</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status_id">Статус</label>
                <select class="form-control" id="status_id" name="status_id">
                    @foreach ($statuses as $status)
                        <option @if (old('status_id')==$status->id) selected @endif value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="text-center">
                <hr>
                <button type="submit" class="btn btn-primary btn-lg">Создать</button>
                <hr>
            </div>
        </form>
    </div>
@endsection