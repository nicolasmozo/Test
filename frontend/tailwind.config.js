/** @type {import('tailwindcss').Config} */
// opacity manage handler
function withOpacity(variableName) {
  return ({ opacityValue }) => {
    if (opacityValue !== undefined) {
      return `rgba(var(${variableName}), ${opacityValue})`;
    } else {
      return `rgb(var(${variableName}))`;
    }
  };
}

module.exports = {
  content: [
    "./pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./components/**/*.{js,ts,jsx,tsx,mdx}",
    "./app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          black: "rgb(var(--primary-foreground))",
          gray: "#616161",
          blue: withOpacity("--primary-background"), //replace with this #0E6DE8
          yellow: withOpacity("--primary-background"), //replace with this #FFB321
          border: "#1a1a1a",
          "border-secondary": "#D1E5FF",
        },
      },
    },
  },
  plugins: [],
};
