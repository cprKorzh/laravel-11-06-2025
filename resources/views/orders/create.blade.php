@extends('layouts.app')

@section('title', 'Подать заявку')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Подать заявку на ремонт мебели</div>

            <div class="card-body">
                <form method="POST" action="{{ route('orders.store') }}">
                    @csrf

                    <div class="mb-3 row">
                        <label for="furniture_id" class="col-md-4 col-form-label text-md-end">Тип мебели</label>
                        <div class="col-md-6">
                            <select id="furniture_id" class="form-select @error('furniture_id') is-invalid @enderror" name="furniture_id" required>
                                <option value="">Выберите тип мебели</option>
                                @foreach($furnitures as $furniture)
                                    <option value="{{ $furniture->id }}" data-price="{{ $furniture->price }}" {{ old('furniture_id') == $furniture->id ? 'selected' : '' }}>
                                        {{ $furniture->title }} ({{ $furniture->price }} руб.)
                                    </option>
                                @endforeach
                            </select>
                            @error('furniture_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="count" class="col-md-4 col-form-label text-md-end">Количество единиц</label>
                        <div class="col-md-6">
                            <input id="count" type="number" min="1" max="10" class="form-control @error('count') is-invalid @enderror" name="count" value="{{ old('count', 1) }}" required>
                            @error('count')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="date" class="col-md-4 col-form-label text-md-end">Дата ремонта</label>
                        <div class="col-md-6">
                            <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="time" class="col-md-4 col-form-label text-md-end">Время ремонта</label>
                        <div class="col-md-6">
                            <input id="time" type="time" class="form-control @error('time') is-invalid @enderror" name="time" value="{{ old('time') }}" required>
                            @error('time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-md-4 col-form-label text-md-end">Способ оплаты</label>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment_cash" value="cash" {{ old('payment') == 'cash' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="payment_cash">
                                    Наличными
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment_card" value="card" {{ old('payment') == 'card' ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment_card">
                                    Банковская карта
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment" id="payment_bank_transfer" value="bank_transfer" {{ old('payment') == 'bank_transfer' ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment_bank_transfer">
                                    Безналичный расчет
                                </label>
                            </div>
                            @error('payment')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-md-6 offset-md-4">
                            <div class="alert alert-info" id="total-price">
                                Общая стоимость: <span id="price-value">0</span> руб.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Отправить заявку
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const furnitureSelect = document.getElementById('furniture_id');
        const countInput = document.getElementById('count');
        const priceValue = document.getElementById('price-value');

        function updateTotalPrice() {
            const selectedOption = furnitureSelect.options[furnitureSelect.selectedIndex];
            const price = selectedOption ? parseInt(selectedOption.dataset.price || 0) : 0;
            const count = parseInt(countInput.value || 1);
            const total = price * count;
            priceValue.textContent = total;
        }

        furnitureSelect.addEventListener('change', updateTotalPrice);
        countInput.addEventListener('input', updateTotalPrice);

        // Initialize price
        updateTotalPrice();
    });
</script>
@endsection
