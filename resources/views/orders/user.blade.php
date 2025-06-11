@extends('layouts.app')

@section('title', 'Мои заявки')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Мои заявки</span>
                @if(!Auth::user()->isAdmin())
                    <a href="{{ route('orders.create') }}" class="btn btn-sm btn-primary">Создать новую заявку</a>
                @endif
            </div>

            <div class="card-body">
                @if($orders->isEmpty())
                    <div class="alert alert-info">
                        У вас пока нет заявок. 
                        @if(!Auth::user()->isAdmin())
                            <a href="{{ route('orders.create') }}">Создать заявку</a>
                        @endif
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>№</th>
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
