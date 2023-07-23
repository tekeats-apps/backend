@extends('vendor.layouts.main')
@section('title')
    {{ __('Restaurant Opening Hours') }}
@endsection
@section('content')
    {{-- Breadcrumbs Component --}}
    @component('vendor.layouts.components.breadcrumb')
        @slot('li_1')
            {{ __('Restaurant Opening Hours') }}
        @endslot
        @slot('title')
            {{ __('Manage Restaurant Opening Hours') }}
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">{{ __('Restaurant Opening Hours') }}</h5>
                </div>
                <form action="{{ route('vendor.settings.store.opening.hours') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <p class="text-muted">Welcome to the Timing Settings page! Here you can set your restaurant's opening
                            and
                            closing hours, ensuring your customers know when you're open for business. 🕰️🍽️</p>
                        <div class="row mt-5">

                            @foreach ($days as $day)
                                <div class="row mb-3">
                                    <label class="col-md-2 col-form-label text-end">{{ $day }}</label>
                                    @php
                                        $day = strtolower($day);
                                        $openingHour = $openingHours->firstWhere('day', $day);
                                        $slots = optional($openingHour)->slots ?? [['open_time' => '', 'close_time' => '']];
                                    @endphp
                                    <div class="col-md-7 slot-box">
                                        @foreach ($slots as $index => $slot)
                                            <div id="slot-{{ $day }}-{{ $index }}"
                                                class="slot-container row {{ $index != 0 ? 'mt-3' : '' }}">
                                                <div class="col-md-4">
                                                    <input type="time"
                                                        class="form-control @error('opening_hours.' . $day . '.slots.' . $index . '.open_time') is-invalid @enderror"
                                                        name="opening_hours[{{ $day }}][slots][{{ $index }}][open_time]"
                                                        value="{{ old('opening_hours.' . $day . '.slots.' . $index . '.open_time', $slot['open_time']) }}">
                                                    @error('opening_hours.' . $day . '.slots.' . $index . '.open_time')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="time"
                                                        class="form-control @error('opening_hours.' . $day . '.slots.' . $index . '.close_time') is-invalid @enderror"
                                                        name="opening_hours[{{ $day }}][slots][{{ $index }}][close_time]"
                                                        value="{{ old('opening_hours.' . $day . '.slots.' . $index . '.close_time', $slot['close_time']) }}">
                                                    @error('opening_hours.' . $day . '.slots.' . $index . '.close_time')
                                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                @if ($index != 0)
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-danger remove-slot"
                                                            data-target="#slot-{{ $day }}-{{ $index }}">Remove</button>
                                                    </div>
                                                @else
                                                    <div class="col-md-2">
                                                        <button type="button" class="btn btn-secondary add-slot"
                                                            data-day="{{ $day }}">Add Slot</button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col-md-1">
                                        <input type="checkbox" class="form-check-input"
                                            name="opening_hours[{{ $day }}][is_closed]" value="1"
                                            {{ old('opening_hours.' . $day . '.is_closed', optional($openingHour)->is_closed) ? 'checked' : '' }}
                                            id="{{ 'closed-' . $day }}">
                                        <label class="form-check-label" for="{{ 'closed-' . $day }}">Closed</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="text-end">
                            <button type="submit" class="btn btn-success w-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.add-slot').on('click', function() {
                var day = $(this).data('day');
                var slotRow = $(this).closest('.slot-box');
                var slotCount = slotRow.find('.slot-container').length;
                var slotContainer = $('<div id="slot-' + day + '-' + slotCount +
                    '" class="slot-container row mt-3">');
                var openTimeInputDiv = $('<div class="col-md-4">');
                var openTimeInput = $('<input type="time" class="form-control" name="opening_hours[' +
                    day + '][slots][' + slotCount + '][open_time]">');
                openTimeInputDiv.append(openTimeInput);
                slotContainer.append(openTimeInputDiv);

                var closeTimeInputDiv = $('<div class="col-md-4">');
                var closeTimeInput = $('<input type="time" class="form-control" name="opening_hours[' +
                    day + '][slots][' + slotCount + '][close_time]">');
                closeTimeInputDiv.append(closeTimeInput);
                slotContainer.append(closeTimeInputDiv);

                var removeSlotButtonDiv = $('<div class="col-md-2">');
                var removeSlotButton = $(
                    '<button type="button" class="btn btn-danger remove-slot" data-target="#slot-' +
                    day + '-' + slotCount + '">Remove</button>');
                removeSlotButtonDiv.append(removeSlotButton);
                slotContainer.append(removeSlotButtonDiv);

                slotRow.append(slotContainer);

                $('.remove-slot').off('click').on('click', function() {
                    var target = $(this).data('target');
                    $(target).remove();
                });
            });

            $('.remove-slot').on('click', function() {
                var target = $(this).data('target');
                $(target).remove();
            });
        });
    </script>
@endpush
