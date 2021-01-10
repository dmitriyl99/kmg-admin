<template>
  <card :title="'Add a new transportation'">
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
      <div class="row clearfix">
        <div class="col-md-4 col-sm-12">
          <h3 class="content-heading">Carrier Information</h3>
          <div class="form-group mb-3">
            <label for="transporter">Transporter</label>
            <input v-model="form.transporter" :class="{ 'is-invalid': form.errors.has('transporter') }" type="text" class="form-control" id="transporter">
            <has-error :form="form" field="transporter" />
          </div>
          <div class="form-group mb-3">
            <label for="cost">Cost</label>
            <input v-model="form.cost" :class="{ 'is-invalid': form.errors.has('cost') }" type="number" class="form-control" id="cost">
            <has-error :form="form" field="cost" />
          </div>
          <div class="form-group mb-3">
            <label for="phone">Phone</label>
            <input v-model="form.phone" :class="{ 'is-invalid': form.errors.has('phone') }" type="text" class="form-control" id="phone">
            <has-error :form="form" field="phone" />
          </div>
          <div class="checkbox">
            <input id="transporter_paid" v-model="form.transportation_paid" type="checkbox">
            <label for="transporter_paid">Is Paid</label>
          </div>
          <div class="checkbox">
            <input id="delivered" v-model="form.delivered" type="checkbox">
            <label for="delivered">Delivered</label>
          </div>
          <div class="form-group mb-3">
            <label for="carrier_comment">Comment</label>
            <input v-model="form.carrier_comment" :class="{ 'is-invalid': form.errors.has('carrier_comment') }" type="text" class="form-control" id="carrier_comment">
            <has-error :form="form" field="carrier_comment" />
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <h3 class="content-heading">Seller Information</h3>
          <div class="form-group mb-3">
            <label for="seller_name">Name</label>
            <input v-model="form.seller_name" :class="{ 'is-invalid': form.errors.has('seller_name') }" type="text" class="form-control" id="seller_name">
            <has-error :form="form" field="seller_name" />
          </div>
          <div class="form-group mb-3">
            <label for="carrier_comment">Lot #</label>
            <input v-model="form.lot_number" :class="{ 'is-invalid': form.errors.has('lot_number') }" type="text" class="form-control" id="lot_number">
            <has-error :form="form" field="lot_number" />
          </div>
          <div class="form-group mb-3">
            <label for="account_number">Account #</label>
            <input v-model="form.account_number" :class="{ 'is-invalid': form.errors.has('account_number') }" type="text" class="form-control" id="account_number">
            <has-error :form="form" field="account_number" />
          </div>
          <div class="form-group mb-3">
            <label for="carrier_comment">Phone</label>
            <input v-model="form.seller_phone" :class="{ 'is-invalid': form.errors.has('seller_phone') }" type="text" class="form-control" id="seller_phone">
            <has-error :form="form" field="seller_phone" />
          </div>
          <div class="form-group mb-3">
            <label for="carrier_comment">Address</label>
            <input v-model="form.seller_address" :class="{ 'is-invalid': form.errors.has('seller_address') }" type="text" class="form-control" id="seller_address">
            <has-error :form="form" field="seller_address" />
          </div>
          <div class="form-group mb-3">
            <label for="carrier_comment">Pick up by</label>
            <input v-model="form.pick_up_by" :class="{ 'is-invalid': form.errors.has('pick_up_by') }" type="text" class="form-control" id="pick_up_by">
            <has-error :form="form" field="pick_up_by" />
          </div>
          <div class="form-group mb-3">
            <label for="carrier_comment">Comment</label>
            <input v-model="form.seller_comment" :class="{ 'is-invalid': form.errors.has('seller_comment') }" type="text" class="form-control" id="seller_comment">
            <has-error :form="form" field="seller_comment" />
          </div>
        </div>
        <div class="col-md-4 col-sm-12">
          <h3 class="content-heading">Vehicle Information</h3>
          <div class="form-group mb-3">
            <label for="cargo_id">Vin</label>
            <select v-model="form.cargo_id" :class="{ 'is-invalid': form.errors.has('cargo_id') }" type="text" class="form-control" id="cargo_id">
              <option value="0" selected disabled></option>
              <option v-for="cargo in cargos" :key="cargo.id" :value="cargo.id">{{ cargo.vin }}</option>
            </select>
            <has-error :form="form" field="cargo_id" />
          </div>
          <div class="form-group mb-3">
            <label for="warehouse">Warehouse</label>
            <input v-model="form.warehouse" :class="{ 'is-invalid': form.errors.has('warehouse') }" type="text" class="form-control" id="warehouse">
            <has-error :form="form" field="warehouse" />
          </div>
          <div class="form-group mb-3">
            <label for="carrier_comment">Purchased Date</label>
            <input v-model="form.purchased_date" :class="{ 'is-invalid': form.errors.has('purchased_date') }" type="text" class="form-control" id="purchased_date">
            <has-error :form="form" field="purchased_date" />
          </div>
          <div class="checkbox">
            <input id="paid" v-model="form.paid" type="checkbox">
            <label for="paid">Is Paid</label>
          </div>
          <div class="checkbox">
            <input id="ready" v-model="form.ready" type="checkbox">
            <label for="ready">Is Ready</label>
          </div>
          <div class="checkbox">
            <input id="has_photo" v-model="form.has_photos" type="checkbox">
            <label for="has_photo">Has Photos</label>
          </div>
          <div class="form-group mb-3">
            <label for="status">Status</label>
            <select v-model="form.status" :class="{ 'is-invalid': form.errors.has('status') }" type="text" class="form-control" id="status">
              <option value="0" selected disabled></option>
              <option value="INOP">INOP</option>
              <option value="Run & Drive">Run & Drive</option>
            </select>
            <has-error :form="form" field="cargo_id" />
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
import VButton from "../../components/Button";
import Form from 'vform'
import axios from "axios";
import Swal from "sweetalert2";

export default {
  name: 'edit',
  components: { VButton },

  metaInfo () {
    return { title: 'Add transportation' }
  },

  data: () => ({
    form: new Form({
      transporter: '',
      cost: 0.0,
      phone: '',
      transportation_paid: false,
      delivered: false,
      carrier_comment: '',

      seller_name: '',
      lot_number: '',
      account_number: '',
      seller_phone: '',
      seller_address: '',
      pick_up_by: '',
      seller_comment: '',

      cargo_id: 0,
      warehouse: '',
      purchased_date: '',
      paid: false,
      ready: false,
      has_photos: false,
      status: ''
    }),

    cargos: [],
    transportation: {}
  }),
  mounted() {
    this.fetchCargos()
    const id = this.$route.params.id
    this.fetchTransportation(id)
  },
  methods: {
    fetchCargos() {
      axios.get('/api/cargos', { params: {paginate: 0} })
        .then(response => {
          this.cargos = response.data
        })
    },

    fetchTransportation(id) {
      axios.get(`/api/transportations/${id}`)
        .then(({ data }) => {
          this.form.fill(data)
          this.transportation = data
        })
    },

    update () {
      this.form.post(`/api/transportations/${this.transportation.id}/update`)
        .then(({ data }) => {
          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: `The transportation for ${data.cargo.vin} updated`,
            confirmButtonText: 'Ok'
          })
          this.$router.push({ name: 'transportations.index' })
        })
    }
  }
}
</script>

<style scoped>

</style>
