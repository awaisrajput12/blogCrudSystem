-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2025 at 03:11 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pro1`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `featured` tinyint(1) DEFAULT '0',
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author_id` int DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `category` varchar(100) NOT NULL,
  `is_approved` tinyint(1) DEFAULT '0',
  `likes` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `author`, `content`, `featured`, `image_path`, `created_at`, `updated_at`, `author_id`, `approval_status`, `category`, `is_approved`, `likes`) VALUES
(10, 'ProReach Digital Marketing', 'Awais Rajppot', 'ProReach Digital Marketing is a premier digital marketing agency built to empower professionals in today’s fast-paced digital world. With a deep understanding of industry trends and the unique challenges professionals face, we provide innovative and results-driven strategies tailored specifically to elevate your online presence and grow your business.\r\n\r\nOur mission is to bridge the gap between professionals and their target audience, helping them unlock new opportunities and achieve sustainable growth. Whether you’re a small business owner, a consultant, or an established corporate entity, ProReach offers a full suite of customized services designed to propel your brand forward in the digital space.\r\n\r\nOur Core Services:\r\nSearch Engine Optimization (SEO):\r\nRank higher on search engines like Google and Bing. We employ a combination of on-page and off-page SEO strategies, including keyword research, content optimization, technical audits, and link building, ensuring that your website attracts organic traffic and converts visitors into customers.\r\n\r\nSocial Media Marketing & Management:\r\nSocial media is where connections happen, and we help you make the most of it. Our team develops personalized social media strategies tailored to your audience, driving engagement through organic and paid campaigns. We manage and optimize your presence across major platforms like LinkedIn, Facebook, Instagram, and Twitter, ensuring that your brand message resonates with the right audience.\r\n\r\nPaid Advertising (PPC & Display Ads):\r\nMaximize the reach and impact of your campaigns with pay-per-click (PPC) advertising. We create and manage targeted ads on Google, LinkedIn, and social media channels that deliver instant visibility and measurable results. Our data-driven approach ensures that your advertising budget is spent efficiently, delivering high-quality leads and high conversion rates.\r\n\r\nContent Marketing & Strategy:\r\nContent is the cornerstone of digital success, and we help you craft a compelling narrative that captures attention and builds trust. Our content creation services include blog posts, videos, infographics, case studies, and white papers, all designed to provide value to your audience and establish your authority in your field. We also offer content promotion strategies to ensure your content reaches a wide and relevant audience.\r\n\r\nEmail Marketing:\r\nKeep your audience engaged with personalized, results-oriented email marketing campaigns. From building targeted email lists to creating compelling newsletters and promotional offers, we help you nurture leads and drive conversions through timely and relevant communication.\r\n\r\nWebsite Design & Optimization:\r\nYour website is the face of your business, and we ensure it works as a powerful tool for conversion. We specialize in designing professional, user-friendly websites that not only look great but also provide an excellent user experience. Our services include speed optimization, mobile responsiveness, and conversion rate optimization (CRO), ensuring that your visitors have a seamless experience that encourages them to take action.\r\n\r\nBranding & Identity:\r\nA strong brand identity is key to standing out in a crowded marketplace. We help professionals establish a consistent and impactful brand image, from logo design and color schemes to brand voice and messaging. Our branding strategies ensure that your business speaks clearly and confidently to your target market.\r\n\r\nAnalytics & Reporting:\r\nTransparency and accountability are at the core of our approach. We provide regular, detailed reports and actionable insights that track the success of your campaigns and identify areas for improvement. Our data analytics ensure that every marketing decision is informed and that your business continues to grow with every campaign.\r\n\r\nWhy Choose ProReach Digital Marketing?\r\nTailored Solutions: We understand that every professional is different. That’s why we take the time to understand your business goals, target audience, and challenges to create personalized digital marketing strategies that work for you.\r\n\r\nProven Results: Our focus is on delivering measurable results that make a tangible impact on your business. From improving your search engine rankings to driving more qualified leads, we prioritize your success.\r\n\r\nExpert Team: Our team of digital marketing experts brings years of experience and a wealth of knowledge to the table. We stay ahead of industry trends to ensure that your business is always at the forefront of digital innovation.\r\n\r\nLong-Term Partnerships: We don\'t believe in quick fixes. Instead, we focus on building long-lasting partnerships with our clients, ensuring continuous growth and sustained success in the digital landscape.', 1, 'uploads/67fea0206749e_1000_F_992952877_WLxu67S01xpeP9EAZ1SOEDLh5VL4tRwu.jpg', '2025-04-15 18:06:24', '2025-04-15 18:06:41', NULL, 'pending', '7', 1, 0),
(13, 'ProReach Digital Marketing', 'Awais', 'ProReach Digital Marketing is a premier digital marketing agency built to empower professionals in today’s fast-paced digital world. With a deep understanding of industry trends and the unique challenges professionals face, we provide innovative and results-driven strategies tailored specifically to elevate your online presence and grow your business.\r\n\r\nOur mission is to bridge the gap between professionals and their target audience, helping them unlock new opportunities and achieve sustainable growth. Whether you’re a small business owner, a consultant, or an established corporate entity, ProReach offers a full suite of customized services designed to propel your brand forward in the digital space.\r\n\r\nOur Core Services:\r\nSearch Engine Optimization (SEO):\r\nRank higher on search engines like Google and Bing. We employ a combination of on-page and off-page SEO strategies, including keyword research, content optimization, technical audits, and link building, ensuring that your website attracts organic traffic and converts visitors into customers.\r\n\r\nSocial Media Marketing & Management:\r\nSocial media is where connections happen, and we help you make the most of it. Our team develops personalized social media strategies tailored to your audience, driving engagement through organic and paid campaigns. We manage and optimize your presence across major platforms like LinkedIn, Facebook, Instagram, and Twitter, ensuring that your brand message resonates with the right audience.\r\n\r\nPaid Advertising (PPC & Display Ads):\r\nMaximize the reach and impact of your campaigns with pay-per-click (PPC) advertising. We create and manage targeted ads on Google, LinkedIn, and social media channels that deliver instant visibility and measurable results. Our data-driven approach ensures that your advertising budget is spent efficiently, delivering high-quality leads and high conversion rates.\r\n\r\nContent Marketing & Strategy:\r\nContent is the cornerstone of digital success, and we help you craft a compelling narrative that captures attention and builds trust. Our content creation services include blog posts, videos, infographics, case studies, and white papers, all designed to provide value to your audience and establish your authority in your field. We also offer content promotion strategies to ensure your content reaches a wide and relevant audience.\r\n\r\nEmail Marketing:\r\nKeep your audience engaged with personalized, results-oriented email marketing campaigns. From building targeted email lists to creating compelling newsletters and promotional offers, we help you nurture leads and drive conversions through timely and relevant communication.\r\n\r\nWebsite Design & Optimization:\r\nYour website is the face of your business, and we ensure it works as a powerful tool for conversion. We specialize in designing professional, user-friendly websites that not only look great but also provide an excellent user experience. Our services include speed optimization, mobile responsiveness, and conversion rate optimization (CRO), ensuring that your visitors have a seamless experience that encourages them to take action.\r\n\r\nBranding & Identity:\r\nA strong brand identity is key to standing out in a crowded marketplace. We help professionals establish a consistent and impactful brand image, from logo design and color schemes to brand voice and messaging. Our branding strategies ensure that your business speaks clearly and confidently to your target market.\r\n\r\nAnalytics & Reporting:\r\nTransparency and accountability are at the core of our approach. We provide regular, detailed reports and actionable insights that track the success of your campaigns and identify areas for improvement. Our data analytics ensure that every marketing decision is informed and that your business continues to grow with every campaign.\r\n\r\nWhy Choose ProReach Digital Marketing?\r\nTailored Solutions: We understand that every professional is different. That’s why we take the time to understand your business goals, target audience, and challenges to create personalized digital marketing strategies that work for you.\r\n\r\nProven Results: Our focus is on delivering measurable results that make a tangible impact on your business. From improving your search engine rankings to driving more qualified leads, we prioritize your success.\r\n\r\nExpert Team: Our team of digital marketing experts brings years of experience and a wealth of knowledge to the table. We stay ahead of industry trends to ensure that your business is always at the forefront of digital innovation.\r\n\r\nLong-Term Partnerships: We don\'t believe in quick fixes. Instead, we focus on building long-lasting partnerships with our clients, ensuring continuous growth and sustained success in the digital landscape.', 1, 'uploads/67ffb8e732299_1000_F_992952877_WLxu67S01xpeP9EAZ1SOEDLh5VL4tRwu.jpg', '2025-04-16 14:04:23', '2025-04-16 14:04:57', NULL, 'pending', 'Business', 1, 0),
(14, 'Honest Game', 'hamza ', '🎮 Honest Game Reviews – Where Real Gamers Speak the Truth\r\nWelcome to Honest Game Reviews, the place where the hype ends and the truth begins.\r\n\r\nWe’re not sponsored. We’re not paid to say nice things. We’re just passionate gamers with a mission: to give you the raw, unfiltered truth about the games you’re thinking about playing. Whether it’s a highly anticipated AAA release or a quiet indie project that deserves the spotlight, we dive deep into every title and share what actually matters.\r\n\r\nWe know how it feels to spend hard-earned money on a game that turns out to be nothing like what the trailer promised. That’s why we focus on real gameplay experience—not flashy cinematics or early access promises. We test the game’s mechanics, visuals, performance, story, and controls. But more than that, we ask the most important question: is it actually fun to play?\r\n\r\nOur reviews aren’t filled with technical jargon or vague summaries. Instead, we break everything down in a way that’s easy to understand and genuinely useful. We’ll tell you:\r\n\r\nIs the game polished or buggy?\r\n\r\nAre the mechanics smooth or clunky?\r\n\r\nIs the story engaging or just filler?\r\n\r\nHow’s the multiplayer? Does the game respect your time?\r\n\r\nIs it worth the price—or should you wait for a sale?\r\n\r\nNo fanboy drama, no sugarcoating. Just the truth.\r\n\r\nWe also give credit where it’s due. If a game impresses us, we’ll celebrate it. But if it fails—whether it\'s due to lazy design, microtransaction overload, or broken mechanics—we’ll call it out. Because you deserve to know what you\'re getting into before you hit “download” or spend your cash.\r\n\r\nSo whether you’re a casual gamer looking for something chill to play, or a hardcore player chasing the next big hit, our reviews are here to guide you with authentic, experience-based insights—not fluff.\r\n\r\nThis is Honest Game Reviews. No gimmicks. No filters. Just the truth from one gamer to another.', 1, 'uploads/67ffbb65d1210_Honest_game_trailer_danganronpa.webp', '2025-04-16 14:15:01', '2025-04-16 14:15:29', NULL, 'pending', 'Game Review', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(3, 'Sport', '2025-04-13 07:25:39'),
(4, 'Life style', '2025-04-15 10:30:59'),
(5, 'News', '2025-04-15 10:31:06'),
(6, 'Food', '2025-04-15 10:31:17'),
(7, 'Business', '2025-04-15 10:31:27'),
(8, 'Game Review', '2025-04-16 14:10:26'),
(9, 'Book Notes', '2025-04-16 14:10:45'),
(10, 'My Life Journey', '2025-04-16 14:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `post_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `comment`, `created_at`) VALUES
(1, 10, 'Aretha Garrett', 'awais13500@gmail.com', 'sdasdas', '2025-04-15 19:11:20'),
(4, 10, '', '', 'awais', '2025-04-16 13:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `tag_name`, `created_at`) VALUES
(1, 'Technology', '2025-04-15 19:52:07'),
(2, 'Programming', '2025-04-15 19:52:07'),
(3, 'Design', '2025-04-15 19:52:07'),
(4, 'Web Development', '2025-04-15 19:52:07'),
(5, 'AI', '2025-04-15 19:52:07'),
(6, 'Tutorials', '2025-04-15 19:52:07'),
(7, 'Machine Learning', '2025-04-15 19:52:07'),
(8, 'Coding', '2025-04-15 19:52:07'),
(9, 'Backend', '2025-04-15 19:52:07'),
(10, 'Frontend', '2025-04-15 19:52:07'),
(11, 'DevOps', '2025-04-15 19:52:07'),
(12, 'Data Science', '2025-04-15 19:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cnic` varchar(15) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `cnic` (`cnic`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `cnic`, `phone`, `avatar`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '12345-1234567-1', '12345678901', NULL, 'admin', '2025-04-11 19:04:11'),
(4, 'awais100', '$2y$10$qF0qcKsAS9or89khdR0oEut7/SdILDkvM1Pmomr6zOxomzws7aR1m', '36502-4226966-9', '03483668355', 'uploads/avatars/avatar_67fb5a5dab807.jpg', 'user', '2025-04-13 06:31:57'),
(5, 'awais99', '$2y$10$ckeg8fZEVus3CD4CiOq7Pet6L033Y91OUQEfD3p6LHiERe8IX8SZW', '36502-4226966-6', '03483668350', 'uploads/avatars/avatar_67fb5b020de1e.jpg', 'user', '2025-04-13 06:34:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
