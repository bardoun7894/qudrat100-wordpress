# Deployment and Web Basics

This document explains how web servers, CSS, and JavaScript work together, especially in the context of a local development environment like `http://localhost:8080/` and how that translates to a live server.

### 1. How `http://localhost:8080/` Works

*   **`http://`**: This is the protocol. It stands for Hypertext Transfer Protocol, which is the foundation of data communication for the World Wide Web. It defines how messages are formatted and transmitted, and what actions web servers and browsers should take in response to various commands.
*   **`localhost`**: This is a special hostname that always refers to your own computer. When you type `localhost` into your browser, you're telling it to look for a server running on your machine.
*   **`8080`**: This is the port number. A port is a virtual point where network connections start and end. Think of your computer as an apartment building; `localhost` is the building address, and `8080` is a specific apartment number. Different applications can run on different ports. For web servers, the default HTTP port is `80`, and for HTTPS it's `443`. However, in development, it's common to use other ports like `8080`, `3000`, or `5000` to avoid conflicts with other services or to run multiple development servers simultaneously.

**In essence:** When you access `http://localhost:8080/`, your browser sends a request to a web server application running on your own computer, listening on port `8080`. For a WordPress installation, the web server is typically configured to serve the `index.php` file as the default document for the root directory. This `index.php` file acts as the main entry point for WordPress, which then dynamically loads other template files (like `header.php`, `footer.php`, etc.) to construct the complete webpage. This server then responds by sending the requested files (HTML, CSS, JavaScript, images, etc.) back to your browser, which then renders the webpage.

### 2. How CSS Works

*   **Purpose**: CSS (Cascading Style Sheets) is used to control the presentation and styling of web pages. It dictates how HTML elements are displayed – their colors, fonts, layout, spacing, and more.
*   **Tailwind CSS**: This project utilizes Tailwind CSS, a utility-first CSS framework. Instead of writing custom CSS for every element, Tailwind provides a set of pre-defined utility classes (e.g., `flex`, `pt-4`, `text-center`, `bg-blue-500`) that can be directly applied to HTML elements to style them. This approach allows for rapid UI development and consistent design.
*   **How it's linked**: CSS can be applied to an HTML document in a few ways:
    *   **External Stylesheets (most common and recommended)**: A separate `.css` file is created (e.g., `style.css`), and linked to the HTML using a `<link>` tag in the `<head>` section:
        ```html
        <link rel="stylesheet" href="assets/css/style.css">
        ```
    *   **Internal Stylesheets**: CSS rules are embedded directly within the `<style>` tags in the `<head>` section of an HTML document.
    *   **Inline Styles**: CSS rules are applied directly to individual HTML elements using the `style` attribute.
*   **How browsers interpret it**: When a browser loads an HTML page, it also fetches any linked CSS files. It then applies these styles to the corresponding HTML elements, rendering the page visually according to the defined rules. The "cascading" part means that multiple style sheets can be applied, and rules are applied based on specificity and order.

### 3. How JavaScript Works

*   **Purpose**: JavaScript is a programming language that enables interactive web pages. It allows you to implement complex features on web pages, such as interactive maps, animated graphics, form validations, dynamic content updates, and much more.
*   **How it's linked**: JavaScript can also be linked to an HTML document:
    *   **External Scripts (most common and recommended)**: A separate `.js` file is created (e.g., `quiz.js`), and linked to the HTML using a `<script>` tag. It's often placed just before the closing `</body>` tag for performance reasons, so the HTML content can load first:
        ```html
        <script src="assets/js/quiz.js"></script>
        ```
    *   **Internal Scripts**: JavaScript code is embedded directly within `<script>` tags in the HTML document.
*   **How browsers execute it**: After the browser parses the HTML and applies the CSS, it then executes the JavaScript code. JavaScript can manipulate the HTML (DOM - Document Object Model), change CSS styles, respond to user actions (like clicks or key presses), communicate with servers (e.g., to fetch data without reloading the page), and much more.

### Making a Server "Live" (Deployment)

When you want to make your website accessible to others on the internet, you "deploy" it to a live server. The principles of how `http://`, CSS, and JavaScript work remain the same, but the `localhost` part changes.

Instead of your own computer, the files are hosted on a remote server (like the ones at `qudrat100.com` or `184.174.37.148:8091`). This server has a public IP address and a domain name associated with it. When someone types `qudrat100.com` into their browser, their request goes to that remote server, which then serves the files.

The process of deployment involves:
1.  **Uploading your files**: Copying your HTML, CSS, JavaScript, images, and any server-side code (like PHP files for WordPress) from your local machine to the remote server. This is often done via FTP, SFTP, or automated tools like GitHub Actions (which you have configured).
2.  **Configuring the web server**: Ensuring the remote web server (e.g., Nginx or LiteSpeed in your case) is correctly set up to serve your files and handle requests.
3.  **Database setup**: If your application uses a database (like WordPress does), you'll need to set up the database on the live server and import your data.
4.  **Domain Name System (DNS) configuration**: Pointing your domain name (e.g., `qudrat100.com`) to the IP address of your live server.

In your case, the GitHub Actions workflow you have (`deploy.yml`) is designed to automate step 1 (uploading files) using FTP. When you push changes to the specified branches (`main` or `production`), GitHub Actions will automatically connect to your FTP server and upload the updated files, making them live.