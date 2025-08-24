# BXCleaner Module for Bitrix

BXCleaner is a custom Bitrix module that helps administrators keep their websites clean by scanning and removing unnecessary files
It provides a simple interface inside the Bitrix admin panel to scan folders and clean up temporary files

---

## Features
- **Website Scan**  
  Scans the `/upload/tmp` directory (recursively) and shows the number of files

- **Clean Up**  
  Automatically removes files from `/upload/tmp`

- **Statistics**  
  Shows website statistics of directory usage

- **Admin Panel Integration**  
  User-friendly interface available inside the Bitrix admin panel

---

## TODO
- **Duplicate Finder**
- **Advanced directory scanner**

## 📂 Installation
1. Copy the module folder to: */bitrix/modules/andreyoss.cleaner*
2. Install the module in the **Bitrix admin panel** under: *Settings → Modules → Install Smart Cleaner*
3. After installation, you can access the module from the **Services** section

---

## ⚙️ Usage
1. Open the **BXCleaner** module in the admin panel
2. Click **"Scan the Website"** to check the `/upload/tmp` folder
3. Use the **"Clean"** button to remove temporary files
4. Also you can see website statistics via **Statistics** page

---

## 📌 Notes
- Be careful when using the **cleaning function** – all files in `/upload/tmp` will be deleted permanently
- Always make backups before mass deletion
- This module is intended for administrators and developers
- Project is WIP, it's very raw version and may contain bugs, so use carefully

---

## 📄 License
This project is released under the **MIT License**
You are free to use, modify, and distribute it

---

## 🤝 Contribution
Pull requests and feature suggestions are welcome!  
If you find a bug or suggest something for the future update, please open an issue

---