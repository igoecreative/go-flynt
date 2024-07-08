import 'vite/modulepreload-polyfill'
import FlyntComponent from './scripts/FlyntComponent'

import 'lazysizes'

import { registerIconLibrary } from '@shoelace-style/shoelace/dist/utilities/icon-library.js'

if (import.meta.env.DEV) {
  import('@vite/client')
}

import.meta.glob([
  '../Components/**',
  '../assets/**',
  '!**/*.js',
  '!**/*.scss',
  '!**/*.php',
  '!**/*.twig',
  '!**/screenshot.png',
  '!**/*.md'
])

window.customElements.define(
  'flynt-component',
  FlyntComponent
)

registerIconLibrary('lucide', {
  resolver: name => `https://cdn.jsdelivr.net/npm/lucide-static@0.16.29/icons/${name}.svg`
})

registerIconLibrary('my-icons', {
  resolver: name => `/wp-content/themes/theme/assets/icons/${name}.svg`,
  mutator: svg => svg.setAttribute('fill', 'currentColor')
})
