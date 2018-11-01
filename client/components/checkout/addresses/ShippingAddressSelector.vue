<template>
    <table class="table is-hoverable is-fullwidth">
        <tbody>
            <tr v-for="address in addresses" :key="address.id">
                <td>
                    <p :class="{ 'has-text-weight-bold' : address.id == selectedAddress.id }">
                        {{ address.name }} <br>
                        {{ address.address_1 }} <br>
                        {{ address.city }} <br>
                        {{ address.postal_code }} <br>
                        {{ address.country.name }}
                    </p>
                </td>
                <td>
                    <a href="" class="button is-info" @click.prevent="$emit('click',address)">Ship Here</a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props : {
            addresses : {
                required : true,
                type : Array
            },
            selectedAddress : {
                required : true,
                type : Object
            }
        }
    }
</script>