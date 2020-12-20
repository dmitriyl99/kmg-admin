<template>
  <card :title="'Containers'">
    <div class="table-responsive">
      <table class="table table-stripped">
        <thead>
          <tr>
            <th>Container #</th>
            <th>Shipping Line</th>
            <th>Port</th>
            <th>Dest</th>
            <th>Status</th>
            <th>Loaded/Capacity</th>
            <th>Invoice</th>
            <th>Photo</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="container in containers" :key="container.id">
            <td>{{ container.container_number }}</td>
            <td>{{ container.shipping_line }}</td>
            <td>{{ container.port }}</td>
            <td>{{ container.destination }}</td>
            <td><span class="badge" :class="'badge-'+container.container_status.color">{{ container.container_status.name }}</span></td>
            <td>{{ container.capacity }}</td>
            <td>
              <span v-if="container.invoice" class="badge badge-success">yes</span>
              <span v-else class="badge badge-danger">no</span>
            </td>
            <td>
              <span v-if="container.images.length > 0" class="badge badge-success">yes</span>
              <span v-else class="badge badge-danger">no</span>
            </td>
            <td>
              <span>Actions</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </card>
</template>

<script>
import axios from 'axios'

export default {
  name: 'ContainerIndex',

  metaInfo () {
    return { title: 'Containers' }
  },

  data: () => ({
    containers: []
  }),

  mounted () {
    this.fetchContainers()
  },

  methods: {
    fetchContainers () {
      axios.get('/api/containers')
        .then(response => {
          console.log(response.data)
          this.containers = response.data.data
          console.log(this.containers)
        })
    }
  }
}
</script>

<style scoped>

</style>
