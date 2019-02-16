<template>
    <article class="message">
        <div class="message-body">
            <h1 class="title is-5">Payment Methods</h1>
            <template v-if="selecting">
                <PaymentMethodSelector 
                    :payment-methods="paymentMethods"
                    :selected-payment-method="selectedPaymentMethod"
                    @click="paymentMethodSelected"
                />
            </template>
            <template v-else-if="creating">
                <PaymentMethodCreator
                    @cancel="creating = false"
                    @added="created"
                />
            </template>
            <template v-else>
                <template v-if="selectedPaymentMethod">
                    <p>
                        {{ selectedPaymentMethod.card_type }} ending {{ selectedPaymentMethod.last_four }}
                    </p>
                    <br>
                </template>
                <div class="field is-grouped">
                    <p class="control" v-if="paymentMethods.length">
                        <a href="" class="button is-info" @click.prevent="selecting = true">Change Payment Method</a>
                    </p>
                    <p class="control">
                        <a href="" class="button is-info" @click.prevent="creating = true">Add a payment method</a>
                    </p>
                </div>
            </template>
        </div>
    </article>
</template>

<script>
    import PaymentMethodSelector from './PaymentMethodSelector'
    import PaymentMethodCreator from './PaymentMethodCreator'
    export default {
        components: {
            PaymentMethodSelector,
            PaymentMethodCreator
        },
        data(){
            return {
                selecting: false,
                creating : false,
                localPaymentMethods : this.paymentMethods,
                selectedPaymentMethod : null
            }
        },
        props : {
            paymentMethods : {
                required : true,
                type : Array
            }
        },
        watch: {
            selectedPaymentMethod (paymentMethod) {
                this.$emit('input', paymentMethod.id)
            }
        },
        computed : {
            defaultPaymentMethod () {
                return this.localPaymentMethods.find(a => a.default == true)
            }
        },
        methods : {
            paymentMethodSelected (paymentMethod) {
                this.switchPaymentMethod(paymentMethod)
                this.selecting = false
            },
            switchPaymentMethod (paymentMethod) {
                this.selectedPaymentMethod = paymentMethod
            },
            created (paymentMethod) {
                this.localPaymentMethods.push(paymentMethod)
                
                this.creating = false

                this.switchPaymentMethod(paymentMethod)
            }
        },
        created () {
            if (this.paymentMethods.length) {
                this.switchPaymentMethod(this.defaultPaymentMethod)
            }
        }
    }
</script> 
