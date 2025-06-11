@extends('layouts.app')

@section('title', 'Панель администратора')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Панель администратора - Все заявки</div>

            <div class="card-body">
                @if($orders->isEmpty())
                    <div class="alert alert-info">
                        Пока нет заявок в системе.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>ФИО заявителя</th>
                                    <th>Телефон</th>
                                    <th>Email</th>
                                    <th>Тип мебели</th>
                                    <th>Количество</th>
                                    <th>Дата и время</th>
                                    <th>Способ оплаты</th>
                                    <th>Сумма</th>
                                    <th>Дата создания</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->user->lastname }} {{ $order->user->firstname }} {{ $order->user->middlename }}</td>
                                        <td>{{ $order->user->tel }}</td>
                                        <td>{{ $order->user->email }}</td>
                                        <td>{{ $order->type }}</td>
                                        <td>{{ $order->count }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->date)->format('d.m.Y') }} в {{ \Carbon\Carbon::parse($order->time)->format('H:i') }}</td>
                                        <td>
                                            @if($order->payment == 'cash')
                                                Наличными
                                            @elseif($order->payment == 'card')
                                                Банковская карта
                                            @elseif($order->payment == 'bank_transfer')
                                                Безналичный расчет
                                            @endif
                                        </td>
                                        <td>{{ $order->getTotalPrice() }} руб.</td>
                                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
