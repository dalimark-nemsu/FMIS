<script setup>
    const props = defineProps({
        boardsTitle:String,
        boardsIcon:String
    });
</script>
<template>
    <div class="col-xxl-4 col-md-6">
        <div class="card info-card">
            <div class="card-body">
                <h5 class="card-title">{{ boardsTitle }}</h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i :class="`bi bi-${boardsIcon}`"></i>
                    </div>
                    <div class="ps-3">
                        <h6>145</h6>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</template>