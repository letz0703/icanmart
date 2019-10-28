Vue.component('ic-message', {
    props: ['title', 'body'],
    data() {
        return {
            isVisible: true
        }
    },
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
    methods: {
        hideModal() {
            this.isVisible = false;
        }
    }
});
Vue.component('task-list', {
    template:`
    <div>
    <task v-for='task in tasks' v-if="task.completed" :key="task.id">
    {{ task.task }}
    </task>
    </div>
    `,

    data() {
        return {
            tasks: [
            { task: 'Go to the store', completed: true },
            { task: 'Go to the home', completed: true },
            ]
        }
    }
});

Vue.component('task', {
    template: '<li><slot></slot></li>',
});

var vm =new Vue({
    el: '#icanmart',
    data: {
        tasks: [
        {message: 'go shopping', completed: false},
        {message: 'watch Miss Troat', completed: true}
        ],
        taskInput: '',
        className: "color-red",
        isLoading: false,
        disabled: false,
        title: "iCANMART"
    },
    computed: {
        reversedTitle() {
           return this.title.split('').reverse().join('');
       },
       incompleteTasks() {
        return this.tasks.filter(one => !one.completed);
    }
},

methods: {
    addTask(){
        this.tasks.push({"message":this.taskInput,"completed":false})
    },
    toggleClass() {
        this.isLoading = true;
        this.className = "color-blue";
        this.disabled = true;
    },
    reset() {
        this.isLoading = false;
        this.className = "color-red";
        this.disabled = false;
    }
}
});
