<template>
  <div>
    <button id="notifications" type="button" class="btn btn-primary">Notifications
      <span class="badge badge-light">{{notifications.length}}</span>
    </button>

    <b-popover
      target="notifications"
      triggers="click"
      placement="bottom"
      container="body"
      ref="popover"
    >
      <template v-if="notifications.length" slot="title">
        <button @click="readAll" type="button" class="btn btn-primary btn-sm">
          <span v-if="!loading">Read all</span>
          <div v-else class="spinner-border spinner-border-sm" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </button>
      </template>
      <b-list-group v-if="notifications.length">
        <b-list-group-item v-for="(notification, key) in notifications" :key="key">
          <notification-component :notification="notification" @read="remove(key)"></notification-component>
        </b-list-group-item>
      </b-list-group>
      <div v-else>No notifications today :)</div>
    </b-popover>
  </div>
</template>
<script>
import axios from "axios";
import NotificationComponent from "./NotificationComponent";
export default {
  components: {
    NotificationComponent
  },
  data() {
    return {
      notifications: [],
      loading: false
    };
  },
  methods: {
    readAll() {
      this.loading = true;
      axios.get("/notifications/readAll").then(({ data }) => {
        this.loading = false;
        this.notifications = [];
      });
    },
    remove(key) {
      this.notifications.splice(key, 1);
    }
  },
  created() {
    axios
      .get("/notifications")
      .then(({ data }) => {
        this.notifications = data;
      })
      .catch(e => console.error);
  }
};
</script>
