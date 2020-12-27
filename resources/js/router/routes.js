function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [

  { path: '/login', name: 'login', component: page('auth/login.vue') },

  { path: '/', name: 'home', component: page('home.vue') },
  { path: '/containers', component: page('containers/index.vue'), name: 'containers.index' },
  { path: '/containers/create', component: page('containers/create.vue'), name: 'containers.create' },
  { path: '/containers/:id', component: page('containers/show.vue'), name: 'containers.show' },
  { path: '/containers/:id/edit', component: page('containers/edit.vue'), name: 'containers.edit' },
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  { path: '*', component: page('errors/404.vue') }
]
