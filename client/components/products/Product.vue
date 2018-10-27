<template>
    <div class="card">
        <div class="card-image">
            <figure class="image is-4by3">
                <img src="https://bulma.io/images/placeholders/1280x960.png">
            </figure>
        </div>
        <div class="card-content">
            <div class="media">
                <div class="media-content">
                    <a href="" class="title is-5"> {{ product.name }}</a>
                </div>
            </div>
            <div class="content">
                <p v-if="product.description" v-text="product.description"></p>
            </div>
            <span class="tag is-rounded is-medium">{{ product.price }}</span>
        </div>
    </div>
</template>
<script>
    export default {
        props : {
            product : {
                required : true,
                type : Object , 
            }
        }
    };
</script>