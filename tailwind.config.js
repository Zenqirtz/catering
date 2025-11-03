/** @type {import('tailwindcss').Config} */
// tailwind.config.js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      keyframes: {
        // Animasi fade-in kustom
        fadeInDown: {
          'from': { opacity: 0, transform: 'translateY(-20px)' },
          'to': { opacity: 1, transform: 'translateY(0)' },
        },
        fadeInUp: {
          'from': { opacity: 0, transform: 'translateY(20px)' },
          'to': { opacity: 1, transform: 'translateY(0)' },
        },
        fadeInRight: {
          'from': { opacity: 0, transform: 'translateX(-20px)' },
          'to': { opacity: 1, transform: 'translateX(0)' },
        },
        fadeInLeft: {
          'from': { opacity: 0, transform: 'translateX(20px)' },
          'to': { opacity: 1, transform: 'translateX(0)' },
        },
        fadeIn: {
          'from': { opacity: 0 },
          'to': { opacity: 1 },
        },
        // Animasi pulse-glow yang sudah ada
        'pulse-glow': {
          '0%, 100%': { opacity: '0.3', transform: 'scale(1)' },
          '50%': { opacity: '0.6', transform: 'scale(1.05)' },
        },
      },
      animation: {
        // Daftarkan animasi kustom agar bisa digunakan sebagai utility class
        'fade-in-down': 'fadeInDown 0.8s ease-out forwards',
        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
        'fade-in-right': 'fadeInRight 0.6s ease-out forwards',
        'fade-in-left': 'fadeInLeft 0.6s ease-out forwards',
        'fade-in': 'fadeIn 0.6s ease-out forwards',
        'pulse-glow': 'pulse-glow 4s ease-in-out infinite', // Untuk menggantikan animate-pulse bawaan jika ingin pakai yang kustom
      },
    },
  },
  plugins: [],
}
