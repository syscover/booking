<!-- booking::voucher.breadcrumbs -->
<li>
    <a href="javascript:void(0)">{{ trans('booking::pulsar.package_name') }}</a>
</li>
<li class="current">
    <a href="{{ route($routeSuffix, ['modal' => 0]) }}">{{ trans_choice($objectTrans, 2) }}</a>
</li>
<!-- /booking::voucher.breadcrumbs -->