Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'model-quick-view',
      path: '/model-quick-view',
      component: require('./components/Tool'),
    },
  ])
})
