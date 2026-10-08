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
      colors: {
        // FourYourCatering editorial palette
        cream: '#FBF5EA',
        'cream-deep': '#F4EAD9',
        ink: '#191919',
        olive: '#454B21',
        accent: '#E8552B',
        mustard: '#E9B92B',
        muted: '#6C6357',
      },
      fontFamily: {
        display: ['Archivo', 'sans-serif'],
        serif: ['Fraunces', 'serif'],
        sans: ['Inter', 'sans-serif'],
      },
      keyframes: {
        fadeInDown: {
          'from': { opacity: 0, transform: 'translateY(-16px)' },
          'to': { opacity: 1, transform: 'translateY(0)' },
        },
        fadeInUp: {
          'from': { opacity: 0, transform: 'translateY(16px)' },
          'to': { opacity: 1, transform: 'translateY(0)' },
        },
        fadeIn: {
          'from': { opacity: 0 },
          'to': { opacity: 1 },
        },
        'spin-slow': {
          'from': { transform: 'rotate(0deg)' },
          'to': { transform: 'rotate(360deg)' },
        },
      },
      animation: {
        'fade-in-down': 'fadeInDown 0.7s ease-out forwards',
        'fade-in-up': 'fadeInUp 0.7s ease-out forwards',
        'fade-in': 'fadeIn 0.7s ease-out forwards',
        'spin-slow': 'spin-slow 22s linear infinite',
      },
    },
  },
  plugins: [],
}
