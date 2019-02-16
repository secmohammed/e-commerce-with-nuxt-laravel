<template>
<div class="section">
  <div class="container is-fluid">
    <div class="columns">
      <div class="column is-three-quarters">
        <ShippingAddress 
          :addresses ="addresses"
          v-model="form.address_id"
        />
        <PaymentMethods 
          :payment-methods ="paymentMethods"
          v-model="form.payment_method_id"
        />

        <article class="message">
          <div class="message-body">
            <h1 class="title is-5">
            Shipping
            </h1>
            <div class="select is-fullwidth">
              <select v-model="shippingMethodId">
                <option v-for="shipping in shippingMethods" :key="shipping.id" :value="shipping.id">
                  {{ shipping.name }} ({{ shipping.price }})
                </option>
              </select>
            </div>
          </div>
        </article>
        <article class="message" v-if="products.length">
          <div class="message-body">
            <h1 class="title is-5">
            Cart summary
            </h1> 
            <CartOverview class="is-fullwidth">
              <template slot="rows">
                <tr>
                  <td></td>
                  <td></td>
                  <td class="has-text-weight-bold">
                    Shipping
                  </td>
                  <td>
                    {{ shipping.price }}
                  </td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td class="has-text-weight-bold">
                    Total
                  </td>
                  <td>
                    {{ total }}
                  </td>
                  <td></td>
                </tr>
              </template>
            </CartOverview>
          </div>
        </article>
        <article class="message">
          <div class="message-body">
            <button class="button is-info is-fullwidth is-medium" @click.prevent="order" :disabled="empty || submitting">
            Place order
            </button>
          </div>
        </article>
      </div>
      <div class="column is-one-quarter">
        <article class="message">
          <div class="message-body">
            <button 
              class="button is-info is-fullwidth is-medium" 
              :disabled="empty || submitting"
              @click.prevent="order"
            >
            Place order
            </button>
          </div>
        </article>
      </div>
    </div>
  </div>
</div>
</template>
<script>
  import { mapGetters, mapActions } from 'vuex'
  import CartOverview from '@/components/cart/CartOverview'
  import ShippingAddress from '@/components/checkout/addresses/ShippingAddress'
  import PaymentMethods from '@/components/checkout/paymentMethods/PaymentMethods'
  export default {
    middleware: 'redirectIfGuest',
    data(){
      return {
        submitting: false,
        addresses : [],
        paymentMethods: [],
        shippingMethods: [],
        form: {
          address_id: null,
          payment_method_id: null
        },
      }
    },
    components : {
      CartOverview,
      ShippingAddress,
      PaymentMethods
    },
    computed : {
      ...mapGetters({
        total : 'cart/total',
        products : 'cart/products',
        empty : 'cart/empty',
        shipping: 'cart/shipping'
      }),
      shippingMethodId: {
        get() {
          return this.shipping ? this.shipping.id : ''
        },
        set (shippingMethodId) {
          this.setShipping(
            this.shippingMethods.find(s => s.id === shippingMethodId)
          )
        }
      }
    },
    watch: {
      'form.address_id' (addressId) {
        this.getShippingMethodsForAddress(addressId).then(() => {
          this.setShipping(this.shippingMethods[0])
        })
      },
      shippingMethodId () {
        this.getCart()
      }
    },

    methods: {
      ...mapActions({
        setShipping: 'cart/setShipping',
        getCart: 'cart/getCart',
        flash: 'alert/flash'
      }),
      async order () {
        this.submitting = true
        try {
          await this.$axios.$post('orders',{
            ...this.form,
            shipping_method_id: this.shippingMethodId
          })
          await this.getCart()
          this.$router.replace({
            name: 'orders'
          })
        } catch(e) {
          this.flash(e.response.data.message)
          this.getCart()
        }
        this.submitting = false
      },
      async getShippingMethodsForAddress (addressId) {
        let response = await this.$axios.$get(`addresses/${addressId}/shipping`)
        this.shippingMethods = response.data
        return response
      }
    },
    async asyncData({ app }) {
      let addresses = await app.$axios.$get('addresses')
      let paymentMethods = await app.$axios.$get('payment-methods')
      return {
        addresses : addresses.data,
        paymentMethods: paymentMethods.data
      }
    }
  }
</script>
