<template>
  <card :title="'Containers'">
    <div class="d-flex justify-content-end align-items-center mb-4">
      <router-link :to="{ name: 'containers.create' }" class="btn btn-round btn-primary">
        <i class="zmdi zmdi-plus-circle-o"></i> Add a container
      </router-link>
    </div>
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
          <tr v-for="container in containers.data" :key="container.id">
            <td><router-link :to="{ name: 'containers.show', params: { id: container.id } }">{{ container.container_number }}</router-link></td>
            <td>{{ container.shipping_line }}</td>
            <td>{{ container.port }}</td>
            <td>{{ container.destination }}</td>
            <td><span class="badge" :class="'badge-'+container.container_status.color">{{ container.container_status.name }}</span></td>
            <td>{{ container.capacity }}</td>
            <td>
              <span v-if="container.invoice && container.invoice.active" class="badge badge-success">yes</span>
              <span v-else class="badge badge-danger">no</span>
            </td>
            <td>
              <span v-if="container.images.length > 0" class="badge badge-success">yes</span>
              <span v-else class="badge badge-danger">no</span>
            </td>
            <td>
              <div class="d-flex justify-content-around align-items-center">
                <router-link :to="{ name: 'containers.edit', params: { id: container.id } }" class="btn btn-warning btn-icon" data-toggle="tooltip" title="Edit"><i class="zmdi zmdi-edit"></i></router-link>
                <button type="button" class="btn btn-danger btn-icon" title="Delete" @click="deleteContainer(container.id)"><i class="zmdi zmdi-delete"></i></button>
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
import Swal from 'sweetalert2'

export default {
  name: 'ContainerIndex',
  metaInfo () {
    return { title: 'Containers' }
  },

  data: () => ({
    containers: {},
    query: {
      page: 1,
      per_page: 5
    }
  }),

  mounted () {
    this.fetchContainers(this.$route.query)
  },

  watch: {
    $route: {
      handler (to) {
        this.fetchContainers(to.query)
      }
    }
  },

  methods: {
    fetchContainers (query) {
      const url = '/api/containers'
      axios.get(url, { params: query })
        .then(response => {
          this.containers = response.data
        })
    },
    pagination (page) {
      this.$router.push({ name: 'containers.index', query: { page } })
    },
    deleteContainer (id) {
      Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to delete this container from database? This action cannot be undone',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete(`/api/containers/${id}`).then(response => {
            Swal.fire({
              title: 'Deleted!',
              text: 'The container was deleted',
              icon: 'success'
            })
            this.fetchContainers(this.$route.query)
          })
        }
      })
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
