<?php

namespace App\Http\Controllers\Admin;

use App\History;
use App\Http\Controllers\Controller;
use App\Money;
use App\Payment;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

const STATUS = [
    0 => 'Pending',
    1 => 'Active',
    2 => 'Success'
];
class PaymentController extends Controller
{

    public function getPaymentUser($userid)
    {
        $pays = Payment::query()
            ->where('user_id', $userid)
            ->where('active', 1)
            ->get();
        return $pays;
    }

    public function editUserPayemnt(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->get('_id');
            $moneyId = $request->get('money_id');
            $status = $request->get('status');
            History::query()->where('id', intval($id))->update([
                'status' => intval($status)
            ]);
            Money::query()->where('id', intval($moneyId))->update([
                'status' => intval($status)
            ]);
            DB::commit();
            return redirect()->route('admin.get-all-payment');
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }
    public function getAllPayemnt(Request $request)
    {
        $userId = $request->get('user_id');
        $money = Money::query()
            ->where('user_id',$userId)
            ->where('status', 1)
            ->first();
        $setting = Setting::query()->where('name', 'min')->first();
        $paymentHistory = History::query()->whereIn('status',[0,2])->paginate(10);
        return view('adminlte.allpayment')->with(['payments' => $paymentHistory]);
    }
    public function withdrawalView(Request $request)
    {
        $userId = $request->get('user_id');
        $money = Money::query()
            ->where('user_id',$userId)
            ->where('status', 1)
            ->first();
        $setting = Setting::query()->where('name', 'min')->first();
        $moneys = Money::query()
            ->where('user_id', $request->get('user_id'))
            ->get();
        $pending = 0;
        $current = 0;
        $done = 0;
        foreach ($moneys as $val) {
            if ($val->status == 1) $current += $val->price * $val->view;
            if ($val->status == 0) $pending += $val->price * $val->view;
            if ($val->status == 2) $done += $val->price * $val->view;
        }
        return view('site.withdrawal-view')
                ->with(['pending'=> $pending,
                    'current' => $current,
                    'done' => $done,
                    'money' => $money,
                    'setting' => $setting
                    ]);
    }
    public function withdrawal(Request $request)
    {
        try {
            DB::beginTransaction();
            $user_id = $request->get('user_id');
            $dataMoney = Money::query()
                ->where('user_id',$user_id)
                ->where('status', 1)
                ->get();
            foreach ($dataMoney as $value) {
                $data = [
                    'status' => 0,
                    'user_id' => $user_id,
                    'money_id' => $value->id,
                    'total_money' => $value->view * $value->price
                ];
                $value->status = 0;
                $value->save();
                History::query()->create($data);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }

    }
    public function getPayment(Request $request)
    {
        $userId = $request->get('user_id');
        $payment = Payment::query()->where('user_id', $userId)->get();
        return view('site.payment-method')->with(['payments' => $payment]);
    }

    public function addPaymentMethod(Request $request)
    {
        try {
            $data = $request->all();
            $count = Payment::query()->where('user_id', $data['user_id'])->where('active', 1)->count();
            if ($count > 5) return redirect()->route('admin.home.index')->with('error', 'add payment fail');
            $payment = new Payment();
            $type = $data['type'] ?? '';
            $payment->type = intval($type);
            if ($type == 1) {
                $request->validate([
                    'phone' => ['required', 'max:255'],
                    'bank_mono_name' => ['required'],
                ]);
                $payment->user_id = $data['user_id'];
                $payment->bank_account = $data['bank_mono_name'];
                $payment->phone = $data['phone'];
                $payment->save();
            } else if ($type == 2) {
                $request->validate([
                'bank_account' => ['required', 'max:255'],
                'bank_name' => ['required'],
                'bank_number' => ['required','numeric']
            ]);
                $payment->user_id = $data['user_id'];
                $payment->bank_account = $data['bank_account'];
                $payment->bank_name = $data['bank_name'];
                $payment->bank_number = $data['bank_number'];
                $payment->save();
            }
            return redirect()->route('admin.home.index')->with('success', 'add payment success');
        } catch (\Exception $exception) {
            return redirect()->route('admin.home.index')->with('error', 'add payment fail');
        }

    }

    public function editPaymentMethod(Request $request)
    {
        try {
            $data = $request->all();
            $payment = Payment::query()->where('id', $data['_id'])->first();
            if (empty($payment) ) throw new \Exception('loi');
            $type = $data['type1'] ?? '';
            $active = intval($data['active'] ?? 1);
            $payment->type = intval($type);
            $payment->active = $active;
            if ($type == 1) {
                $request->validate([
                    'phone1' => ['required', 'max:255'],
                    'bank_mono_name1' => ['required'],
                ]);
                $payment->user_id = $data['user_id'];
                $payment->bank_account = $data['bank_mono_name1'];
                $payment->phone = $data['phone1'];
                $payment->save();
            } else if ($type == 2) {
                $request->validate([
                'bank_account1' => ['required', 'max:255'],
                'bank_name1' => ['required'],
                'bank_number1' => ['required','numeric']
            ]);
                $payment->user_id = $data['user_id'];
                $payment->bank_account = $data['bank_account1'];
                $payment->bank_name = $data['bank_name1'];
                $payment->bank_number = $data['bank_number1'];
                $payment->save();
            }
            return redirect()->route('admin.home.index')->with('success', 'add payment success');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            return redirect()->route('admin.home.index')->with('error', 'add payment fail');
        }
    }

    public function delPayment(Request $request)
    {
        try {
            $id = intval($request->get('id') ?? 0);
            Payment::query()->where('id', $id)->delete();
            return response()->json([], 200);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

}
