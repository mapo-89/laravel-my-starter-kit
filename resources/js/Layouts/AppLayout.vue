<script setup>
import { computed } from 'vue'
import { Head, usePage } from '@inertiajs/vue3'
import Banner from '@/Components/Banner.vue'
import ApplicationSidebar from '@/Components/ApplicationSidebar.vue'
import ApplicationHeader from '@/Components/ApplicationHeader.vue'
import { SidebarProvider, SidebarInset } from '@/Components/ui/sidebar'

defineProps({
    title: String,
    sidebar: { type: Boolean, default: false },
})

const page = usePage()

const sidebarEnabled = computed(() => {
  if (page.props.sidebarEnabled !== undefined) return !!page.props.sidebarEnabled
  return false
})
</script>

<template>
  <SidebarProvider v-if="sidebarEnabled" storage-key="app-sidebar" class="flex min-h-screen">
    <ApplicationSidebar />

    <SidebarInset class="flex-1 min-w-0">
      <Head :title="title" />
      <Banner />

      <ApplicationHeader />

      <header v-if="$slots.header" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
        <div class="max-w mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <main class="bg-gray-100 dark:bg-gray-900 min-h-[calc(100vh-4rem)] p-4">
        <slot />
      </main>
    </SidebarInset>
  </SidebarProvider>
  <div v-else class="min-h-screen">
    <Head :title="title" />
    <Banner />

    <ApplicationHeader :sidebar-enabled="false" />

    <header v-if="$slots.header" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
      <div class="max-w mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <slot name="header" />
      </div>
    </header>

    <main class="bg-gray-100 dark:bg-gray-900 min-h-[calc(100vh-4rem)] p-4">
      <slot />
    </main>
  </div>
</template>
