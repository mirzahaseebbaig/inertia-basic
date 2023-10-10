<script setup>
import {router, useForm} from '@inertiajs/vue3';
import Nav from '../Components/nav.vue';

const props = defineProps({
  errors: Object
});

const form = useForm({
  name: null,
  email: null,
  phone: null
});

function submit() {
  router.post('/customers', form);
}
</script>

<template>
  <Nav></Nav>
  <div class="card mt-5">
    <h5 class="card-header">Customer Form</h5>
    <div class="card-body">
      <form @submit.prevent="submit">
        <div class="mb-3">
          <label class="form-label" for="name">Customer Name</label>
          <input id="name" v-model="form.name" class="form-control" type="text">
          <div v-if="props.errors.name" class="text-danger text-xs">{{ props.errors.name }}</div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="email">Email address</label>
          <input id="email" v-model="form.email" class="form-control" type="email">
          <div v-if="props.errors.email" class="text-danger text-xs">{{ props.errors.email }}</div>
        </div>
        <div class="mb-3">
          <label class="form-label" for="phone">Phone#</label>
          <input id="phone" v-model="form.phone" class="form-control" type="text">
          <div v-if="props.errors.phone" class="text-danger text-xs">{{ props.errors.phone }}</div>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
      </form>
    </div>
  </div>
</template>
