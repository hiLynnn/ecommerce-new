@extends('admin.layouts.app')

@section('title', 'Thêm khuyến mãi')

@section('header', 'Thêm khuyến mãi mới')

@section('content')
    <div class="bg-white rounded-lg shadow-lg p-6">
        @if (Session::has('message'))
            <div class="alert alert-success">{{ Session::get('message') }}</div>
            @php Session::forget('message'); @endphp
        @endif

        <form action="{{ route('admin.khuyen-mai.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="promotions_name" class="form-label required">Tên mã giảm giá</label>
                <input type="text" name="promotions_name" id="promotions_name" class="form-input" placeholder="Nhập tên mã giảm giá" required>
                @error('promotions_name') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="start_promotions" class="form-label required">Ngày bắt đầu</label>
                <input type="date" name="promotionsdate_start" id="start_promotions" class="form-input" required>
                @error('promotionsdate_start') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="end_promotions" class="form-label required">Ngày kết thúc</label>
                <input type="date" name="promotionsdate_end" id="end_promotions" class="form-input" required>
                @error('promotionsdate_end') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="promotions_code" class="form-label required">Mã giảm giá</label>
                <input type="text" name="promotions_code" id="promotions_code" class="form-input" placeholder="Nhập mã giảm giá" required>
                @error('promotions_code') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="promotions_times" class="form-label required">Số lượng mã</label>
                <input type="number" name="promotions_times" id="promotions_times" class="form-input" required>
                @error('promotions_times') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="promotions_condition" class="form-label required">Tính năng mã</label>
                <select name="promotions_condition" id="promotions_condition" class="form-input" required>
                    <option value="">-- Chọn --</option>
                    <option value="1">Giảm theo phần trăm</option>
                    <option value="2">Giảm theo tiền</option>
                </select>
                @error('promotions_condition') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="mb-4">
                <label for="promotions_number" class="form-label required">Nhập số phần trăm hoặc tiền</label>
                <input type="number" step="0.01" name="promotions_number" id="promotions_number" class="form-input" required>
                @error('promotions_number') <div class="text-red-500">{{ $message }}</div> @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('admin.khuyen-mai.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Quay lại
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Lưu khuyến mãi
                </button>
            </div>
        </form>
    </div>
@endsection


@section('javascript')
<script>
    $(function() {
        $("#start_promotions, #end_promotions").datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ['CN', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7'],
            duration: "fast"
        });
    });

</script>
@endsection
