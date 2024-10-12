-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2024 at 11:57 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogx`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_post_realtion`
--

CREATE TABLE `cat_post_realtion` (
  `id` int NOT NULL,
  `cat_id` int NOT NULL,
  `post_id` int NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cat_post_realtion`
--

INSERT INTO `cat_post_realtion` (`id`, `cat_id`, `post_id`, `type`) VALUES
(24, 7, 70, 'posts'),
(25, 7, 71, 'posts'),
(26, 7, 72, 'posts'),
(27, 7, 73, 'posts'),
(29, 9, 74, 'posts'),
(30, 8, 75, 'posts'),
(31, 8, 76, 'posts');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `post_id` int UNSIGNED NOT NULL,
  `comment_text` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL,
  `updated_at` datetime NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `srz_cats`
--

CREATE TABLE `srz_cats` (
  `ID` int NOT NULL,
  `type` varchar(255) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `value` varchar(255) DEFAULT '',
  `parent` varchar(255) DEFAULT '',
  `obj_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srz_cats`
--

INSERT INTO `srz_cats` (`ID`, `type`, `name`, `value`, `parent`, `obj_id`) VALUES
(7, 'movies', 'Web Development', 'hot', '0', NULL),
(8, 'movies', ' Laravel & PHP', 'srz', '0', NULL),
(9, 'movies', 'Web Design', 'rasel', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `srz_cpt`
--

CREATE TABLE `srz_cpt` (
  `ID` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `title` varchar(300) DEFAULT '',
  `post_type` varchar(300) DEFAULT '',
  `slug` varchar(400) DEFAULT '',
  `description` longtext,
  `status` int DEFAULT NULL,
  `parent_id` int DEFAULT '0',
  `thumb_id` int DEFAULT NULL,
  `pub_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mod_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srz_cpt`
--

INSERT INTO `srz_cpt` (`ID`, `user_id`, `title`, `post_type`, `slug`, `description`, `status`, `parent_id`, `thumb_id`, `pub_date`, `mod_date`) VALUES
(70, NULL, 'Exploring the Benefits of Progressive Web Apps (PWAs): A New Era of Web Development', 'posts', 'exploring-the-benefits-of-progressive-web-apps-pwas-a-new-era-of-web-development', '<p>Progressive Web Apps (PWAs) represent a transformative shift in web development, blending the best features of both web and mobile applications. By leveraging modern web technologies, PWAs offer a more engaging, reliable, and performant experience, bridging the gap between traditional web apps and native mobile applications. One of the most compelling benefits of PWAs is their ability to provide an app-like experience directly from a web browser. PWAs are designed to function seamlessly across various devices and platforms, delivering a consistent and responsive user experience. Unlike standard web apps, PWAs offer features such as offline access, push notifications, and background synchronization, which enhance usability and engagement. Offline capabilities are a standout feature of PWAs. By utilizing service workers, a core technology in PWAs, developers can cache essential resources and enable users to interact with the app even when they are not connected to the internet. This functionality not only improves accessibility but also ensures that users have a reliable experience, regardless of their network conditions. Push notifications are another powerful aspect of PWAs. They allow businesses to send timely and relevant updates directly to users, even when the app is not in use. This can drive re-engagement, increase user retention, and provide a more personalized experience. Implementing push notifications requires careful consideration of user preferences and privacy, but when done right, it can significantly enhance the value of your app. Performance is a key consideration in PWAs, and they are designed to deliver fast, reliable, and smooth interactions. PWAs use techniques like lazy loading, efficient caching strategies, and optimized resource delivery to ensure quick load times and minimal latency. This focus on performance not only improves user satisfaction but also contributes to better search engine rankings, as speed is a crucial factor for SEO. Another advantage of PWAs is their discoverability and ease of installation. Users can access PWAs through a simple URL, and they can be added to the home screen with just a few clicks, eliminating the need for app store installations. This process streamlines user onboarding and reduces friction, making it easier for users to start engaging with your app. From a development perspective, PWAs offer significant benefits in terms of cost and maintenance. Building a PWA typically involves using a single codebase that works across multiple platforms, reducing the need for separate development efforts for web and mobile apps. This unified approach can lead to cost savings and a more efficient development process.</p>', 1, 0, NULL, '2024-10-12 07:56:36', '2024-10-12 11:56:36'),
(71, NULL, 'Behind the Code: My Journey as a Web Developer', 'posts', 'behind-the-code-my-journey-as-a-web-developer', '<p>As a web developer, my journey has been a blend of curiosity, learning, and a passion for creating. From the moment I wrote my first line of code to the projects I work on today, the path has been filled with challenges, triumphs, and continuous growth. In this post, I want to take you behind the scenes of my journey—how I got started, the skills I’ve honed, and what drives me to keep pushing the boundaries of web development. The Beginning: A Spark of Curiosity My journey into web development began with a simple curiosity: How do websites work? Like many, I started by tinkering with HTML and CSS, experimenting with basic web pages and seeing how changes in the code reflected on the screen. The ability to create something out of nothing, to bring ideas to life on the web, fascinated me. It was this fascination that led me to dive deeper into the world of web development. Learning and Growing: Building My Skillset As I continued to explore, I realized that web development was a vast field, with countless languages, frameworks, and tools to master. I began learning JavaScript, which opened up a new world of possibilities for making websites interactive. This led me to explore backend development with PHP, where I learned how to manage databases and create dynamic content.One of the turning points in my career was discovering Laravel. This PHP framework not only streamlined my development process but also taught me the importance of clean, maintainable code. Laravel’s elegant syntax and powerful tools enabled me to build complex applications more efficiently, and it quickly became my go-to framework for most projects.</p>', 1, 0, NULL, '2024-10-12 07:00:36', '2024-10-12 11:00:36'),
(72, NULL, 'Mastering JavaScript: Tips and Techniques for Modern Development', 'posts', 'mastering-javascript-tips-and-techniques-for-modern-development', '<p>JavaScript is a powerful language that lies at the heart of modern web development. From enhancing user interfaces to creating complex web applications, JavaScript’s versatility makes it an essential skill for any developer. In this blog post, I’ll share some key tips and techniques that have helped me master JavaScript and improve my development workflow. JavaScript is known for its asynchronous capabilities, and understanding how to work with asynchronous code is crucial. The async and await keywords provide a cleaner, more readable way to handle asynchronous operations compared to traditional callbacks and promises. By using async functions, you can write asynchronous code that looks and behaves like synchronous code, making it easier to manage and debug. This approach helps prevent issues like callback hell and improves code maintainability. Another powerful feature of JavaScript is its ability to handle events. The event-driven model allows developers to create interactive web applications by responding to user actions such as clicks, form submissions, and keyboard inputs. Using event listeners effectively can help create a seamless user experience. It’s important to understand event delegation, which involves attaching a single event listener to a parent element instead of multiple listeners to individual child elements. This technique can improve performance and simplify event management. JavaScript’s prototype-based inheritance is a fundamental concept that can be leveraged to create reusable and modular code. Understanding prototypes allows you to create custom objects and extend built-in objects with additional methods and properties. This approach is particularly useful for building libraries and frameworks. By mastering prototypes, you can design more efficient and scalable applications.</p>', 1, 0, NULL, '2024-10-12 07:01:33', '2024-10-12 11:01:33'),
(73, NULL, 'The Art of Crafting User-Friendly Forms: Best Practices and Design Tips', 'posts', 'the-art-of-crafting-user-friendly-forms-best-practices-and-design-tips', '<p>User-friendly forms are crucial for any website that collects information, whether it\'s for sign-ups, surveys, or transactions. Well-designed forms can significantly enhance user experience, reduce abandonment rates, and increase conversions. Crafting effective forms involves more than just aesthetics; it requires a blend of thoughtful design, clear instructions, and user-centric functionality. Start with simplicity. Users appreciate forms that are straightforward and easy to navigate. Avoid overwhelming them with too many fields by only asking for essential information. A concise form not only speeds up the completion process but also reduces the chances of users abandoning it halfway through. For more complex forms, consider breaking them into multiple steps or sections with a progress indicator to help users understand their progress and what’s left to complete. Field labels and instructions play a pivotal role in guiding users through the form. Use clear and descriptive labels for each field to avoid confusion. If necessary, provide additional guidance with inline help text or tooltips that offer explanations or examples. Make sure that error messages are specific and actionable, helping users understand what went wrong and how to correct it.</p>', 1, 0, NULL, '2024-10-12 07:56:43', '2024-10-12 11:56:43'),
(74, NULL, 'Essential Techniques for Faster Websites', 'posts', 'essential-techniques-for-faster-websites', '<p>In today\'s digital landscape, where users demand instantaneous responses, optimizing front-end performance has never been more crucial. A fast-loading website not only improves user experience but also enhances search engine rankings and reduces bounce rates. To achieve peak performance, several key techniques can be employed to ensure that your site delivers content quickly and efficiently. One fundamental technique is optimizing assets, which involves compressing images, minifying CSS and JavaScript files, and leveraging browser caching. Large image files can significantly slow down your site, so using formats like WebP for web images and employing tools like ImageOptim or TinyPNG can help reduce file sizes without sacrificing quality. Similarly, minifying your CSS and JavaScript files—removing unnecessary whitespace, comments, and unused code—can decrease load times. Browser caching allows returning visitors to load your site faster by storing static resources locally, reducing the need for repeated server requests.</p><p><br></p>', 1, 0, NULL, '2024-10-12 07:09:30', '2024-10-12 11:09:30'),
(75, NULL, ' Why It\'s My Go-To Framework for PHP Development', 'posts', 'why-its-my-go-to-framework-for-php-development', '<p>As a web developer, I’ve had the opportunity to work with various tools and frameworks, but when it comes to PHP development, Laravel stands out as my framework of choice. In this post, I’ll share why Laravel is my go-to framework, how it enhances my development process, and some tips for getting the most out of it. Why Laravel? Laravel is a powerful, open-source PHP framework that has gained immense popularity for its elegant syntax, extensive features, and strong community support. Here are some reasons why I prefer Laravel over other frameworks: Clean and Elegant Syntax:&nbsp;Laravel’s syntax is intuitive and expressive, which makes coding more enjoyable. The framework is designed to be developer-friendly, reducing the complexity of common tasks like routing, authentication, and caching.MVC Architecture:&nbsp;Laravel follows the Model-View-Controller (MVC) architectural pattern, which helps in organizing code and separating business logic from presentation. This not only makes the code more maintainable but also enhances scalability.Built-In Authentication and Authorization:&nbsp;One of the standout features of Laravel is its built-in authentication system. Setting up user login, registration, and password recovery is straightforward and secure. Laravel also provides robust authorization capabilities to control access to different parts of an application.Eloquent ORM:&nbsp;Laravel’s Eloquent ORM simplifies database interactions by allowing developers to work with databases using PHP syntax rather than writing raw SQL queries. This makes data handling more intuitive and integrates seamlessly with Laravel’s overall structure.Comprehensive Documentation and Community Support:&nbsp;Laravel’s documentation is extensive and well-organized, making it easier to find solutions to any challenges. Additionally, the Laravel community is vibrant and active, offering a wealth of resources, packages, and forums to help developers of all levels.My Development Workflow with Laravel Here’s a glimpse into how I approach a project using Laravel, from setup to deployment. Initial Setup:&nbsp;I start by installing Laravel using Composer, followed by setting up the environment configuration.Laravel’s Homestead or Valet are great tools for local development, providing a clean, consistent development environment.Database Design and Eloquent Models:&nbsp;I design the database schema based on the project requirements, using Laravel migrations to manage database changes.Eloquent models are then created to represent each table, making it easy to interact with the database using simple, readable code.Routing and Controllers:&nbsp;Laravel’s routing is straightforward, allowing me to define routes in a clean, readable way.Controllers are used to handle requests, where I place the business logic. Laravel’s resource controllers are particularly useful for handling CRUD operations efficiently.Building the User Interface:&nbsp;I use Blade, Laravel’s templating engine, to build dynamic, reusable templates. Blade’s directives simplify tasks like looping through data, displaying conditional content, and including partial views.For front-end development, I often integrate Laravel with modern tools like Vue.js or React, taking advantage of Laravel Mix for asset compilation.Testing and Debugging:&nbsp;Laravel provides robust testing tools, including PHPUnit for unit tests and Laravel Dusk for browser testing. I make it a point to write tests for critical parts of the application to ensure everything functions as expected.Debugging is made easier with Laravel’s built-in error handling and the use of packages like Laravel Debugbar.Deployment and Maintenance:&nbsp;Once the application is ready, I deploy it using services like Forge, which automates the deployment process and provides server management.Post-deployment, I offer ongoing support, including regular updates and monitoring to keep the application secure and running smoothly.Tips for Mastering Laravel</p>', 1, 0, NULL, '2024-10-12 07:56:50', '2024-10-12 11:56:50'),
(76, NULL, 'Crafting Custom Websites with Laravel and PHP', 'posts', 'crafting-custom-websites-with-laravel-and-php', '<p>In the ever-evolving landscape of web development, crafting a custom website that not only looks good but also functions seamlessly is both an art and a science. Over the years, I’ve honed my skills in turning creative concepts into fully functional websites using Laravel and PHP. In this post, I’ll walk you through my process, from initial ideas to the final product. Understanding the Client\'s Vision Every project begins with understanding the client’s vision. This involves deep discussions to capture their ideas, goals, and expectations. I ask questions about their target audience, preferred aesthetics, and specific functionalities they need. This helps me create a clear roadmap for the project, ensuring that the end product aligns perfectly with their vision. Wireframing and Design Once I have a solid understanding of the client’s needs, the next step is wireframing. I create simple, skeletal outlines of the website’s structure. This is a crucial phase where I determine the layout, navigation flow, and placement of key elements. The wireframe acts as a blueprint, giving both the client and me a visual representation of the site before diving into the actual coding.After the wireframe is approved, I move on to the design phase. Here, I focus on creating a visually appealing interface that resonates with the client’s brand. Using tools like Adobe XD or Figma, I design each page, ensuring consistency in color schemes, typography, and overall style. Bringing Designs to Life with Laravel and PHP With the design in place, it’s time to bring the website to life. I rely heavily on Laravel, a PHP framework that simplifies complex tasks, enhances security, and provides a clean, elegant syntax. Here’s how I approach the development process:</p>', 1, 0, NULL, '2024-10-12 07:16:25', '2024-10-12 11:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `srz_fields`
--

CREATE TABLE `srz_fields` (
  `ID` int NOT NULL,
  `type` varchar(255) DEFAULT '',
  `name` varchar(255) DEFAULT '',
  `value` longtext,
  `obj_id` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srz_fields`
--

INSERT INTO `srz_fields` (`ID`, `type`, `name`, `value`, `obj_id`) VALUES
(213, 'posts', 'color', '#000000', 73),
(212, 'posts', 'img', 'https://miro.medium.com/v2/resize:fit:720/0*IaYWGdQNvtCrpRy1.jpg', 73),
(187, 'movies_cat', 'description', '<p><br></p>', 7),
(211, 'posts', 'color', '#000000', 72),
(210, 'posts', 'img', 'https://miro.medium.com/v2/resize:fit:1200/1*gUfx_CcaIzNDNOR8630UeA.png', 72),
(206, 'posts', 'color', '#000000', 70),
(207, 'posts', 'views', '1', 70),
(208, 'posts', 'img', 'https://miro.medium.com/v2/resize:fit:753/0*IPpT08A6JbMvVqWI.jpg', 71),
(209, 'posts', 'color', '#000000', 71),
(205, 'posts', 'img', 'https://www.iihglobal.com/wp-content/uploads/2023/07/progressive-web-apps-shaping-the-future-of-mobile-app-development.jpg', 70),
(214, 'posts', 'views', '65', 73),
(203, 'movies_cat', 'description', '<p><br></p><p><br></p>', 8),
(204, 'movies_cat', 'description', '<p><br></p>', 9),
(215, 'posts', 'views', '1', 71),
(216, 'posts', 'featured', '1', 73),
(217, 'posts', 'img', 'https://media.licdn.com/dms/image/D5612AQGVjRgbFvmR5g/article-cover_image-shrink_720_1280/0/1717145880014?e=2147483647&v=beta&t=twOGAZ6SCc0U9iJwAqkWH1JWkav3M_qllxUVguAzd3Y', 74),
(218, 'posts', 'color', '#000000', 74),
(219, 'posts', 'featured', '0', 74),
(220, 'posts', 'img', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT3W-PEXxf9LC4OqgNFKyCI-KyZ8J0oNiN_XA&s', 75),
(221, 'posts', 'color', '#000000', 75),
(222, 'posts', 'img', '/assets/uploads/ddc8a9e7e28167a4b2771128acead162d0b3a9799e33d1c5c889c61efe863b58.jpeg', 76),
(224, 'posts', 'featured', '0', 76),
(223, 'posts', 'color', '#000000', 76),
(225, 'posts', 'views', '5', 76),
(226, 'posts', 'featured', '1', 70),
(227, 'posts', 'featured', '1', 75);

-- --------------------------------------------------------

--
-- Table structure for table `srz_options`
--

CREATE TABLE `srz_options` (
  `ID` int NOT NULL,
  `name` varchar(255) DEFAULT '',
  `value` longtext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `srz_options`
--

INSERT INTO `srz_options` (`ID`, `name`, `value`) VALUES
(1, 'sitename', 'Rasel.com'),
(2, 'siteTitle', 'MySite'),
(3, 'siteDescription', 'This is is for bla bla bla'),
(4, 'siteEmail', 'admin@gmail.com'),
(5, 'sitePhone', '017000000000'),
(6, 'siteLogo', '/assets/uploads/site/b7e68a2122f61dea8f88127b6bddd533fac43591a365ab22399f879917976197.png'),
(9, 'description', 'Sohag.Com'),
(10, 'keywords', 'Rasel.com'),
(11, 'logo', '/assets/uploads/aca0228ee3a0a32eb8e59e3fa9762ee1e79bfef6effafef2bded054c25645f45.png'),
(12, 'favicon', ''),
(13, 'email', 'Rasel@gmail.com'),
(14, 'facebook', 'https://facebook.com/raselsrz73'),
(15, 'telegram', 'https://facebook.com/sohagsrz'),
(16, 'header_codes', ' '),
(17, 'footer_codes', ' '),
(18, 'siteurl', ''),
(19, 'posts_per_page', '10'),
(20, 'instagram', 'https://Instagram.com/raselsrz'),
(21, 'twitter', 'https://x.com/raselsrz'),
(22, 'youtube', ''),
(23, 'phone', '45124578'),
(24, 'about_video', 'Q3TI27IN7X0'),
(25, 'pinterest', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refer_by` int NOT NULL,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `verified` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `resettable` tinyint UNSIGNED NOT NULL DEFAULT '1',
  `roles_mask` int UNSIGNED NOT NULL DEFAULT '0',
  `registered` int UNSIGNED NOT NULL,
  `last_login` int UNSIGNED DEFAULT NULL,
  `force_logout` mediumint UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `username`, `refer_by`, `status`, `verified`, `resettable`, `roles_mask`, `registered`, `last_login`, `force_logout`) VALUES
(12, 'rasel@gmail.com', '$2y$10$rY.jymV1v52vuZgkipKGPOhJ1k2BjlBcZBdcaO96dB/HudOhptymO', '54', 0, 0, 1, 1, 0, 1708446919, 1728733968, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_confirmations`
--

CREATE TABLE `users_confirmations` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `email` varchar(249) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_remembered`
--

CREATE TABLE `users_remembered` (
  `id` bigint UNSIGNED NOT NULL,
  `user` int UNSIGNED NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_remembered`
--

INSERT INTO `users_remembered` (`id`, `user`, `selector`, `token`, `expires`) VALUES
(2, 12, 's8gwlw9Kq7E_Evm122S2Vu1V', '$2y$10$s.KfZwbr.CwjaRsafvl/x.gblgvHATbYXknQMRNiBBnErJ3mzHFte', 1710866357),
(3, 12, 'CV6fE4RnQx1tUPQsIhxmjtqj', '$2y$10$lWVIkv/4wJ9TvNIK/V9KXum1bxZKHS5Kdps/qJTkrqzQmGhvuGM7G', 1711361541),
(4, 12, 'fp6GK0Y3o0g5arSCNLPpkLcd', '$2y$10$uzZ7adx/E2t38Hm6fkfeRuApGNFBkzFg3fbXuxbW4HOf/JoQNtJo.', 1729040267);

-- --------------------------------------------------------

--
-- Table structure for table `users_resets`
--

CREATE TABLE `users_resets` (
  `id` bigint UNSIGNED NOT NULL,
  `user` int UNSIGNED NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users_throttling`
--

CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float UNSIGNED NOT NULL,
  `replenished_at` int UNSIGNED NOT NULL,
  `expires_at` int UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_throttling`
--

INSERT INTO `users_throttling` (`bucket`, `tokens`, `replenished_at`, `expires_at`) VALUES
('PZ3qJtO_NLbJfRIP-8b4ME4WA3xxc6n9nbCORSffyQ0', 4, 1708446920, 1708878920),
('3FiTiwuHwwoEGH8W_0qWiqN70MzK66X0zBM4il_uxmk', 29, 1708446920, 1708518920),
('_htIBEtjvcjT047KNYB1SMFhJiDwE47_RMjWpSeVEhw', 29, 1708446920, 1708518920),
('HIJQJPUQ2qyyTt0Q7_AuZA0pXm27czJnqpJsoA5IFec', 49, 1708446919, 1708518919),
('QduM75nGblH2CDKFyk0QeukPOwuEVDAUFE54ITnHM38', 74, 1708942341, 1709482341),
('ejWtPDKvxt-q7LZ3mFjzUoIWKJYzu47igC8Jd9mffFk', 73.0364, 1728733968, 1729273968),
('Jjl8HEbTSJpZBWoyXOajJXqciuUdngUbah061jwhliE', 19, 1728733837, 1728769837),
('37ZDPnKLBvvkwrkQBKHowxfV2Z66VvtU0zzCjC_fj00', 499, 1728733837, 1728906637);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat_post_realtion`
--
ALTER TABLE `cat_post_realtion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `srz_cats`
--
ALTER TABLE `srz_cats`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `srz_cpt`
--
ALTER TABLE `srz_cpt`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `srz_fields`
--
ALTER TABLE `srz_fields`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `srz_options`
--
ALTER TABLE `srz_options`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_confirmations`
--
ALTER TABLE `users_confirmations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `email_expires` (`email`,`expires`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_remembered`
--
ALTER TABLE `users_remembered`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `users_resets`
--
ALTER TABLE `users_resets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `selector` (`selector`),
  ADD KEY `user_expires` (`user`,`expires`);

--
-- Indexes for table `users_throttling`
--
ALTER TABLE `users_throttling`
  ADD PRIMARY KEY (`bucket`),
  ADD KEY `expires_at` (`expires_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat_post_realtion`
--
ALTER TABLE `cat_post_realtion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `srz_cats`
--
ALTER TABLE `srz_cats`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `srz_cpt`
--
ALTER TABLE `srz_cpt`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `srz_fields`
--
ALTER TABLE `srz_fields`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `srz_options`
--
ALTER TABLE `srz_options`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_confirmations`
--
ALTER TABLE `users_confirmations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users_remembered`
--
ALTER TABLE `users_remembered`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users_resets`
--
ALTER TABLE `users_resets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
