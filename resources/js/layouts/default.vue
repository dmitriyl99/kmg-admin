<template>
  <div class="main-layout">
    <div class="overlay"></div>
    <Sidebar />

    <section class="content">
      <div class="body_scroll">
        <div class="container-fluid">
          <child />
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Sidebar from '../components/Sidebar'

export default {
  name: 'MainLayout',

  components: {
    Sidebar
  }
}
</script>
