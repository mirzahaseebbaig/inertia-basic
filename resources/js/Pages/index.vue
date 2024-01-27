<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {router} from '@inertiajs/vue3';
import {ref, watch} from "vue";
import Pagination from "@/Components/Pagination.vue";

defineProps({customers: Object})
const search = ref('');

function destory(id) {
  if (confirm('Are you sure you want to delete? ')) {
    router.delete(`customer/${id}`);
  }
}

function edit(id) {
  router.get(`customer/edit/${id}`);
}

watch(search, (value) => {
  router.get(
      "customers",
      {search: value},
      {
        preserveState: true,
      }
  );
});
</script>

<template>
  <AppLayout title="Customer List">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Customer List
      </h2>
    </template>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10">

      <div class="sm:col-span-3">
        <div class="mt-2 mb-2">
          <input v-model="search"
                 class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                 placeholder="Search..."
                 type="text"
          >
        </div>
      </div>

      <div v-if="$page.props.flash.error" class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 inline w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Error alert!</span> {{ $page.props.flash.error }}
        </div>
      </div>

      <div v-if="$page.props.flash.success" class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 bg-white-800 text-green-400 dark:border-green-800" role="alert">
        <svg aria-hidden="true" class="flex-shrink-0 inline w-4 h-4 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Success alert!</span> {{ $page.props.flash.success }}
        </div>
      </div>

      <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Name</th>
              <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Email</th>
              <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Phone</th>
              <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(customer, index) in customers.data" :class="{'bg-gray-600' : index % 2 == 0}"
                class="border-b dark:border-gray-700 bg-gray-800"
                v-on="customer.id">
              <th class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" scope="row">
                {{ customer.name }}
              </th>
              <td class="px-6 py-4">
                {{ customer.email }}
              </td>
              <td class="px-6 py-4">
                {{ customer.phone }}
              </td>
              <td class="px-6 py-4">
                <button class="rounded-sm bg-indigo-700 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        @click.prevent="edit(customer.id)">
                  Edit
                </button>
                <button class="rounded-sm bg-red-400 px-3 py-2 ml-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                        @click.prevent="destory(customer.id)">
                  Delete
                </button>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="p-5 flex justify-end">
          <Pagination :data="customers"/>
        </div>
      </div>

    </div>
  </AppLayout>
</template>
