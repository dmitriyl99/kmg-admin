<template>
  <!-- Left Sidebar -->
  <aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
      <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
      <router-link :to="{ name: 'home' }">
        <img src="https://www.kmgglobal.com/static/media/logo.fa2b86a2.png" width="25" alt="Aero">
        <span class="m-l-10">{{ appName }}</span>
      </router-link>
    </div>
    <div class="menu">
      <ul class="list">
        <li>
          <div class="user-info">
            <a class="image" href="#"><img :src="user.photo_url" :alt="user.name"></a>
            <div class="detail">
              <h4>{{ user.name }}</h4>
            </div>
          </div>
        </li>
        <li>
          <router-link :to="{ name: 'home' }">
            <i class="zmdi zmdi-home"></i><span>Dashboard</span>
          </router-link>
        </li>
        <li>
          <a href="my-profile.html"><i class="zmdi zmdi-account"></i><span>Containers</span></a>
        </li>
      </ul>
    </div>
  </aside>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'Sidebar',

  data: () => ({
    appName: window.config.appName
  }),

  computed: mapGetters({
    user: 'auth/user'
  })
}
</script>

<style scoped>

</style>
