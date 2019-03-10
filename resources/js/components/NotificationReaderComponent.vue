<template>
    <div>
        <button id="notifications" type="button" class="btn btn-primary" >
            Notifications <span class="badge badge-light">{{notifications.length}}</span>
        </button>

        <b-popover
        target="notifications"
        triggers="click"
        placement="bottom"
        container="body"
        ref="popover"
        >
            <template slot="title">
                <button @click="readAll" type="button" class="btn btn-primary btn-sm">Read all</button>
            </template>
            <b-list-group>
                <b-list-group-item v-for="(notification, key) in notifications" :key="key">
                    <notification-component :notification="notification"></notification-component>
                </b-list-group-item>
            </b-list-group>
        </b-popover>
    </div>
</template>
<script>
import axios from 'axios';
import NotificationComponent from './NotificationComponent';
export default {
    components: {
        NotificationComponent
    },
    data() {
        return {
            notifications: []
        }
    },
    methods: {
        readAll() {
            console.log('hello')
        }
    },
    created() {
        axios.get('/notifications')
            .then(({data}) => {
                this.notifications = data;
            })
            .catch(e => console.error);
    }
}
</script>
