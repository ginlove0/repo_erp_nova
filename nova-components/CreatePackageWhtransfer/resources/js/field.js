Nova.booting((Vue, router, store) => {
  Vue.component('index-create-package-whtransfer', require('./components/IndexField'))
  Vue.component('detail-create-package-whtransfer', require('./components/DetailField'))
  Vue.component('form-create-package-whtransfer', require('./components/FormField'))
})
