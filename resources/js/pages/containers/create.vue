<template>
  <card :title="'Add a new container'">
    <form enctype="multipart/form-data" @submit.prevent="create" @keydown="form.onKeydown($event)">
      <ul class="nav nav-tabs p-0 mb-3">
        <li class="nav-item">
          <a href="#main" class="nav-link" :class="{'active': tabs.main}" data-toggle="tab" @click="changeTab('main')">Main Information</a>
        </li>
        <li class="nav-item">
          <a href="#images" class="nav-link" :class="{'active': tabs.images}" data-toggle="tab" @click="changeTab('images')">Images</a>
        </li>
        <li class="nav-item">
          <a href="#invoice" class="nav-link" :class="{'active': tabs.invoice}" data-toggle="tab" @click="changeTab('invoice')">Invoice</a>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane" :class="{'in active': tabs.main}" id="main" role="tabpanel">
          <div class="row clearfix">
            <div class="col-md-6 col-sm-12">
              <h3 class="content-heading">Container Information</h3>
              <div class="form-group mb-3">
                <label for="shippingLine">Shipping Line</label>
                <input v-model="form.shipping_line" :class="{ 'is-invalid': form.errors.has('shipping_line') }" type="text" class="form-control" id="shippingLine">
                <has-error :form="form" field="shipping_line" />
              </div>
              <div class="form-group mb-3">
                <label for="containerNumber">Container #</label>
                <input v-model="form.container_number" :class="{ 'is-invalid': form.errors.has('container_number') }" type="text" class="form-control" id="containerNumber">
                <has-error :form="form" field="container_number" />
              </div>
              <div class="form-group mb-3">
                <label for="bookingNumber">Booking #</label>
                <input v-model="form.booking_number" :class="{ 'is-invalid': form.errors.has('booking_number') }" type="text" class="form-control" id="bookingNumber">
                <has-error :form="form" field="booking_number" />
              </div>
              <div class="form-group mb-3">
                <label for="capacity">Max Loading</label>
                <input v-model="form.capacity" :class="{ 'is-invalid': form.errors.has('capacity') }" type="text" class="form-control" id="capacity">
                <has-error :form="form" field="capacity" />
              </div>
              <div class="form-group mb-3">
                <label for="trackingLink">Tracking Link</label>
                <input v-model="form.tracking_link" :class="{ 'is-invalid': form.errors.has('tracking_link') }" type="text" class="form-control" id="trackingLink">
                <has-error :form="form" field="tracking_link" />
              </div>
              <div class="checkbox">
                <input id="paid" v-model="form.paid" type="checkbox">
                <label for="paid">Is Paid</label>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <h3 class="content-heading">Shipping Information</h3>
              <div class="form-group mb-3">
                <label for="containerStatusId">Status</label>
                <select v-model="form.container_status_id" :class="{ 'is-invalid': form.errors.has('container_status_id') }" type="text" class="form-control" id="containerStatusId">
                  <option v-for="status in statuses" :key="status.id" :value="status.id">{{ status.name }}</option>
                </select>
                <has-error :form="form" field="container_status_id" />
              </div>
              <div class="form-group mb-3">
                <label for="port">Port</label>
                <input id="port" v-model="form.port" :class="{ 'is-invalid': form.errors.has('port') }" type="text" class="form-control">
                <has-error :form="form" field="port" />
              </div>
              <div class="form-group mb-3">
                <label for="destination">Destination</label>
                <input v-model="form.destination" :class="{ 'is-invalid': form.errors.has('destination') }" type="text" id="destination" class="form-control">
                <has-error :form="form" field="destination" />
              </div>
              <div class="form-group mb-3">
                <label for="departureDate">Estimate time of departure</label>
                <input v-model="form.departure_date" :class="{ 'is-invalid': form.errors.has('departure_date') }" type="text" id="departureDate" class="form-control">
                <has-error :form="form" field="departure_date" />
              </div>
              <div class="form-group mb-3">
                <label for="departureDate">Estimate time of arrival</label>
                <input v-model="form.arrival_date" :class="{ 'is-invalid': form.errors.has('arrival_date') }" type="text" id="arrivalDate" class="form-control">
                <has-error :form="form" field="arrival_date" />
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" :class="{'in active': tabs.images}" id="images" role="tabpanel">
          <h3 class="content-heading">Upload images</h3>
          <div class="row clearfix">
            <div class="form-group">
              <input type="file" name="images[]" multiple accept="image/*" @change="filesSelected">
            </div>
          </div>
        </div>
        <div class="tab-pane" :class="{'in active': tabs.invoice}" id="invoice" role="tabpanel">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <h3 class="content-heading">Invoice Settings</h3>
              <div class="checkbox">
                <input id="active" v-model="form.invoice.active" type="checkbox">
                <label for="active">Active?</label>
              </div>
              <div class="form-group mb-3">
                <label for="invoice.date">Invoice Date</label>
                <input v-model="form.invoice.date" :class="{ 'is-invalid': form.errors.has('invoice.date') }" type="text" class="form-control" id="invoice.date">
                <has-error :form="form" field="invoice.date" />
              </div>
              <div class="form-group mb-3">
                <label for="invoice.containerSize">Container Size</label>
                <select v-model="form.invoice.container_size" :class="{ 'is-invalid': form.errors.has('invoice.container_size') }" type="text" class="form-control" id="invoice.containerSize">
                  <option value="20'">20'</option>
                  <option value="40'">40'</option>
                  <option value="45'">45'</option>
                </select>
                <has-error :form="form" field="invoice.container_size" />
              </div>
              <div class="form-group mb-3">
                <label for="invoice.company">Company</label>
                <input v-model="form.invoice.company" :class="{ 'is-invalid': form.errors.has('invoice.company') }" type="text" class="form-control" id="invoice.company">
                <has-error :form="form" field="invoice.company" />
              </div>
              <div class="form-group mb-3">
                <label for="invoice.totalDue">Total due</label>
                <input v-model="form.invoice.total_due" :class="{ 'is-invalid': form.errors.has('invoice.total_due') }" type="text" class="form-control" id="invoice.totalDue">
                <has-error :form="form" field="invoice.total_due" />
              </div>
              <div class="form-group mb-3">
                <label for="invoice.shipper">Shipper</label>
                <textarea v-model="form.invoice.shipper" :class="{ 'is-invalid': form.errors.has('invoice.shipper') }" type="text" class="form-control" id="invoice.shipper"></textarea>
                <has-error :form="form" field="invoice.shipper" />
              </div>
              <div class="form-group mb-3">
                <label for="invoice.consignee">Consignee</label>
                <textarea v-model="form.invoice.consignee" :class="{ 'is-invalid': form.errors.has('invoice.consignee') }" type="text" class="form-control" id="invoice.consignee"></textarea>
                <has-error :form="form" field="invoice.consignee" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-start align-items-center">
        <v-button :loading="form.busy" :type="'primary'" :native-type="'submit'">
          <i class="zmdi zmdi-save"></i> Create
        </v-button>
      </div>
    </form>
  </card>
</template>

<script>
import Form from 'vform'
import VButton from '../../components/Button'
import axios from 'axios'
import Swal from 'sweetalert2'
import { serialize } from 'object-to-formdata'

export default {
  name: 'create',
  components: { VButton },
  metaInfo () {
    return { title: 'Add container' }
  },

  data: () => ({
    tabs: {
      main: true,
      images: false,
      invoice: false
    },
    form: new Form({
      container_number: '',
      booking_number: '',
      shipping_line: '',
      capacity: 4,
      tracking_link: '',
      paid: false,

      container_status_id: 1,
      port: '',
      destination: '',
      departure_date: '',
      arrival_date: '',

      images: null,

      invoice: {
        active: false,
        date: new Date(),
        container_size: 0,
        company: '',
        total_due: 0,
        shipper: '',
        consignee: ''
      }
    }),
    statuses: []
  }),

  mounted () {
    this.fetchStatuses()
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

    fetchStatuses () {
      axios.get('/api/containers/statuses').then(response => {
        this.statuses = response.data
      })
    },

    filesSelected (e) {
      const files = e.target.files
      this.form.images = files
    },

    create () {
      this.form.post('/api/containers', {
        transformRequest: [function (data, headers) {
          return serialize(data)
        }]
      })
        .then(({ data }) => {
          Swal.fire({
            icon: 'sucess',
            title: 'Success',
            text: `A new container ${data.container_number} is created`,
            confirmButtonText: 'Ok'
          })
          this.$router.push({ name: 'containers.index' })
        })
    }
  }
}
</script>

<style scoped>

</style>
