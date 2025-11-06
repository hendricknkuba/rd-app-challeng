/** @type {import('tailwindcss').Config} */
export default {
  content: ["./index.html", "./src/**/*.{ts,tsx,js,jsx}"],
  theme: {
    extend: {
      spacing: {
        "4.5": "1.125rem" 
      },
    },
  },
  plugins: [],
};
