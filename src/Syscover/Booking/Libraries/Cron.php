<?php namespace Syscover\Booking\Libraries;

use Illuminate\Support\Facades\Mail;
use Syscover\Booking\Models\Voucher;
use Syscover\Booking\Models\VoucherTask;
use Syscover\Pulsar\Models\Preference;

class Cron
{
    public static function checkVouchersToCreate()
    {
        $voucherTasks = VoucherTask::builder()->get();

        if(count($voucherTasks) > 0)
        {
            $limitVouchers  = (int)Preference::getValue('bookingNVouchersToCreate', 11)->value_018;
            $voucherTask    = $voucherTasks->first();

            // set limit to create vouchers
            if($voucherTask->vouchers_to_create_227 <= $limitVouchers)
                $limit = $voucherTask->vouchers_to_create_227;
            else
                $limit = $limitVouchers;

            $voucher    = Voucher::builder()->find($voucherTask->voucher_id_227);
            $vouchers   = [];
            for($i=0; $i < $limit; $i++)
                $vouchers[] = [
                    'date_226'                  => $voucher->date_226,
                    'date_text_226'             => $voucher->date_text_226,
                    'code_prefix_226'           => $voucher->code_prefix_226,
                    'campaign_id_226'           => $voucher->campaign_id_226,
                    'customer_id_226'           => $voucher->customer_id_226,
                    'customer_name_226'         => $voucher->customer_name_226,
                    'bearer_226'                => $voucher->bearer_226,
                    'invoice_id_226'            => $voucher->invoice_id_226,
                    'invoice_code_226'          => $voucher->invoice_code_226,
                    'invoice_customer_id_226'   => $voucher->invoice_customer_id_226,
                    'invoice_customer_name_226' => $voucher->invoice_customer_name_226,
                    'product_id_226'            => $voucher->product_id_226,
                    'name_226'                  => $voucher->name_226,
                    'description_226'           => $voucher->description_226,
                    'price_226'                 => $voucher->price_226,
                    'expire_date_226'           => $voucher->expire_date_226,
                    'expire_date_text_226'      => $voucher->expire_date_text_226,
                    'active_226'                => $voucher->active_226,
                ];

            // insert n vouchers
            Voucher::insert($vouchers);

            if($voucherTask->vouchers_to_create_227 <= $limitVouchers)
            {
                // get user to send email
                $user = $voucherTask->getUser;

                // destroy task
                VoucherTask::destroy($voucherTask->id_227);

                // send email to user
                $dataMessage = [
                    'emailTo'           => $user->email_010,
                    'nameTo'            => $user->name_010 . ' ' . $user->surname_010,
                    'subject'           => trans('booking::pulsar.bulk_vouchers_create', ['totalVouchers' => $voucherTask->total_vouchers_227, 'id' => $voucherTask->id_227]),
                    'totalVouchers'     => $voucherTask->total_vouchers_227,
                    'voucher'           => $voucher
                ];

                Mail::send('booking::email.bulk_vouchers_notification', $dataMessage, function($m) use ($dataMessage) {
                    $m->to($dataMessage['emailTo'], $dataMessage['nameTo'])
                        ->subject($dataMessage['subject']);
                });
            }
            else
            {
                VoucherTask::where('id_227', $voucherTask->id_227)->update([
                    'vouchers_to_create_227' => $voucherTask->vouchers_to_create_227 - $limit
                ]);
            }
        }
    }
}