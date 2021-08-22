<template>
  <div class="section">
    <div class="container is-fluid">
      <div class="columns is-centered">
        <div class="column is-6">
          <h1 class="title is-4">Login</h1>
          <form action="#" @submit.prevent="login">
            <div class="field">
              <label class="label">Email</label>
              <div class="control">
                <input
                  v-model="form.email"
                  class="input"
                  type="email"
                  placeholder="e.g. alex@codecourse.com"
                />
              </div>
            </div>

            <div class="field">
              <label class="label">Password</label>
              <div class="control">
                <input v-model="form.password" class="input" type="password" />
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
  auth: 'guest',
  data() {
    return {
      form: {
        email: '',
        password: '',
        remember: false
      },
      response: {
        error: '',
        success: ''
      }
    }
  },
  methods: {
    async login() {
      try {
        await this.$auth.loginWith('local', {
          data: this.form
        })
        this.$toast.success('Successfully authenticated', {
          duration: 1500
        })
        await this.$router.push('/')
      } catch (err) {
        console.log(err)
        this.$toast.error('Please Check your credentials', {
          duration: 1500
        })
      }
    }
  }
}
</script>
