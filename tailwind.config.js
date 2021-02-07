module.exports = {
  theme: {
    backgroundColor: () => ({
      dark: 'rgba(36,36,35,1)',
      lighter: 'rgba(207, 219, 213, 1)',
      grey: 'rgba(51, 53, 51, 1)',
    }),
    extend: {
      height: {
        '90c': '90%',
      },
      colors: {
        'sublime-yellow': '#FEDA6A',
      }
    },
  },
  fontFamily: {
    display: ['Roboto Mono', 'sans-serif'],
    body: ['Roboto Mono', 'sans-serif'],
  },
}
