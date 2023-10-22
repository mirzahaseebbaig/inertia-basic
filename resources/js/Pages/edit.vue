<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from "@/Components/InputError.vue";
import {router, useForm} from '@inertiajs/vue3';

const props = defineProps({
  errors: Object,
  customer: Object
});

const form = useForm({
  name: props.customer.name,
  email: props.customer.email,
  phone: props.customer.phone
});

function submit(id) {
  router.put(`/customer/update/${id}`, this.form);
}
</script>

<template>
  <!--<Nav></Nav>
  <div class="card mt-5">
    <h5 class="card-header">Customer Form</h5>
    <div class="card-body">
      <form @submit.prevent="submit(props.customer.id)">
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
  </div>-->
  <AppLayout title="Customer Edit">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Customer Edit
      </h2>
    </template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form @submit.prevent="submit(props.customer.id)">
        <div class="space-y-12">
          <div class="border-b border-gray-900/10 pb-12">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900" for="name">Customer Name</label>
                <div class="mt-2">
                  <input id="name" v-model="form.name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" type="text">
                  <InputError :message="props.errors.name"/>
                </div>
              </div>

              <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900" for="email">Customer Email</label>
                <div class="mt-2">
                  <input id="email" v-model="form.email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" type="email">
                  <InputError :message="props.errors.email"/>
                </div>
              </div>

              <div class="sm:col-span-3">
                <label class="block text-sm font-medium leading-6 text-gray-900" for="phone">Customer Phone</label>
                <div class="mt-2">
                  <input id="phone" v-model="form.phone" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" type="text">
                  <InputError :message="props.errors.phone"/>
                </div>
              </div>

            </div>
          </div>
        </div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
          <button class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" type="submit">Save</button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
