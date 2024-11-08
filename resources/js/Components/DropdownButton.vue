<script setup>
const props = defineProps({
    label: {
        type: String,
        default: 'Action',
    },
    color: {
        type: String,
        default: 'btn-primary',
    },
    size: {
        type: String,
        default: '', // Can be 'btn-sm', 'btn-lg', or ''
    },
    split: {
        type: Boolean,
        default: false,
    },
    dropup: {
        type: Boolean,
        default: false,
    },
    dropright: {
        type: Boolean,
        default: false,
    },
    dropleft: {
        type: Boolean,
        default: false,
    },
    menuItems: {
        type: Array,
        default: () => [],
    },
    buttonType: {
        type: String,
        default: 'button',
    },
    role: {
        type: String,
        default: 'group',
    },
    divider: {
        type: Boolean,
        default: false,
    },
    icon: {
        type: String,
        default: '',
    },
});

const colorClass = props.color;
const sizeClass = props.size;

const emit = defineEmits(['itemClick']);

const handleItemClick = (item) => {
  emit('itemClick', item);
};
</script>

<template>
    <!-- Dropdown button container with conditional dropup or dropdown direction -->
    <div :class="['btn-group', { 'dropup': dropup, 'dropend': dropright, 'dropstart': dropleft }]" :role="role">
        <!-- If split is false, render a single button with dropdown toggle -->
        <template v-if="!split">
            <button :class="['btn', colorClass, sizeClass, 'dropdown-toggle']" 
                    :type="buttonType"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                <i v-if="icon" :class="`bi bi-${icon}`"></i>
                {{ label }}
            </button>
            <ul class="dropdown-menu">
                <li v-for="(item, index) in menuItems" :key="index">
                    <component
                        :is="item.isButton ? 'button' : 'a'"
                        class="dropdown-item"
                        :href="!item.isButton ? item.href : null"
                    >
                        {{ item.label }}
                    </component>
                </li>
                <li v-if="divider" class="dropdown-divider"></li>
            </ul>
        </template>

        <!-- If split is true, render two buttons: one for label and one for toggle -->
        <template v-else>
            <button :class="['btn', colorClass, sizeClass]" :type="buttonType">
                <i v-if="icon" :class="`bi bi-${icon}`"></i>
                {{ label }}
            </button>
            <button :class="['btn', colorClass, sizeClass, 'dropdown-toggle', 'dropdown-toggle-split']"
                    :type="buttonType"
                    data-bs-toggle="dropdown"
                    aria-expanded="false">
                <span class="visually-hidden">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <slot/>
                <!-- <li v-for="(item, index) in menuItems" :key="index">
                    <component
                        :is="item.isButton ? 'button' : 'a'"
                        class="dropdown-item"
                        :href="!item.isButton ? item.href : null"
                    >
                        {{ item.label }}
                    </component>
                </li> -->
                <li v-if="divider" class="dropdown-divider"></li>
            </ul>
        </template>
    </div>
</template>

<style scoped>
/* You can add custom styles here if needed */
</style>
