export default function(ctx) {
  if (ctx.app.$auth.$state.loggedIn) {
    return ctx.app.$auth.redirect('/')
  }
}
