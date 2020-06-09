Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'search_multiple_us_item',
      path: '/search_multiple_us_item',
      component: require('./components/Tool'),
    },
  ])
})
