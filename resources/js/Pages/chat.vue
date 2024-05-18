<script setup>
import Pusher from 'pusher-js';
import {computed, onMounted, onUnmounted, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputError from "@/Components/InputError.vue";

const page = usePage();
const messages = ref([]);

const options = {
  cluster: 'ap1',
  forceTLS: false,
};

const pusher = new Pusher(page.props.pusherKey, options);
const channel = pusher.subscribe(`chat.${page.props.userId}`);

onMounted(() => {
  Echo.private(`chat.${page.props.userId}`)
    .listen('.chat.notification', (e) => {
      alert('New message received');
    });
});

onUnmounted(() => {
  // Unbind the listener and unsubscribe from the channel when the component is unmounted
  channel.unbind('.chat.notification');
  channel.unsubscribe(`chat.${page.props.userId}`);
});

function fetchMessages() {
  router.get('messages', { preserveState: true })
    .then(response => {
      messages.value = response.data; // 'messages' is now a ref, so we use .value to access its value
    })
    .catch(error => {
      console.error('Error fetching messages:', error);
    });
}

const messagesTable = computed(() => {
  return messages.value.map(message => ({
    id: message.id,
    user_id: message.user_id,
    send_to: message.send_to,
    message: message.message,
    time: new Date(message.created_at).toLocaleTimeString(), // Convert timestamp to readable time
  }));
});

function submit() {
  router.post('/customers', form);
}
</script>

<template>
  <AppLayout title="Customer Create">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Chat
      </h2>
    </template>

    <div class="flex flex-col items-center justify-center p-6">
      <div class="w-full max-w-md p-4 border-2 border-gray-300 rounded-xl bg-white">
        <div class="overflow-y-auto h-64">
          <!-- Messages will go here -->
          <div class="p-4" v-for="message in messagesTable" :key="message.id">
            <p class="text-sm font-medium text-gray-900">
              <span class="text-green-600">You</span> on a green background
            </p>
            <p class="text-sm text-gray-500">
              Just now
            </p>
            <p class="mt-1 text-sm text-gray-500">
              Can't wait for the Tailwind CSS version 3.0 release!
            </p>
          </div>
          <!--<div class="p-4">-->
          <!--  <p class="text-sm font-medium text-gray-900">-->
          <!--    <span class="text-blue-600">Jane Doe</span> on a blue background-->
          <!--  </p>-->
          <!--  <p class="text-sm text-gray-500">-->
          <!--    5 minutes ago-->
          <!--  </p>-->
          <!--  <p class="mt-1 text-sm text-gray-500">-->
          <!--    I know, right? So excited!-->
          <!--  </p>-->
          <!--</div>-->
          <!-- Add more messages here -->
        </div>
        <div class="flex mt-4">
          <input type="text" class="flex-1 p-2 border-2 border-r-0 border-gray-300 rounded-l-lg focus:outline-none focus:border-blue-500" placeholder="Type a message...">
          <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-lg">
            Send
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
