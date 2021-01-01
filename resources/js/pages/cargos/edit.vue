<template>
  <card :title="'Add a new cargo'">
    <form enctype="multipart/form-data" @submit.prevent="create" @keydown="form.onKeydown($event)">
      <ul class="nav nav-tabs p-0 mb-3">
        <li class="nav-item">
          <a href="#main" class="nav-link" :class="{'active': tabs.main}" data-toggle="tab" @click="changeTab('main')">Main Information</a>
        </li>
        <li class="nav-item">
          <a href="#images" class="nav-link" :class="{'active': tabs.images}" data-toggle="tab" @click="changeTab('images')">Images</a>
        </li>
      </ul>
      <div class="tab-content">
        <div id="main" class="tab-pane" :class="{'in active': tabs.main}" role="tabpanel">
          <div class="row clearfix">
            <div class="col-md-4 col-sm-12">
              <card :title="'Cargo information'">
                <div class="form-group mb-3">
                  <label for="name">Name</label>
                  <input id="name" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" type="text" class="form-control">
                  <has-error :form="form" field="name" />
                </div>
                <div class="form-group mb-3">
                  <label for="owner">Owner</label>
                  <input id="owner" v-model="form.owner" :class="{ 'is-invalid': form.errors.has('owner') }" type="text" class="form-control">
                  <has-error :form="form" field="owner" />
                </div>
                <div class="form-group mb-3">
                  <label for="vin">VIN</label>
                  <input id="vin" v-model="form.vin" :class="{ 'is-invalid': form.errors.has('vin') }" type="text" class="form-control">
                  <has-error :form="form" field="vin" />
                </div>
                <div class="form-group mb-3">
                  <label for="port">Port</label>
                  <input id="port" v-model="form.port" :class="{ 'is-invalid': form.errors.has('port') }" type="text" class="form-control">
                  <has-error :form="form" field="port" />
                </div>
                <div class="form-group mb-3">
                  <label for="received_at">Cargo received</label>
                  <input id="received_at" v-model="form.received_at" :class="{ 'is-invalid': form.errors.has('received_at') }" type="text" class="form-control">
                  <has-error :form="form" field="received_at" />
                </div>
                <div class="form-group mb-3">
                  <label for="destination_country">Destination country</label>
                  <input id="destination_country" v-model="form.destination_country" :class="{ 'is-invalid': form.errors.has('destination_country') }" type="text" class="form-control">
                  <has-error :form="form" field="destination_country" />
                </div>
              </card>
            </div>
            <div class="col-md-4 col-sm-12">
              <card :title="'Transportation'">
                <div class="form-group mb-3">
                  <label for="transportation_from">From</label>
                  <input id="transportation_from" v-model="form.transportation_from" :class="{ 'is-invalid': form.errors.has('transportation_from') }" type="text" class="form-control">
                  <has-error :form="form" field="transportation_from" />
                </div>
                <div class="form-group mb-3">
                  <label for="transportation_address">Address</label>
                  <input id="transportation_address" v-model="form.transportation_address" :class="{ 'is-invalid': form.errors.has('transportation_address') }" type="text" class="form-control">
                  <has-error :form="form" field="transportation_address" />
                </div>
                <div class="form-group mb-3">
                  <label for="transportation_price">Transportation price</label>
                  <input id="transportation_price" v-model="form.transportation_price" :class="{ 'is-invalid': form.errors.has('transportation_price') }" type="text" class="form-control">
                  <has-error :form="form" field="transportation_price" />
                </div>
              </card>
            </div>
            <div class="col-md-4 col-sm-12">
              <card :title="'Title information'">
                <div class="form-group mb-3">
                  <label for="date_received">Date received</label>
                  <input id="date_received" v-model="form.date_received" :class="{ 'is-invalid': form.errors.has('date_received') }" type="text" class="form-control">
                  <has-error :form="form" field="date_received" />
                </div>
              </card>
            </div>
          </div>
          <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
              <card :title="'Data on delivery'">
                <div class="form-group mb-3">
                  <label for="container_id">Container</label>
                  <select id="container_id" v-model="form.container_id" class="form-control">
                    <option value="" disabled selected></option>
                    <option v-for="container in containers" :key="container.id" :value="container.id">
                      {{ container.container_number }}
                    </option>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="total_due">Total due for shipping</label>
                  <input id="total_due" v-model="form.total_due" :class="{ 'is-invalid': form.errors.has('total_due') }" type="text" class="form-control">
                  <has-error :form="form" field="total_due" />
                </div>
              </card>
            </div>
            <div class="col-md-6 col-sm-12">
              <card :title="'Documents'">
                <div class="form-group mb-3">
                  <label for="postal_service">Postal Service</label>
                  <input id="postal_service" v-model="form.postal_service" :class="{ 'is-invalid': form.errors.has('postal_service') }" type="text" class="form-control">
                  <has-error :form="form" field="postal_service" />
                </div>
                <div class="form-group mb-3">
                  <label for="tracking_number">Tracking #</label>
                  <input id="tracking_number" v-model="form.tracking_number" :class="{ 'is-invalid': form.errors.has('tracking_number') }" type="text" class="form-control">
                  <has-error :form="form" field="tracking_number" />
                </div>
              </card>
            </div>
          </div>
        </div>
        <div id="images" class="tab-pane" :class="{'in active': tabs.images}" role="tabpanel">
          <h3 class="content-heading">
            Upload images
          </h3>
          <div class="row clearfix">
            <div class="form-group">
              <input type="file" name="images[]" multiple accept="image/*" @change="filesSelected">
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-start align-items-center">
        <v-button :loading="form.busy" :type="'primary'" :native-type="'submit'">
          <i class="zmdi zmdi-save" /> Update
        </v-button>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'
import VButton from '../../components/Button'
import axios from 'axios'
import { serialize } from 'object-to-formdata'
import Swal from 'sweetalert2'

export default {
  name: 'CargoEdit',
  components: { VButton },
  metaInfo () {
    return { title: 'Create cargo' }
  },

  data: () => ({
    tabs: {
      main: true,
      images: false
    },
    id: null,
    form: new Form({
      owner: '',
      name: '',
      vin: '',
      port: '',
      received_at: '',
      destination_country: '',

      transportation_from: '',
      transportation_address: '',
      transportation_price: '',

      date_received: '',
      key: '',

      container_id: '',
      total_due: '',

      postal_service: '',
      tracking_number: ''
    }),
    containers: []
  }),

  mounted () {
    this.getContainers()
    this.fetchCargo()
  },

  methods: {
    changeTab (tab) {
      switch (tab) {
        case 'main': {
          this.tabs.main = true
          this.tabs.images = false
          this.tabs.invoice = false
          break
        }
        case 'images': {
          this.tabs.main = false
          this.tabs.images = true
          this.tabs.invoice = false
          break
        }
        case 'invoice': {
          this.tabs.main = false
          this.tabs.images = false
          this.tabs.invoice = true
          break
        }
      }
    },

    getContainers () {
      axios.get('/api/containers', { params: { paginate: 0 } })
        .then(response => {
          this.containers = response.data
        })
    },

    fetchCargo () {
      this.id = this.$route.params.id
      axios.get(`/api/cargos/${this.id}`).then(response => {
        const data = response.data
        this.form.fill(data)
      })
    },

    filesSelected (e) {
      const files = e.target.files
      this.form.images = files
    },

    create () {
      this.form.post(`/api/cargos/${this.id}/update`, {
        transformRequest: [function (data, headers) {
          return serialize(data)
        }]
      })
        .then(({ data }) => {
          Swal.fire({
            icon: 'sucess',
            title: 'Success',
            text: `The cargo ${data.vin} ${data.name} updated`,
            confirmButtonText: 'Ok'
          })
          this.$router.push({ name: 'cargos.index' })
        })
    },
  }
}
</script>

<style scoped>

</style>
