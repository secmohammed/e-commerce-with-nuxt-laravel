export default function({ $axios, store, app }) {
  if (process.client) {
    $axios.onResponseError(error => {
      if (error.response && error.response.status == 422) {
        app.$toast.error('Invalid Data Supplied')
      }
      if (error.response && error.response.status == 500) {
        app.$toast.error('God ! , what did you do.. ')
      }
      if (error.response.status == 404) {
        app.$toast.error('We could not find what you are searching for.')
      }
      if (error.response.status == 401) {
        app.$toast.error(error.response.data.message)
      }
      return Promise.reject(error)
    })
    $axios.onRequest(response => {
      let hasSuccess = _.some(response, res => _.has(res, 'success'))
      let hasMessage = _.some(response, res => _.has(res, 'message'))
      if (hasSuccess && hasMessage) {
        app.$toast.success(response.data.message)
      }
      if (!hasSuccess && hasMessage) {
        app.$toast.info(response.data.message)
      }
      return response
    })
  }
}
