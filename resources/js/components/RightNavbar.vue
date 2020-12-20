<template>
  <!-- Right Icon menu Sidebar -->
  <div class="navbar-right">
    <ul class="navbar-nav">
      <li><a @click="logout" class="mega-menu" title="Sign Out"><i class="zmdi zmdi-power"></i></a></li>
    </ul>
  </div>
</template>

<script>
export default {
  name: 'RightNavbar',

  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')
      this.$router.push({ name: 'login' })
    }
  }
}
</script>
