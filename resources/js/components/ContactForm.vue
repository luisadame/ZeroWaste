<template>
    <div class="form w-50">
        <div v-show="!submitted" class="wrapper">
            <div class="steps d-flex flex-nowrap" :style="position">
                <div class="step d-flex flex-column">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="icon-name"><i class="fas fa-signature"></i></span>
                        </div>
                        <input v-model="name" type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="icon-name">
                    </div>
                    <div class="controls my-5">
                        <button v-on:click="next" class="btn btn-primary">Next</button>
                    </div>
                </div>
                <div class="step d-flex flex-column">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="icon-email"><i class="fas fa-at"></i></span>
                        </div>
                        <input v-model="email" type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="icon-email">
                    </div>
                    <div class="controls my-5">
                        <button v-on:click="previous" class="btn btn-primary">Previous</button>
                        <button v-on:click="next" class="btn btn-primary">Next</button>
                    </div>
                </div>
                <div class="step d-flex flex-column">
                    <div class="btn-group" role="group" aria-label="Type of contact request">
                        <button @click="changeType('support')" type="button" class="btn btn-secondary">Support</button>
                        <button @click="changeType('business')" type="button" class="btn btn-secondary">Business</button>
                    </div>
                    <div class="controls my-5">
                        <button v-on:click="previous" class="btn btn-primary">Previous</button>
                        <button v-on:click="next" class="btn btn-primary">Next</button>
                    </div>
                </div>
                <div class="step d-flex flex-column">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="icon-message"><i class="fas fa-envelope-open-text"></i></span>
                        </div>
                        <textarea class="form-control" aria-describedby="icon-message" v-model="message" placeholder="Your message"></textarea>
                    </div>
                    <div class="controls my-5">
                        <button v-on:click="previous" class="btn btn-primary">Previous</button>
                        <button v-on:click="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-show="!submitted" class="progress">
            <div class="progress-bar" role="progressbar" :style="`width: ${percent}%`" :aria-valuenow="percent" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <div v-if="submitted" class="d-flex justify-content-center align-items-center">
            <i class="fas fa-check-circle"></i><h2>Your request was sent!</h2>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: null,
            email: null,
            message: null,
            type: null,
            steps: 4,
            step: 1,
            submitted: false
        }
    },
    computed: {
        percent: function() {
            return (this.step / this.steps) * 100;
        },
        position: function() {
            let x = (this.step - 1) * -100;
            return `transform: translate3d(${x}%, 0, 0);`
        }
    },
    methods: {
        changeType(type) {
            this.type = type;
        },
        next() {
            this.step++;
        },
        previous() {
            this.step--;
        },
        submit() {
            this.submitted = true;
            console.log('Imagine this form was validated and submitted correctly :)');
        }
    }
}
</script>
<style>
.form .wrapper {
    overflow: hidden;
}
.steps {
    transition: all 250ms ease;
}
.step {
    flex: 1 0 100%;
}
</style>
