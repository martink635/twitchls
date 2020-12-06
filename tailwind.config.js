const colors = require('tailwindcss/colors')

module.exports = {
  purge: ['resources/views/**/*.blade.php'],
  darkMode: 'media', // or 'media' or 'class'
  theme: {
    colors: {

      black: '#242D2E',
      white: '#FFFFFF',
      transparent: 'transparent',

      red: {
          '500': '#E53E3E'
      },

      gray: {
        '100': '#DFE7E8',
        '500': '#839C9E',
        '900': '#1A1E1F'
      },

      teal: {
          '100': "#E6FFFA",
          '200': '#B2F5EA',
          '500': '#38B2AC',
          '900': '#234E52'
      }
    },
    extend: {
        fontFamily: {
            sans: [
                'Poppins',
                'system-ui',
                '-apple-system',
                'BlinkMacSystemFont',
                '"Segoe UI"',
                'Roboto',
                'sans-serif',
                '"Apple Color Emoji"',
                '"Segoe UI Emoji"',
                '"Segoe UI Symbol"',
                '"Noto Color Emoji"'
            ],
        },
        spacing: {
            '2px': '2px',
        },
        cursor: {
            'col-resize': 'col-resize'
        },
    },
  },
  variants: {
    extend: {
        backgroundColor: ['responsive', 'hover', 'focus', 'group-hover'],
        ringWidth: ['hover'],
        textColor: ['responsive', 'hover', 'focus', 'group-hover'],
        width: ['responsive', 'group-hover'],
    },
  },
  plugins: [],
}
