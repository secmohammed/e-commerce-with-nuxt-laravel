<template>
    <div class="section">
        <div class="container is-fluid">
            <p>Products</p>
            {{products}}
        </div>
    </div>
</template>
<script>
    export default {
        data(){
            return {
                products : []
            }
        },
        async asyncData({ params, app }){
            let response = await app.$axios.$get(`products?category=${params.slug}`)
            return {
                products : response.data
            }
        }
    };
</script>