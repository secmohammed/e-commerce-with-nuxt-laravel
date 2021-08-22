<template>
  <nav class="navbar is-white">
    <div class="container">
      <div class="navbar-brand">
        <nuxt-link :to="{ name: 'index' }" class="navbar-item">
          cart
        </nuxt-link>
        <div class="navbar-burger burger" data-target="nav">
          <span />
          <span />
          <span />
        </div>
      </div>

      <div id="nav" class="navbar-menu">
        <div class="navbar-end">
          <nuxt-link
            v-if="!$auth.$state.loggedIn"
            :to="{ name: 'auth-login' }"
            class="navbar-item"
          >
            Sign in
          </nuxt-link>
          <template v-else>
            <a href="#" class="navbar-item">
              {{ $auth.$state.user.name }}
            </a>
          </template>
        </div>
      </div>
    </div>
  </nav>
</template>
<script>
export default {}
</script>
