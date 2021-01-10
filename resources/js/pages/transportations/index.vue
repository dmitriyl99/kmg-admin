<template>
  <card :title="'Transportations'">
    <div class="d-flex justify-content-end align-items-center mb-4">
      <router-link :to="{ name: 'transportations.create' }" class="btn btn-round btn-primary">
        <i class="zmdi zmdi-plus-circle-o"></i> Add a transportation
      </router-link>
    </div>
    <div class="table-responsive">
      <table class="table table-stripped">
        <thead>
          <tr>
            <th>VIN</th>
            <th>Seller</th>
            <th>Vehicle status</th>
            <th>Transporter</th>
            <th>Port</th>
            <th>Warehouse</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="transportation in transportations.data" :key="transportation.id">
            <td>{{ transportation.cargo.vin }}</td>
            <td>{{ transportation.seller_name }}</td>
            <td></td>
            <td>{{ transportation.transporter }}</td>
            <td>{{ transportation.cargo.port }}</td>
            <td>{{ transportation.warehouse }}</td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </card>
</template>

<script>
import axios from 'axios'

export default {
  name: "TransportationIndex",
  metaInfo () {
    return {title: 'Transportations'}
  },

  data: () => ({
    transportations: [],
    query: {
      page: 1,
      per_page: 15
    }
  }),

  mounted () {
    this.fetchTransportations(this.$route.query)
  },

  watch: {
    $route: {
      handler (to) {
        this.fetchTransportations(to.query)
      }
    }
  },

  methods: {
    fetchTransportations (query = {}) {
      const url = '/api/transportations'
      axios.get(url, { params: query })
        .then(response => {
          this.transportations = response.data
        })
    },
    pagination (page) {
      this.$router.push({ name: 'transportations.index', query: { page } })
    }
  },

  computed: {
    paginationLinks () {
      if (this.containers.links) {
        return this.containers.links.slice(1, -1)
      }
      return []
    }
  }
}
</script>

<style scoped>

</style>
