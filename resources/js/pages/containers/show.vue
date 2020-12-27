<template>
  <card :title="'Container Data'">
    <div class="table-responsive">
      <table class="table table-striped" v-if="container">
        <thead>
          <tr>
            <th class="text-center">Number</th>
            <th class="text-center">Shipping Line</th>
            <th class="text-center">Port</th>
            <th class="text-center">Status</th>
            <th class="text-center">Is Paid</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="text-center">{{ container.container_number }}</td>
            <td class="text-center">{{ container.shipping_line }}</td>
            <td class="text-center">{{ container.port }}</td>
            <td class="text-center">{{ container.container_status.name }}</td>
            <td class="text-center"><span v-if="container.paid">Yes</span><span v-else>No</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </card>
</template>

<script>
import axios from 'axios'

export default {
  name: "show",
  data: () => ({
    container: null
  }),
  mounted () {
    this.fetchContainer()
  },
  methods: {
    fetchContainer () {
      axios.get(`/api/containers/${this.$route.params.id}`).then(response => {
        this.container = response.data
      })
    }
  }
}
</script>

<style scoped>

</style>
