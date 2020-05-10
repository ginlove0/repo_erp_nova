Nova.booting((Vue, router, store) => {
  Vue.component('index-display-qty-sale-order-item-field', require('./components/IndexField'))
  Vue.component('detail-display-qty-sale-order-item-field', require('./components/DetailField'))
  Vue.component('form-display-qty-sale-order-item-field', require('./components/FormField'))
})
