/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        softblue: '#505492',
        darkblue: '#1e2b58',
        orange: '#eeb549',
        peachorange: '#ffd37e'
    }
    },
  },
  plugins: [],
}

