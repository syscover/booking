<li{!! is_current_resource(['booking-voucher']) !!}>
    <a href="javascript:void(0)"><i class="fa fa-book"></i>Booking</a>
    <ul class="sub-menu">
        @if(is_allowed('booking-voucher', 'access'))
            <li{!! is_current_resource('booking-voucher') !!}><a href="{{ route('bookingVoucher') }}"><i class="fa fa-sort-alpha-asc"></i>Vouchers</a></li>
        @endif
    </ul>
</li>