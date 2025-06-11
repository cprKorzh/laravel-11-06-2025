@extends('layouts.app')

@section('title', 'Главная')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Реставрация мебели</div>

            <div class="card-body">
                <h2 class="text-center mb-4">Добро пожаловать в сервис заявок на ремонт мебели</h2>
                
                <p class="lead">Мы предлагаем профессиональные услуги по реставрации различных видов мебели:</p>
                
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Табуреты
                        <span class="badge bg-primary rounded-pill">от 1500 руб.</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Стулья
                        <span class="badge bg-primary rounded-pill">от 2500 руб.</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Кресла
                        <span class="badge bg-primary rounded-pill">от 5000 руб.</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Диваны
                        <span class="badge bg-primary rounded-pill">от 10000 руб.</span>
                    </li>
                </ul>

                <div class="text-center">
                    @auth
                        @if(!Auth::user()->isAdmin())
                            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-lg">Подать заявку</a>
                        @else
                            <p>Администраторы могут только просматривать заявки</p>
                            <a href="{{ route('admin.orders') }}" class="btn btn-primary">Просмотр заявок</a>
                        @endif
                    @else
                        <p>Для подачи заявки необходимо авторизоваться</p>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary">Вход</a>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary">Регистрация</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
