<template>
  <card :title="$t('Dashboard')">
    <p class="text-center">KMG Dashboard</p>
  </card>
</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
