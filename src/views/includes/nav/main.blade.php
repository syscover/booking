<li{!! Miscellaneous::setCurrentOpenPage(['booking-voucher']) !!}>
    <a href="javascript:void(0)"><i class="fa fa-book"></i>Booking</a>
    <ul class="sub-menu">
        @if(session('userAcl')->allows('booking-voucher', 'access'))
            <li{{ Miscellaneous::setCurrentPage('booking-voucher') }}><a href="{{ route('bookingVoucher') }}"><i class="fa fa-sort-alpha-asc"></i>Vouchers</a></li>
        @endif
    </ul>
</li>