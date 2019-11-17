<?php

namespace App\Http\Controllers\Settings;

use App\Helpers\DateHelper;
use App\Models\Account\PrepaidSubscription;
use DateTime;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Payment;
use App\Helpers\InstanceHelper;
use App\Exceptions\StripeException;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Stripe\PaymentIntent as StripePaymentIntent;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Source;
use Stripe\Stripe;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if (! config('monica.requires_subscription')) {
            return redirect()->route('settings.index');
        }

        $subscription = auth()->user()->account->getSubscribedPlan();
        if (! auth()->user()->account->isSubscribed() && (! $subscription || $subscription->ended())) {
            return view('settings.subscriptions.blank', [
                'numberOfCustomers' => InstanceHelper::getNumberOfPaidSubscribers(),
            ]);
        }

        try {
            $nextBillingDate = auth()->user()->account->getNextBillingDate();
        } catch (StripeException $e) {
            $nextBillingDate = trans('app.unknown');
        }

        $hasInvoices = auth()->user()->account->hasInvoices();
        $invoices = null;
        if ($hasInvoices) {
            $invoices = auth()->user()->account->invoices();
        }

        $planInfo = InstanceHelper::getPlanInformationFromConfig(auth()->user()->account->getSubscribedPlanName());

        return view('settings.subscriptions.account', [
            'planInformation' => $planInfo,
            'nextBillingDate' => $nextBillingDate,
            'subscription' => $subscription,
            'hasInvoices' => $hasInvoices,
            'invoices' => $invoices,
        ]);
    }

    /**
     * Display the upgrade view page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function upgrade(Request $request)
    {
        if (! config('monica.requires_subscription')) {
            return redirect()->route('settings.index');
        }

        if (auth()->user()->account->isSubscribed()) {
            return redirect()->route('settings.subscriptions.index');
        }

        $plan = $request->query('plan');

        return view('settings.subscriptions.upgrade', [
            'planInformation' => InstanceHelper::getPlanInformationFromConfig($plan),
            'nextTheoriticalBillingDate' => DateHelper::getFullDate(DateHelper::getNextTheoriticalBillingDate($plan)),
        ]);
    }

    /**
     * Display the confirm view page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function confirmPayment($id)
    {
        return view('settings.subscriptions.confirm', [
            'payment' => new Payment(
                StripePaymentIntent::retrieve($id, Cashier::stripeOptions())
            ),
            'redirect' => request('redirect'),
        ]);
    }

    /**
     * Handle wechat callback
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function wechatCallback(Request $request)
    {

        Stripe::setApiKey(getenv('STRIPE_SECRET'));
        $sourceId = $request->query('source');
        $source = Source::retrieve($sourceId);
        if ($source['status'] == 'chargeable') {
            $plan = $request->query('plan');
            if (! $sourceId || ! $plan) {
                abort(403);
            }
            if ($plan == 'annual') {
                $rate = 1039;
            } elseif ($plan == 'monthly') {
                $rate = 113;
            }
            $charge = \Stripe\Charge::create([
                'amount' => $rate,
                'currency' => 'cad',
                'source' => $sourceId,
            ]);

            $prepaidSub = new PrepaidSubscription();
            $prepaidSub->account_id = auth()->user()->account_id;
            $prepaidSub->name = $plan;
            $ends_at = new DateTime();
            $ends_at->modify( '+1 year');
            $prepaidSub->ends_at = $ends_at;
            $prepaidSub->save();

            return view('settings.subscriptions.success');
        }
    }

    /**
     * Handle alipay callback
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function alipayCallback(Request $request)
    {
        Stripe::setApiKey(getenv('STRIPE_SECRET'));
        $sourceId = $request->query('source');
        $plan = $request->query('plan');
        if (! $sourceId || ! $plan) {
            abort(403);
        }
        if ($plan == 'annual') {
            $rate = 1039;
        } elseif ($plan == 'monthly') {
            $rate = 113;
        }
        $charge = \Stripe\Charge::create([
            'amount' => $rate,
            'currency' => 'cad',
            'source' => $sourceId,
        ]);

        $prepaidSub = new PrepaidSubscription();
        $prepaidSub->account_id = auth()->user()->account_id;
        $prepaidSub->name = $plan;
        $ends_at = new DateTime();
        $ends_at->modify( '+1 year');
        $prepaidSub->ends_at = $ends_at;
        $prepaidSub->save();

        return view('settings.subscriptions.success');
    }

    /**
     * Display the upgrade success page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function upgradeSuccess(Request $request)
    {
        if (! config('monica.requires_subscription')) {
            return redirect()->route('settings.index');
        }

        return view('settings.subscriptions.success');
    }

    /**
     * Display the downgrade success page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function downgradeSuccess(Request $request)
    {
        if (! config('monica.requires_subscription')) {
            return redirect()->route('settings.index');
        }

        return view('settings.subscriptions.downgrade-success');
    }

    /**
     * Display the downgrade view page.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse
     */
    public function downgrade()
    {
        if (! config('monica.requires_subscription')) {
            return redirect()->route('settings.index');
        }

        $subscription = auth()->user()->account->getSubscribedPlan();
        if (! auth()->user()->account->isSubscribed() && ! $subscription) {
            return redirect()->route('settings.index');
        }

        return view('settings.subscriptions.downgrade-checklist');
    }

    /**
     * Process the downgrade process.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processDowngrade()
    {
        if (! auth()->user()->account->canDowngrade()) {
            return redirect()->route('settings.subscriptions.downgrade');
        }

        $subscription = auth()->user()->account->getSubscribedPlan();
        if (! auth()->user()->account->isSubscribed() && ! $subscription) {
            return redirect()->route('settings.index');
        }

        try {
            auth()->user()->account->subscriptionCancel();
        } catch (StripeException $e) {
            return back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('settings.subscriptions.downgrade.success');
    }

    /**
     * Process the upgrade payment.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processPayment(Request $request)
    {
        if (! config('monica.requires_subscription')) {
            return redirect()->route('settings.index');
        }

        try {
            auth()->user()->account
                ->subscribe($request->input('payment_method'), $request->input('plan'));
        } catch (IncompletePayment $e) {
            return redirect()->route(
                'settings.subscriptions.confirm',
                [$e->payment->asStripePaymentIntent()->id, 'redirect' => route('settings.subscriptions.upgrade.success')]
            );
        } catch (StripeException $e) {
            return back()
                ->withInput()
                ->withErrors($e->getMessage());
        }

        return redirect()->route('settings.subscriptions.upgrade.success');
    }

    /**
     * Download the invoice as PDF.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadInvoice(Request $request, $invoiceId)
    {
        return auth()->user()->account->downloadInvoice($invoiceId, [
            'vendor'  => 'Monica',
            'product' => trans('settings.subscriptions_pdf_title', ['name' => config('monica.paid_plan_monthly_friendly_name')]),
        ]);
    }

    /**
     * Download the invoice as PDF.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function forceCompletePaymentOnTesting(Request $request)
    {
        if (App::environment('production')) {
            return;
        }
        $subscription = auth()->user()->account->getSubscribedPlan();
        $subscription->stripe_status = 'active';
        $subscription->save();

        return redirect()->route('settings.subscriptions.index');
    }
}
