<style scoped>
</style>

<template>
  <form ref="form" class="mb4" :action="callback" method="post" @submit.prevent="">
    <notifications group="subscription" position="top middle" :duration="5000" width="400" />

    <div class="form-group">
      <div v-if="errors" role="alert" class="alert alert-danger w-100">
        {{ errors }}
      </div>

      <div v-if="paymentSucceeded">
        <h1 class="text-xl mt-2 mb-4 text-gray-700">
          {{ $t('settings.subscriptions_payment_succeeded_title') }}
        </h1>
        <p v-if="successMessage" class="mb-6">
          {{ successMessage }}
        </p>
        <p v-else class="mb-6">
          {{ $t('settings.subscriptions_payment_succeeded') }}
        </p>
      </div>

      <div v-else-if="paymentCancelled">
        <h1 class="text-xl mt-2 mb-4 text-gray-700">
          {{ $t('settings.subscriptions_payment_cancelled_title') }}
        </h1>

        <p class="mb-6">
          {{ $t('settings.subscriptions_payment_cancelled') }}
        </p>
      </div>

      <div v-else-if="! paymentProcessed" id="payment-elements" class="b--gray-monica ba pa4 br2 mb3 bg-black-05">
        <button
          id="card-button"
          class="btn btn-primary w-100 mt3"
          :disabled="paymentProcessing"
          @click.prevent="wechatPayment()"
        >
        微信支付
        </button>
        <button
          id="card-button"
          class="btn btn-primary w-100 mt3"
          :disabled="paymentProcessing"
          @click.prevent="confirm ? confirmPayment() : subscribe()"
        >
        支付宝
        </button>
      </div>
      <img :src="paymentQRUrl">
      <a v-if="paymentProcessed" :href="callback"
         class="btn btn-secondary w-100 tc"
      >
        {{ $t('app.go_back') }}
      </a>
    </div>
    <input type="hidden" name="_token" :value="token" />
    <input type="hidden" name="plan" :value="plan" />
    <input type="hidden" name="payment_method" :value="paymentMethod" />
  </form>
</template>

<script>
import { setTimeout } from 'timers';
export default {

  props: {
    name: {
      type: String,
      default: '',
    },
    stripeKey: {
      type: String,
      default: '',
    },
    clientSecret: {
      type: String,
      default: '',
    },
    plan: {
      type: String,
      default: '',
    },
    amount: {
      type: String,
      default: '',
    },
    callback: {
      type: String,
      default: '',
    },
    confirm: {
      type: Boolean,
      default: false,
    },
    paymentSucceeded: {
      type: Boolean,
      default: false,
    },
    paymentCancelled: {
      type: Boolean,
      default: false,
    },
  },

  data() {
    return {
      stripe: null,
      zip: '',
      errors: '',
      successMessage: '',
      cardElement: null,
      paymentMethod: '',
      token: '',
      paymentQRUrl: '',
      rate: 0,
      paymentProcessing: false,
      paymentProcessed: false,
    };
  },

  mounted() {
    this.token = document.head.querySelector('meta[name="csrf-token"]').content;
    if (this.paymentSucceeded || this.paymentCancelled) {
      this.paymentProcessed = true;
    }
    if (! this.paymentProcessed) {
      this.start();
    }
  },

  methods: {
    start() {
      this.paymentQRUrl = '';
      if (this.plan === 'annual') {
        this.rate = 1645
      } else if (this.plan === 'monthly') {
        this.rate = 224
      }
      this.stripe = Stripe(this.stripeKey);
    },

    handleError(error) {
      if (error.code === 'parameter_invalid_empty' &&
            error.param === 'payment_method_data[billing_details][name]') {
        this.errors = this.$t('settings.subscriptions_payment_error_name');
      } else {
        this.errors = error.message;
      }
    },

    subscribe() {
      var self = this;

      this.errors = '';
      this.paymentProcessing = true;
      this.paymentProcessed = false;

      this.stripe.handleCardSetup(
        self.clientSecret,
        self.cardElement,
        {
          payment_method_data: {
            billing_details: {
              name: self.name,
              address: {
                postal_code: self.zip,
              }
            }
          }
        }
      ).then(function (result) {
        self.paymentProcessing = false;
        if (result.error) {
          self.handleError(result.error);
        } else {
          // The card has been verified successfully...
          self.paymentProcessed = true;
          self.paymentSucceeded = true;
          self.successMessage = self.$t('settings.subscriptions_payment_success');
          self.notify(self.successMessage, true);
          self.processPayment(result.setupIntent);
        }
      });
    },

    processPayment(setupIntent) {
      var self = this;
      this.paymentMethod = setupIntent.payment_method;
      setTimeout(function () {
        self.$refs.form.submit();
      }, 10);
    },

    wechatPayment() {
      var self = this;

      this.paymentProcessing = true;
      this.paymentProcessed = false;
      this.errorMessage = '';

      this.stripe.createSource({
        type: 'wechat',
        amount: this.rate,
        currency: 'cad'
      }).then(function(result) {
        console.log(result)
        var source = result.source;
        self.paymentQRUrl = 'http://qr.liantu.com/api.php?text=' + source.wechat.qr_code_url
      })
    },

    confirmPayment() {
      var self = this;

      this.paymentProcessing = true;
      this.paymentProcessed = false;
      this.errorMessage = '';

      this.stripe.handleCardPayment(
        self.clientSecret, self.cardElement, {
          payment_method_data: {
            billing_details: { name: this.name }
          }
        }
      ).then(function (result) {
        self.paymentProcessing = false;

        if (result.error) {
          self.handleError(result.error);
        } else {
          self.paymentProcessed = true;
          self.paymentSucceeded = true;
          self.successMessage = self.$t('settings.subscriptions_payment_success');
          self.notify(self.successMessage, true);
          setTimeout(function () {
            window.location = self.callback;
          }, 3000);
        }
      });
    },

    notify(text, success) {
      this.$notify({
        group: 'subscription',
        title: text,
        text: '',
        type: success ? 'success' : 'error'
      });
    }
  }
};
</script>
