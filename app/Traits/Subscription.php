<?php

namespace App\Traits;

use App\Helpers\DateHelper;
use App\Helpers\InstanceHelper;
use App\Models\Account\PrepaidSubscription;
use App\Exceptions\StripeException;
use Illuminate\Support\Facades\Log;

trait Subscription
{
    /**
     * Check if the account is currently subscribed to a plan.
     *
     * @return bool
     */
    public function isSubscribed()
    {
        if ($this->has_access_to_paid_version_for_free) {
            return true;
        }

        return !!$this->prepaidSubscriptions->first();
    }

    public function hasIncompletePayment() {
        return false;
    }

    /**
     * Get the subscription the account is subscribed to.
     *
     * @return PrepaidSubscription|null
     */
    public function getSubscribedPlan()
    {
        return auth()->user()->account->prepaidSubscriptions->where('account_id', auth()->user()->account_id)->first();
    }

    /**
     * Get the friendly name of the plan the account is subscribed to.
     *
     * @return string|null
     */
    public function getSubscribedPlanName()
    {
        $plan = $this->getSubscribedPlan();

        if (! is_null($plan)) {
            return $plan->name;
        }
    }

    /**
     * Check if the account has invoices linked to this account.
     *
     * @return bool
     */
    public function hasInvoices()
    {
        // TODO: fix invoices generations
        return false;
        // return $this->prepaidSubscriptions()->count() > 0;
    }

    public function invoices() {
        return [];
    }

    /**
     * Get the next billing date for the account.
     *
     * @return string
     */
    public function getNextBillingDate()
    {
        // Weird method to get the next billing date from Laravel Cashier
        // see https://stackoverflow.com/questions/41576568/get-next-billing-date-from-laravel-cashier
        return $this->stripeCall(function () {
            $prepaidSubscriptions = auth()->user()->account->prepaidSubscriptions->first();
            if (! $prepaidSubscriptions ) {
                return '';
            }
            return $prepaidSubscriptions->ends_at;
        });
    }

    /**
     * Call stripe.
     *
     * @param callable $callback
     * @return mixed
     */
    private function stripeCall($callback)
    {
        try {
            return $callback();
        } catch (\Stripe\Error\Card $e) {
            // Since it's a decline, \Stripe\Error\Card will be caught
            $body = $e->getJsonBody();
            $err = $body['error'];
            $errorMessage = trans('settings.stripe_error_card', ['message' => $err['message']]);
            Log::error('Stripe card decline error: '.(string) $e, $e->getJsonBody() ?: []);
        } catch (\Stripe\Error\RateLimit $e) {
            // Too many requests made to the API too quickly
            $errorMessage = trans('settings.stripe_error_rate_limit');
            Log::error('Stripe RateLimit error: '.(string) $e, $e->getJsonBody() ?: []);
        } catch (\Stripe\Error\InvalidRequest $e) {
            // Invalid parameters were supplied to Stripe's API
            $errorMessage = trans('settings.stripe_error_invalid_request');
            Log::error('Stripe InvalidRequest error: '.(string) $e, $e->getJsonBody() ?: []);
        } catch (\Stripe\Error\Authentication $e) {
            // Authentication with Stripe's API failed
            // (maybe you changed API keys recently)
            $errorMessage = trans('settings.stripe_error_authentication');
            Log::error('Stripe Authentication error: '.(string) $e, $e->getJsonBody() ?: []);
        } catch (\Stripe\Error\ApiConnection $e) {
            // Network communication with Stripe failed
            $errorMessage = trans('settings.stripe_error_api_connection_error');
            Log::error('Stripe ApiConnection error: '.(string) $e, $e->getJsonBody() ?: []);
        } catch (\Stripe\Error\Base $e) {
            $errorMessage = $e->getMessage();
            Log::error('Stripe error: '.(string) $e, $e->getJsonBody() ?: []);
        }

        throw new StripeException($errorMessage);
    }
}
