Vue.component('tabs', {
    template: `
    <div>
        <div class="tabs">
            <ul>
                <li v-for="tab in tabs"><a href="#">{{ tab.name }}</a></li>
            </ul>
        </div>
        <div class="tabs-details">
            <div><slot></slot></div>
        </div>
    </div>
    `,
    data(){
        return {
            tabs: [],
        }
    },
    created(){
        this.tabs = this.$children;
    },
});

Vue.component('tab', {
    template: `
        <div><slot></slot></div>
    `,
    props: {
        name: { required: true },
    },

});
Vue.component('modal', {
    template: `
        <div class="modal is-active">
        <div class="modal-background"></div>
        <div class="modal-content">
            <div class="box">
                <p><slot></slot></p>
            </div>
        </div>
        <button class="modal-close" @click="$emit('close')"></button>
    </div>
    `,

});

Vue.component('ic-message', {
    template: `
    <article class="message is-info" v-show="isVisible">
        <div class="message-header">
            {{ title }}
            <button class="delete" aria-label="delete" @click="hideModal"></button>
        </div>
        <div class="message-body">
            {{ body }}
        </div>
    </article>
    `,

    props: ['title', 'body'],
    data(){
        return {
            isVisible: true,
        }
    },

    methods: {
        hideModal(){
            this.isVisible = false;
        },
    },
});

Vue.component('task-list', {
    template: `
    <div>
    <task v-for='task in tasks' v-if="task.completed" :key="task.id">
    {{ task.task }}
    </task>
    </div>
    `,

    data(){
        return {
            tasks: [
                { task: 'Go to the store', completed: true },
                { task: 'Go to the home', completed: true },
            ],
        }
    },
});

Vue.component('task', {
    template: '<li><slot></slot></li>',
});

var vm = new Vue({
    el: '#icanmart',
    data: {
        tasks: [
            { message: 'go shopping', completed: false },
            { message: 'watch Miss Troat', completed: true },
        ],
        taskInput: '',
        className: "color-red",
        isLoading: false,
        disabled: false,
        title: "SKSAT",
        showModal: false,
    },
    computed: {
        reversedTitle(){
            return this.title.split('').reverse().join('');
        },
        incompleteTasks(){
            return this.tasks.filter(one => !one.completed);
        },
    },

    methods: {

        addTask(){
            this.tasks.push({ "message": this.taskInput, "completed": false })
        },
        toggleClass(){
            this.isLoading = true;
            this.className = "color-blue";
            this.disabled = true;
        },
        reset(){
            this.isLoading = false;
            this.className = "color-red";
            this.disabled = false;
        },
    },
});
