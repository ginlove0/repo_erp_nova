Nova.booting((Vue, router, store) => {
  Vue.component('index-show-detail-by-hover', require('./components/IndexField'))
  Vue.component('detail-show-detail-by-hover', require('./components/DetailField'))
  Vue.component('form-show-detail-by-hover', require('./components/FormField'))
})
