<template>
  <div class="main-layout">
    <div class="overlay"></div>
    <RightNavbar />
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
import RightNavbar from '../components/RightNavbar'
import Sidebar from '../components/Sidebar'

export default {
  name: 'MainLayout',

  components: {
    RightNavbar,
    Sidebar
  }
}
</script>
