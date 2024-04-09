<script setup>
import Pusher from 'pusher-js';
import {onMounted, onUnmounted} from "vue";
import {usePage} from "@inertiajs/vue3";
const page = usePage();


const options = {
  cluster: 'ap1',
  forceTLS: false,
};

const pusher = new Pusher(page.props.pusherKey, options);
const channel = pusher.subscribe(
    'chat',
);

const listen = () => {
  channel.bind('chat.notification', function (e) {
    alert();
    /*if (e.advisorId === page.props.auth.user.id) {
      notification.info({
        title: 'Payment',
        iconColor: 'success',
        message: e.message,
        action: {
          label: 'REF#',
          onClick: () => {
            window.open(e.url, '_self');
          },
        },
        timeout: 3500
      });
    }*/
  });
};

onMounted(() => {
  listen();
});

onUnmounted(() => {
  channel.unbind('chat.notification');
  channel.unsubscribe('chat');
});
</script>

<template>
  <div>
    <h1>This is chat component</h1>
  </div>
</template>
