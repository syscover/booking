<li{!! is_current_resource(['booking-voucher']) !!}>
    <a href="javascript:void(0)"><i class="fa fa-book"></i>Booking</a>
    <ul class="sub-menu">
        @if(is_allowed('booking-voucher', 'access'))
            <li{!! is_current_resource('booking-voucher') !!}><a href="{{ route('bookingVoucher') }}"><i class="fa fa-sort-alpha-asc"></i>{{ trans_choice('booking::pulsar.voucher', 2) }}</a></li>
        @endif
        @if(is_allowed('booking-place', 'access'))
            <li{!! is_current_resource('booking-place') !!}><a href="{{ route('bookingPlace') }}"><i class="fa fa-map-marker"></i>{{ trans_choice('booking::pulsar.place', 2) }}</a></li>
        @endif
    </ul>
</li>