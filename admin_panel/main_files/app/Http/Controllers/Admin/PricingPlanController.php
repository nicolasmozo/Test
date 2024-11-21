<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Status;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PricingPlan;
use App\Models\SubscriptionSeller;
use Illuminate\Http\Request;

class PricingPlanController extends Controller
{

    public function index()
    {
        $plans = PricingPlan::orderBy('serial', 'asc')->get();

        return view('admin.pricing_plan.index', compact('plans'));
    }


    public function create()
    {
        return view('admin.pricing_plan.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'plan_type' => 'required',
            'plan_price' => 'nullable|numeric',
            'plan_name' => 'required',
            'expired_time' => 'required',
            'serial' => 'required|unique:pricing_plans,serial',
            'upload_limit' => 'required|integer',
        ];

        $customMessages = [
            'plan_type.required' => trans('admin_validation.Plan type is required'),
            'plan_price.required' => trans('admin_validation.Plan price is required'),
            'plan_price.numeric' => trans('admin_validation.Plan price should be numeric value'),
            'plan_name.required' => trans('admin_validation.Plan name is required'),
            'expired_time.required' => trans('admin_validation.Expiration is required'),
            'serial.required' => trans('admin_validation.Serial is required'),
            'status.required' => trans('admin_validation.Status is required'),
            'upload_limit.required' => trans('admin_validation.Upload limit is required'),
            'upload_limit.integer' => trans('admin_validation.Upload limit should be number'),
        ];
        $this->validate($request, $rules, $customMessages);

        $plan = new PricingPlan();
        $plan->plan_slug = rand(10000000, 99999999);
        $plan->plan_type = $request->plan_type;
        $plan->plan_price = $request->plan_price;
        $plan->plan_name = $request->plan_name;
        $plan->expired_time = $request->expired_time;
        $plan->serial = $request->serial;
        $plan->upload_limit = $request->upload_limit;
        $plan->save();

        $notification = trans('admin_validation.Created Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('admin.pricing-plan.index')->with($notification);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $plan = PricingPlan::findOrFail($id);
        return view('admin.pricing_plan.create', compact('plan'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'plan_type' => 'required|string',
            'plan_name' => 'required|string|max:255',
            'plan_price' => 'nullable|numeric',
            'expired_time' => 'required|string',
            'upload_limit' => 'required|integer',
            'serial' => 'required|integer|unique:pricing_plans,serial,' . $id, // Ensure serial is unique
        ];

        $customMessages = [
            'plan_type.required' => trans('admin_validation.Plan type is required'),
            'plan_name.required' => trans('admin_validation.Plan name is required'),
            'plan_price.required' => trans('admin_validation.Plan price is required'),
            'plan_price.numeric' => trans('admin_validation.Plan price should be numeric value'),
            'expired_time.required' => trans('admin_validation.Expiration is required'),
            'serial.required' => trans('admin_validation.Serial is required'),
            'serial.unique' => trans('admin_validation.Serial must be unique'),
        ];

        $this->validate($request, $rules, $customMessages);

        $plan = PricingPlan::findOrFail($id);
        $plan->plan_type = $request->plan_type;
        $plan->plan_name = $request->plan_name;
        $plan->expired_time = $request->expired_time;
        $plan->serial = $request->serial;
        $plan->upload_limit = $request->upload_limit;

        if ($request->plan_type === 'free') {
            $plan->plan_price = 0;
        } else {
            $plan->plan_price = $request->filled('plan_price') ? $request->plan_price : $plan->plan_price;
        }

        $plan->save();

        $notification = trans('admin_validation.Updated Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');

        return redirect()->route('admin.pricing-plan.index')->with($notification);
    }

    public function destroy($id)
    {
        $plan = PricingPlan::find($id);
        $plan->delete();

        $notification = trans('admin_validation.Delete Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function changeStatus($id)
    {
        $plan = PricingPlan::find($id);
        if ($plan->status == Status::ACTIVE) {
            $plan->status = Status::INACTIVE;
            $plan->save();
            $message = trans('admin_validation.Inactive Successfully');
        } else {
            $plan->status = Status::ACTIVE;
            $plan->save();
            $message = trans('admin_validation.Active Successfully');
        }
        return response()->json($message);
    }


    public function purchaseList()
    {
        $pageTitle = 'Purchase List';
        $lists = SubscriptionSeller::with('user')->get();

        if ($lists->count() > 0) {
            \Log::debug('First subscription:', [
                'subscription' => $lists->first()->toArray(),
                'user' => $lists->first()->user
            ]);
        }

        return view('admin.pricing_plan.purchase_list', compact('pageTitle', 'lists'));
    }
}
