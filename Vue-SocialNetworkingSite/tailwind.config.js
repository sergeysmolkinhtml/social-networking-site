/* eslint-env node */
/** @type {import('tailwindcss').Config} */

const colors = require("tailwindcss/colors");

export default module.exports = {
  content: [
      './pages/**/*.{js,ts,jsx,tsx}',
      './components/**/*.{js,ts,jsx,tsx}',
      './app/**/*.{js,ts,jsx,tsx}',
      "./src/**/*.{vue,js}"
  ],
  theme: {
    extend: colors
  },

  plugins: [],
}

