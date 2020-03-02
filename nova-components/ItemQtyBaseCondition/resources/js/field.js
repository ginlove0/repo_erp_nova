Nova.booting((Vue, router, store) => {
  Vue.component('index-item-qty-base-condition', require('./components/IndexField'))
  Vue.component('detail-item-qty-base-condition', require('./components/DetailField'))
  Vue.component('form-item-qty-base-condition', require('./components/FormField'))
})
