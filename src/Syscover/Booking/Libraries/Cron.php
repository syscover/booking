<?php namespace Syscover\Booking\Libraries;

use Syscover\Booking\Models\Voucher;
use Syscover\Booking\Models\VoucherTask;

class Cron
{
    public static function checkVouchersToCreate()
    {
        $voucherTasks = VoucherTask::builder()->get();

        if(count($voucherTasks) > 0)
        {
            $voucherTask = $voucherTasks->first();

            $voucher = $voucherTask->getVoucher;

            $vouchers = [];

            if($voucherTask->vouchers_to_create_227 <= 250)
                $limit = $voucherTask->vouchers_to_create_227;
            else
                $limit = 250;

            for($i=0; $i < $limit; $i++)
                $vouchers[] = $voucher;

            // insert
            Voucher::insert($vouchers);

            if($voucherTask->vouchers_to_create_227 <= 250)
            {
                VoucherTask::destroy($voucherTask->id_227);
                // send email??
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