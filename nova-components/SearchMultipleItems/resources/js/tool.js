Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'search-multiple-items',
      path: '/search-multiple-items',
      component: require('./components/Tool'),
    },
  ])
})
