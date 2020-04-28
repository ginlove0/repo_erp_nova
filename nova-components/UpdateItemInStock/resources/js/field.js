Nova.booting((Vue, router, store) => {
  Vue.component('index-update-item-in-stock', require('./components/IndexField'))
  Vue.component('detail-update-item-in-stock', require('./components/DetailField'))
  Vue.component('form-update-item-in-stock', require('./components/FormField'))
})
