<li{!! is_current_resource(['booking-place','booking-voucher','booking-campaign','booking-product-prefix','booking-family','booking-preference']) !!}>
    <a href="javascript:void(0)"><i class="fa fa-book"></i>Booking</a>
    <ul class="sub-menu">
        @if(is_allowed('booking-voucher', 'access'))
            <li{!! is_current_resource('booking-booking') !!}><a href="{{ route('bookingBooking') }}"><i class="fa fa-hourglass-end"></i>{{ trans_choice('booking::pulsar.booking', 2) }}</a></li>
        @endif
        @if(is_allowed('booking-voucher', 'access'))
            <li{!! is_current_resource('booking-booking-draft') !!}><a href="{{ route('bookingBookingDraft') }}"><i class="fa fa-hourglass-half"></i>{{ trans_choice('booking::pulsar.booking_draft', 2) }}</a></li>
        @endif
        @if(is_allowed('booking-voucher', 'access'))
            <li{!! is_current_resource('booking-voucher') !!}><a href="{{ route('bookingVoucher') }}"><i class="fa fa-sort-alpha-asc"></i>{{ trans_choice('booking::pulsar.voucher', 2) }}</a></li>
        @endif
        @if(is_allowed('booking-master-tables', 'access'))
            <li{!! is_current_resource(['booking-campaign','booking-place','booking-product-prefix','booking-family','booking-preference'], true) !!}>
                <a href="javascript:void(0)"><i class="icomoon-icon-grid"></i>{{ trans('pulsar::pulsar.master_tables') }}</a>
                <ul class="sub-menu" >
                    @if(is_allowed('booking-campaign', 'access'))
                        <li{!! is_current_resource('booking-campaign') !!}><a href="{{ route('bookingCampaign') }}"><i class="fa fa-bookmark"></i>{{ trans_choice('booking::pulsar.campaign', 2) }}</a></li>
                    @endif
                    @if(is_allowed('booking-family', 'access'))
                        <li{!! is_current_resource('booking-family') !!}><a href="{{ route('bookingFamily') }}"><i class="fa fa-align-justify"></i>{{ trans_choice('pulsar::pulsar.family', 2) }}</a></li>
                    @endif
                    @if(is_allowed('booking-place', 'access'))
                        <li{!! is_current_resource('booking-place') !!}><a href="{{ route('bookingPlace') }}"><i class="fa fa-map-marker"></i>{{ trans_choice('booking::pulsar.place', 2) }}</a></li>
                    @endif
                    @if(is_allowed('booking-product-prefix', 'access'))
                        <li{!! is_current_resource('booking-product-prefix') !!}><a href="{{ route('bookingProductPrefix') }}"><i class="fa fa-barcode"></i>{{ trans_choice('booking::pulsar.product_prefix', 2) }}</a></li>
                    @endif
                    @if(is_allowed('booking-preference', 'access'))
                        <li{!! is_current_resource('booking-preference') !!}><a href="{{ route('bookingPreference') }}"><i class="fa fa-cog"></i>{{ trans_choice('pulsar::pulsar.preference', 2) }}</a></li>
                    @endif
                </ul>
            </li>
        @endif
    </ul>
</li>