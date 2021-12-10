<template>
    <div class="demo-tab">
        Home component<br />
        <span>{{ "monthlyMovement" }}</span>
    </div>
</template>

<script>
export default {
    props: {
        monthlyMovement: Object,
    },
};
</script>
