<template>
    <div class="section">
  <div class="container is-fluid">
    <div class="columns is-centered">
      <div class="column is-6">
        <h1 class="title is-4">Login</h1>
        <form action="" @submit.prevent="login">
          <div class="field">
            <label class="label">Email</label>
            <div class="control">
              <input class="input" v-model="form.email" type="email" placeholder="e.g. alex@codecourse.com">
            </div>
          </div>

          <div class="field">
            <label class="label">Password</label>
            <div class="control">
              <input class="input" v-model="form.password" type="password">
            </div>
          </div>

          <div class="field">
            <p class="control">
              <button class="button is-info is-medium">
                Login
              </button>
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</template>
<script>
    export default {
        data(){
            return {
                form : {
                    password : '',
                    email : ''
                }
            }
        },
        methods : {
            async login(){
                await this.$auth.loginWith('local',{
                    data : this.form
                })
                this.$router.replace({
                    name : 'index'
                })
            }
            
        }
    }
</script>