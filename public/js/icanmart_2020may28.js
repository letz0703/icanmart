window.Event = new Vue();

Vue.component('coupon', {
    // template: '<input placeholder="Enter your code" @blur"applied">',
    template: '<input placeholder="Enter your code" @blur="applied">',
    methods: {
        applied(){
            Event.$emit('couponApplied');
        },
    },

});

Vue.component('tab', {
    template: `
    <div>
        <div v-show="isActive"><slot></slot></div>
        <h1 v-if="couponUsed">쿠폰을 사용하셨습니다.</h1>
    </div>
    `,
    props: {
        name: { required: true },
        selected: { default: false },
    },
    data(){
        return {
            isActive: false,
            couponUsed: false,
        }
    },
    mounted(){
        this.isActive = this.selected;
    },
    computed: {
        href(){
            return '#' + this.name.toLowerCase().replace(/ /g, '-');
        },
    },

    created(){
        // Event.$on('couponApplied',() => alert('Coupon Applied'));
        Event.$on('couponApplied',() => {
            if (this.isActive){
                this.couponUsed = true;
            }
        });
    },
});

Vue.component('tabs', {
    template: `
    <div>
        <div class="tabs">
            <ul>
                <li v-for="tab in tabs" :class="{'is-active': tab.isActive}">
                    <a :href="tab.href" @click="selectTab(tab)">{{ tab.name }}</a>
                </li>
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
    methods: {
        selectTab(selectedTab){
            // alert('selecting');
            this.tabs.forEach(tab => {
                tab.isActive = (tab.name == selectedTab.name);
            });
        },
    },
});


// Vue.component('modal', {
//     template: `
//         <div class="modal is-active">
//         <div class="modal-background"></div>
//         <div class="modal-content">
//             <div class="box">
//                 <p><slot></slot></p>
//             </div>
//         </div>
//         <button class="modal-close" @click="$emit('close')"></button>
//     </div>
//     `,
//
// });

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
        className: "",
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
