<script setup>
import Nav from '../Components/nav.vue';
import {router} from '@inertiajs/vue3';

defineProps({customers: Object})

function destory(id) {
  router.delete(`customer/${id}`);
}

function edit(id) {
  router.get(`customer/edit/${id}`);
}
</script>

<template>
  <Nav></Nav>
  <div class="card col-5 offset-3">
    <table class="table table-responsive table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="customer in customers" v-on="customer.id">
          <td>{{ customer.name }}</td>
          <td>{{ customer.email }}</td>
          <td>{{ customer.phone }}</td>
          <td>
            <button class="btn btn-sm btn-outline-primary" @click.prevent="edit(customer.id)">Edit</button>
            <button class="btn btn-sm btn-outline-danger ms-1" @click.prevent="destory(customer.id)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>