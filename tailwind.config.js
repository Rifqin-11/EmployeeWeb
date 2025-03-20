module.exports = {
  content: [
    './app/Views/**/*.php',   // Sesuaikan dengan path view CodeIgniter Anda
    './node_modules/flowbite/**/*.js', // Tambahkan flowbite
  ],
  theme: {
    extend: {
      colors: {
        primary: '#084E8F',
        secondary: '#f9f9f9',
        button: '#2563eb',
        'text-100': '#7E7E7E',
        'text-200': '#414141',
        'text-600': '#364153',
        'yellow-700': '#F9A329',
        'yellow-200': '#fff0dc',
      },
    },
  },
  plugins: [
    require('flowbite/plugin') // Tambahkan flowbite plugin di sini
  ],
}