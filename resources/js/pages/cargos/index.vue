<template>
  <card :title="'Cargo'">
    <div class="d-flex justify-content-end align-items-center mb-4">
      <router-link :to="{ name: 'cargos.create' }" class="btn btn-round btn-primary">
        <i class="zmdi zmdi-plus-circle-o"></i> Add a cargo
      </router-link>
    </div>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>VIN #</th>
            <th>Cargo Name</th>
            <th>Status</th>
            <th>Port</th>
            <th>Destination</th>
            <th>Owner</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="cargo in cargos.data" :key="cargo.id">
            <td>{{ cargo.id }}</td>
            <td>{{ cargo.vin }}</td>
            <td>{{ cargo.name }}</td>
            <td></td>
            <td>{{ cargo.port }}</td>
            <td>{{ cargo.destination_country }}</td>
            <td>{{ cargo.owner }}</td>
            <td>
              <div class="d-flex justify-content-around align-items-center">
                <router-link :to="{ name: 'cargos.edit', params: { id: cargo.id } }" class="btn btn-warning btn-icon" data-toggle="tooltip" title="Edit"><i class="zmdi zmdi-edit"></i></router-link>
                <button type="button" @click="deleteCargo(cargo.id)" class="btn btn-danger btn-icon" title="Delete"><i class="zmdi zmdi-delete"></i></button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="d-flex justify-content-center align-items-center">
        <ul class="pagination">
          <li v-for="link in paginationLinks" :key="link.label" :class="{ 'active': link.active }" class="page-item">
            <button @click="pagination(link.label)" class="page-link">{{ link.label }}</button>
          </li>
        </ul>
      </div>
    </div>
  </card>
</template>

<script>
import axios from 'axios'
import Swal from "sweetalert2";

export default {
  name: 'CargoIndex',
  metaInfo () {
    return { title: 'Cargos' }
  },

  data: () => ({
    cargos: [],
    query: {
      page: 1,
      per_page: 15
    }
  }),

  computed: {
    paginationLinks () {
      if (this.cargos.links) {
        return this.cargos.links.slice(1, -1)
      }
      return []
    }
  },

  watch: {
    $route: {
      handler (to) {
        this.fetchCargos(to.query)
      }
    }
  },

  mounted () {
    this.fetchCargos({})
  },

  methods: {
    fetchCargos (query) {
      const url = '/api/cargos'
      axios.get(url, { params: query })
        .then(response => {
          this.cargos = response.data
        })
    },

    pagination (page) {
      this.$router.push({ name: 'cargos.index', query: { page } })
    },

    deleteCargo (id) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to delete this cargo from database? This action cannot be undone',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it'
      }).then(result => {
        if (result.isConfirmed) {
          axios.delete(`/api/cargos/${id}`).then(response => {
            Swal.fire({
              title: 'Deleted!',
              text: 'The cargo deleted',
              icon: 'success'
            })
            this.fetchCargos(this.$route.query)
          })
        }
      })
    }
  }
}
</script>

<style scoped>

</style>
