@extends('pulsar::layouts.email')

@section('mainContent')
<table cellspacing="0" cellpadding="0" width="100%" style="background:#ffffff;margin:0;padding:0;border:0;text-align:left;border-collapse:collapse;border-spacing:0">
    <tr>
        <td colspan="2" class="header_body brown" valign="middle" width="100%" style='background:#ffffff;text-align:left;font-size:15px;line-height:19px;font-family:"Helvetica Neue",helvetica,arial,sans-serif;border-collapse:collapse;padding:0;border-spacing:0;vertical-align:middle;padding-left:10px;width:auto !important;'>
            <strong>{{ trans('booking::pulsar.bulk_vouchers_create', ['totalVouchers' => $totalVouchers, 'id' => $voucher->id_226]) }}</strong>
        </td>
    </tr>
    <tr>
        <td colspan="2" width="100%">&nbsp;</td>
    </tr>
    <!-- voucher -->
    <tr>
        <td colspan="2" class="header_body brown" valign="middle" width="100%" style='background:#ffffff;text-align:left;font-size:15px;line-height:19px;font-family:"Helvetica Neue",helvetica,arial,sans-serif;border-collapse:collapse;padding:0;border-spacing:0;vertical-align:middle;padding-left:10px;width:auto !important'>
            <strong style="color:brown;">{{ trans_choice('booking::pulsar.voucher', 1) }}</strong>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans('pulsar::pulsar.prefix') }}:</strong> {{ $voucher->code_prefix_226 }}
            </div>
            <br>
        </td>
    </tr>
    @if(! empty($voucher->invoice_code_226))
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans_choice('pulsar::pulsar.invoice', 1) }}:</strong> {{ $voucher->invoice_code_226 }}
            </div>
            <br>
        </td>
    </tr>
    @endif
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans_choice('booking::pulsar.campaign', 1) }}:</strong> {{ $voucher->name_221 }}
            </div>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans_choice('pulsar::pulsar.customer', 1) }}:</strong> {{ $voucher->customer_name_226 }}
            </div>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans_choice('pulsar::pulsar.bearer', 1) }}:</strong> {{ $voucher->bearer_226 }}
            </div>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans_choice('pulsar::pulsar.name', 1) }}:</strong> {{ $voucher->name_226 }}
            </div>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans_choice('pulsar::pulsar.description', 1) }}:</strong> {{ $voucher->description_226 }}
            </div>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans_choice('pulsar::pulsar.price', 1) }}:</strong> {{ $voucher->price_226 }}
            </div>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans('pulsar::pulsar.expire_date') }}:</strong> {{ $voucher->expire_date_text_226 }}
            </div>
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="content_body" style='background:#ffffff;text-align:left;vertical-align:top;font-size:15px;line-height:19px;border-collapse:collapse;color:#000000;border-spacing:0;font-family:"Helvetica Neue",helvetica,arial,sans-serif;padding:0 0 0 55px'>
            <div class="formatted_content" style="padding-bottom:19px;padding:0 !important;border:none !important;margin:0 0 5px !important;max-width:none !important">
                <strong>{{ trans('pulsar::pulsar.active') }}:</strong> {{ $voucher->active_226? trans('pulsar::pulsar.yes') : trans('pulsar::pulsar.no') }}
            </div>
            <br>
        </td>
    </tr>
    <!-- /voucher -->
    <tr>
        <td colspan="2" width="100%">&nbsp;</td>
    </tr>
</table>
@stop
