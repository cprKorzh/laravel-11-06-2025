@extends('layouts.app')

@section('title', 'Заявка принята')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Заявка принята</div>

            <div class="card-body">
                <div class="alert alert-success">
                    <h4 class="alert-heading">Спасибо за вашу заявку!</h4>
                    <p>Ваша заявка принята! Вы выбрали ремонт {{ $order->type }} в количестве {{ $order->count }} на общую сумму {{ $order->getTotalPrice() }} рублей.</p>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('profile.orders') }}" class="btn btn-primary">Мои заявки</a>
                    @if(!Auth::user()->isAdmin())
                        <a href="{{ route('orders.create') }}" class="btn btn-outline-primary ms-2">Создать новую заявку</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
