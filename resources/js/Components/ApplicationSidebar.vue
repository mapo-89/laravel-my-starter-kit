<script setup>
import { Link } from '@inertiajs/vue3'
import { LayoutDashboard, LucideHome, Settings } from 'lucide-vue-next'
import {
  Sidebar, SidebarContent,
  SidebarGroup, SidebarGroupLabel, SidebarGroupContent,
  SidebarMenu, SidebarMenuItem, SidebarMenuButton,
} from '@/Components/ui/sidebar'

const items = [
  { title: 'Dashboard', href: route('dashboard'), icon: LayoutDashboard },
  { title: 'Home', href: route('dashboard'), icon: LucideHome },
  { title: 'Settings', href: route('profile.show'), icon: Settings },
]
</script>

<template>
  <Sidebar>
    <SidebarContent>
      <SidebarGroup>
        <SidebarGroupLabel>App</SidebarGroupLabel>
        <SidebarGroupContent>
          <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
              <SidebarMenuButton as-child>
                <Link :href="item.href">
                  <component :is="item.icon" class="mr-2 h-4 w-4" />
                  <span>{{ item.title }}</span>
                </Link>
              </SidebarMenuButton>
            </SidebarMenuItem>
          </SidebarMenu>
        </SidebarGroupContent>
      </SidebarGroup>
    </SidebarContent>
  </Sidebar>
</template>
