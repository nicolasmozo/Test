# Axtro Laravel Nextjs

This is Multi-vendor Ecommerce project. Sell Gaming product in this site. User can easily register as a seller and sell his product and also user can buy product this site.

## Table of Contents

- [Getting Started](#developer-guide)
- [Folder Structure](#must-know-some-important-folder-structure)
- [Usage](#usage)
- [Technologies Used](#technologies-used)
- [License](#license)
- [Acknowledgements](#acknowledgements)

## Developer Guide

First, run the development server:

```bash
npm install
npm run dev
# or
yarn
yarn dev
# or
pnpm dev
# or
bun dev
```

Open [http://localhost:3000](http://localhost:3000) with your browser to see the result.

You can start editing the page by modifying `app/page.js`. The page auto-updates as you edit the file.

## 📌 Must Know Some Important Folder Structure

- <b>Root/app</b> => Add all pages in this folder using page.js.
- <b>Root/components</b> => Add all components in this Folder.
- <b>Root/components/Containers</b> => When you need client Component pages then create here and call it page.js file. Please do not use 'use client' flag in page.js file.
- <b>Root/components/Context</b> => When you need context then create here.
- <b>Root/components/Helper</b> => Add common components here.
- <b>Root/Sections</b> => Add page section component here and when need then call it into page.js
- <b>Root/Ui</b> => Add Default Ui like Error,Success,Warning,Confirmation Modal,Loading etc.
- <b>Root/store</b> => Add store related functionality
- <b>Root/utilities</b> => Add custom helper js function
- <b>Root/components/Partials</b> => Partials contained website page header, footer, Layouts

<b>Note:</b> If you need more folder and file in components folder then you can create. It's just an initial Structure

## Technologies Used

- React v18
- NextJS v12
- TailwindCSS v3.4.0
- Reduxjs/toolkit

## License

No License at this moment

## Acknowledgements

- [ReactJS](https://react.dev/)
- [NextJS](https://nextjs.org/)
- [Reduxjs/toolkit](https://redux-toolkit.js.org/)
- [TailwindCSS](https://tailwindcss.com/)
