<template>
<div class="section">
    <div class="container is-fluid">
        <div class="columns">
            <div class="column is-half">
                <img src="http://via.placeholder.com/620x620" alt="Product name">
            </div>
            <div class="column is-half">
                <section class="section">
                    <h1 class="title is-4">
                    {{ product.name }}
                    </h1>
                    <p v-if="product.description">
                        {{ product.description }}
                    </p>
                    <hr>
                    <span class="tag is-rounded is-medium is-dark" v-if="!product.in_stock">
                        Out Of Stock
                    </span>
                    <span class="tag is-rounded is-medium">
                        {{ product.price }}
                    </span>
                </section>
                <section class="section">
                    <form action="#" @submit.prevent="add">
                        <ProductVariation v-for="(variations,type) in product.variations" :type="type" :key="type" :variations="variations"  v-model="form.variation" />
                        <div class="field has-addons" v-if="form.variation">
                            <div class="control">
                                <div class="select is-fullwidth" >
                                    <select v-model="form.quantity">
                                        <option :value="x" v-for="x in parseInt(form.variation.stock_count)" :key="x">{{ x }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control">
                                <button class="button is-info">Add To Cart</button>
                            </div>
                        </div>
                    </form>
                </section>  
            </div>
        </div>
    </div>
</div>
</template>
<script>
    import { mapActions } from 'vuex'
    import ProductVariation from '@/components/products/ProductVariation'
    export default {
        data(){
            return {
                product : null,
                form : {
                    variation : '',
                    quantity : 1
                }
            }
        },
        components : {
            ProductVariation
        },
        watch : {
            'form.variation'(){
                this.form.quantity = 1
            }
        },
        async asyncData({ params, app }){
            let response = await app.$axios.$get(`products/${params.slug}`)
            return {
                product : response.data
            }
        },
        methods : {
            ...mapActions({
                store : 'cart/store'
            }),
            add () {
                this.store([{
                    id : this.form.variation.id,
                    quantity : this.form.quantity
                }])
                this.form = {
                    variation : '',
                    quantity : 1
                }
            }
        }
    };
</script>