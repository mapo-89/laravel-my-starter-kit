<script setup lang="ts">
import { computed } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import { loadLanguageAsync } from 'laravel-vue-i18n'
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { ChevronUpDownIcon } from '@heroicons/vue/16/solid'
import { CheckIcon } from '@heroicons/vue/20/solid'

type Language = { key: string; name: string }

const page = usePage()

const languages: Language[] = [
  { key: 'de', name: 'Deutsch' },
  { key: 'en', name: 'English' },
]

const currentLocale = computed(() => (page.props.locale as string) || 'de')

const selected = computed({
  get() {
    return languages.find(l => l.key === currentLocale.value) ?? languages[0]
  },
  async set(lang: Language) {
    if (lang.key === currentLocale.value) return

    router.post(`/locale/${lang.key}`, {}, {
      preserveScroll: true,
      onSuccess: async () => {
        await loadLanguageAsync(lang.key)
      },
    })
  },
})

function flagClass(locale: string) {
  const code = locale === 'en' ? 'gb' : locale
  return `fi-${code}`
}
</script>

<template>
  <Listbox as="div" v-model="selected" class="w-20 sm:w-56">
    <div class="relative">
      <ListboxButton
        class="flex w-full cursor-default items-center justify-end
                rounded-md bg-white py-1.5 px-3
                outline-1 -outline-offset-1 outline-gray-300
                focus-visible:outline-2 focus-visible:-outline-offset-2 focus-visible:outline-indigo-600
                dark:bg-gray-900 dark:outline-gray-700"
        aria-label="Change language"
        >
        <span
            class="fi fis inline-block text-2xl"
            :class="flagClass(selected.key)"
            aria-hidden="true"
            style="transform: scaleX(1.35) scaleY(0.85);"
        />
      </ListboxButton>

      <transition leave-active-class="transition ease-in duration-100" leave-to-class="opacity-0">
        <ListboxOptions
          class="absolute z-10 mt-1 max-h-56 w-52 sm:w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg outline-1 outline-black/5 sm:text-sm
                 dark:bg-gray-900 dark:outline-white/10 dark:ring-1 dark:ring-white/10"
        >
          <ListboxOption
            as="template"
            v-for="lang in languages"
            :key="lang.key"
            :value="lang"
            v-slot="{ active, selected: isSelected }"
          >
            <li
              :class="[
                active
                  ? 'bg-indigo-600 text-white'
                  : 'text-gray-900 dark:text-gray-100',
                'relative cursor-default py-2 pr-9 pl-3 select-none'
              ]"
            >
              <div class="flex items-center">
                <span
                  class="fi fis inline-block mr-2 text-xl"
                  :class="flagClass(lang.key)"
                  aria-hidden="true"
                  style="transform: scaleX(1.25) scaleY(0.75); transform-origin: left center;"
                />
                <span class="block truncate ml-2 tracking-wide">
                  {{ lang.name }}
                </span>
              </div>

              <span
                v-if="isSelected"
                :class="[
                  active ? 'text-white' : 'text-indigo-600 dark:text-indigo-400',
                  'absolute inset-y-0 right-0 flex items-center pr-4'
                ]"
              >
                <CheckIcon class="size-5" aria-hidden="true" />
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>
