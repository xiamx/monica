@if (($subscription = auth()->user()->account->getSubscribedPlan()) && auth()->user()->account->hasIncompletePayment())

<div class="alert alert-success">
  {!! trans('settings.subscriptions_account_confirm_payment', ['url' => route('settings.subscriptions.confirm', $subscription->latestPayment()->id)]) !!}
</div>

@endif
