<template>
  <div class="card">
    <div v-if="title" class="header">
      {{ title }}
    </div>

    <div class="body">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',

  props: {
    title: { type: String, default: null }
  }
}
</script>
