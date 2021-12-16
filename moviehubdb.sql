-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 05:56 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviehubdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `dateofpost` date NOT NULL,
  `title` varchar(60) NOT NULL,
  `post` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `dateofpost`, `title`, `post`) VALUES
(1, '2021-10-27', 'Top 10 movie blogs you need to know<br>By: Seiji Manzano', 'Video may be one of the best forms of content marketing, but there’s still great power in the written word, and 55 percent of marketers in 2018 rated blog content creation as their top inbound marketing priority. Blogs are great for content marketing, and they’re a fantastic way to express opinions and provide reviews for products and services, such as movies and television shows. Here are 20 of the top movie blogs that every film fan should be following in 2019. <br><br>\r\n1. CinemaBlend\r\nCinemaBlend is one of the most popular entertainment websites. The site dates back to 2003, and now boasts 19 million unique visitors each month, interacting with over 60 million pages of content.<br>\r\n\r\n2. MovieWeb\r\nMovieWeb dates back to 1995, making it one of the first movie websites. Its long history has allowed it to build a strong reputation as a trusted source for news and reviews.<br>\r\n\r\n3. Movie Pilot\r\nUser-generated content is a good way to get regular updates on your site, and to have a wider range of genuine, honest opinions from people your audience relates to easily. Movie Pilot uses this method to good effect, and boasts over 30 million readers and contributors.<br>\r\n\r\n4. Rotten Tomatoes\r\nRotten Tomatoes is the leading online review aggregator, drawing together reviews from critics on other sites to give movies a “fresh” or “rotten” status. The site also allows movie fans to provide their own reviews, and includes original editorial content.\r\n<br>\r\n5. Screen Rant\r\nThe Screen Rant site launched in 2003, and has grown to become one of the largest entertainment news sources. The site served over 140 million readers in 2017, and has over 4.8 million subscribers on its associated YouTube channel.\r\n<br>\r\n6. RogerEbert.com\r\nRoger Ebert was one of the world’s most famous and respected film reviewers. He sadly passed away in 2013, but his legacy lives on thanks to his website, which offers high-quality reviews, movie news, and video blogs.\r\n<br>\r\n7. JoBlo\r\nIn all forms of con'),
(2, '2021-10-27', '5 Tips For Starting Your Own Movie Blog <br> By: Seiji Manza', 'I remember way back 5 years ago when I was getting ready to launch my own movie blog (The Movie Blog officially launched on July 24th 2003) I did a quick little google search for “movie blogs”. At that time it said it came up with about 11,000 results. I did that exact same search eariler today and found that google was now giving me 17,200,000 results. That’s a growth of just a hair over 1563636%<br><br>\r\n\r\nThe popularity of Blogging in general continues to grow exponentially, and movie blogging in particular is something more and more people seem keen on getting involved in. And why not? What’s more fun to talk, debate, speculate and comment on than movies?<br><br>\r\n\r\nWithout the slightest bit of exaggeration I can tell you that I get AT LEAST 15-20 emails a week from people telling me about their new movie blog! Some telling me I’ve inspired them to launch one (which is always flattering to hear), most asking me to link to them or at least mention them… and that doesn’t even touch the hundreds of others that start up each week that don’t bother to write me.<br><br>\r\n\r\nMany times they write to me to ask for some advice on how to get started, how to run things, how to keep things going and how to grow. Over the years I’ve seen a lot (hundreds) of new movie bloggers start up, only to disappear a few days, weeks or months later, so seeking advice from anyone at all is a pretty good idea.<br><br>\r\n\r\nSo I thought I’d put together this little post on 5 tips for starting, maintaining and growing your own movie blog. Many of these tips are transferable to generic blogging, or blogging about other topics, but they are meant specifically for blogging about film. I’m certainly not the world’s biggest expert on blogging, but I have been doing this for a while, so here are some lessons I’ve learned:<br><br>\r\n\r\n1) DO IT BECAUSE YOU LOVE MOVIES\r\nI can’t even begin to tell you how many emails I get from people asking me how they too can blog for a living, or how to get invited to'),
(3, '2021-10-27', 'ewan', 'hahaha'),
(5, '2021-10-27', 'try ulet', 'hahaha');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `num_of_ticket` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `regular_small` int(11) NOT NULL,
  `regular_medium` int(11) NOT NULL,
  `regular_large` int(11) NOT NULL,
  `cheese_small` int(11) NOT NULL,
  `cheese_medium` int(11) NOT NULL,
  `cheese_large` int(11) DEFAULT NULL,
  `caramel_small` int(11) DEFAULT NULL,
  `caramel_medium` int(11) DEFAULT NULL,
  `caramel_large` int(11) DEFAULT NULL,
  `cola_small` int(11) DEFAULT NULL,
  `cola_medium` int(11) DEFAULT NULL,
  `cola_large` int(11) DEFAULT NULL,
  `tea_small` int(11) DEFAULT NULL,
  `tea_medium` int(11) DEFAULT NULL,
  `tea_large` int(11) DEFAULT NULL,
  `royal_small` int(11) DEFAULT NULL,
  `royal_medium` int(11) DEFAULT NULL,
  `royal_large` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `name`, `email`, `num_of_ticket`, `date`, `time`, `regular_small`, `regular_medium`, `regular_large`, `cheese_small`, `cheese_medium`, `cheese_large`, `caramel_small`, `caramel_medium`, `caramel_large`, `cola_small`, `cola_medium`, `cola_large`, `tea_small`, `tea_medium`, `tea_large`, `royal_small`, `royal_medium`, `royal_large`) VALUES
(10, 'Alfred Mendoza', 'alfredveniegasmendoza11@gmail.com', 0, '2021-10-20', '11:00 AM', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'Alfred Mendoza', 'alfredveniegasmendoza11@gmail.com', 0, '2021-10-28', '5:00 PM', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 'Alfred Mendoza', 'alfredveniegasmendoza11@gmail.com', 1, '2021-10-28', '3:00 PM', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(13, 'Alfred Mendoza', 'alfredveniegasmendoza11@gmail.com', 1, '2021-10-27', '5:00 PM', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(20, 'Justine Castro', 'jccastro2100@gmail.com', 2, '2021-11-01', '9:00 AM', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(21, 'Justine Castro', 'jccastro2100@gmail.com', 2, '2021-11-05', '1:00 PM', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `concern` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `username`, `password`) VALUES
(1, 'ewan@gmail.com', 'ewan', 'ewan');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL,
  `posterpic` varbinary(500) NOT NULL,
  `price` float NOT NULL,
  `ytlink` text NOT NULL,
  `seats` int(11) NOT NULL,
  `date` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `cinema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `posterpic`, `price`, `ytlink`, `seats`, `date`, `time`, `cinema`) VALUES
(2, 'Triggered', 'Triggered is a South African horror-comedy film co-written and directed by Alastair Orr. The film stars Reine Swart, Liesl Ahlers, Cameron Scott and Russell Crous as part of an ensemble of nine friends who find themselves strapped to suicide bomb vests by a former teacher, forcing the group to kill each other until there is one left.', 0x696d616765732f322e6a7067, 150, 'https://www.youtube.com/embed/MdsnUibXbl8', 980, 'A', 'B', 1),
(3, 'Squid Game', 'Squid Game is a South Korean survival drama television series streaming on Netflix. Written and directed by Hwang Dong-hyuk, it stars Lee Jung-jae, Park Hae-soo, Wi Ha-joon, Jung Ho-yeon, O Yeong-su, Heo Sung-tae, Anupam Tripathi, and Kim Joo-ryoung. The series, distributed by Netflix, was released worldwide on September 17, 2021.', 0x696d616765732f332e6a7067, 250, 'https://www.youtube.com/embed/oqxAJKy0ii4', 980, 'B', 'A', 1),
(4, 'Annette', 'Annette is a 2021 musical psychological drama film directed by Leos Carax (in his English-language debut), and with a screenplay by Ron Mael and Russell Mael of Sparks, and Carax, from an original story, music and songs by the band. The plot follows a stand-up comedian (Adam Driver) and his opera singer wife (Marion Cotillard) and how their lives are changed when they have their first child. Simon Helberg and Devyn McDowell also starred.', 0x696d616765732f342e6a7067, 180, 'https://www.youtube.com/embed/l_EaNpL16SU', 980, 'B', 'B', 3),
(5, 'Mortal Kombat', 'Mortal Kombat is a 2021 martial arts fantasy film based on the video game franchise of the same name and a reboot of the Mortal Kombat film series. The film follows Cole Young, a washed-up mixed martial arts fighter who is unaware of his hidden lineage or why assassin Sub-Zero is hunting him down. Concerned for the safety of his family, he seeks out a clique of fighters that were chosen to defend Earthrealm against Outworld.', 0x696d616765732f352e6a7067, 180, 'https://www.youtube.com/embed/NYH2sLid0Zc', 980, 'A', 'A', 4),
(10, 'Black Widow', 'In Marvel Studios action-packed spy thriller Black Widow, Natasha Romanoff aka Black Widow confronts the darker parts of her ledger when a dangerous conspiracy with ties to her past arises. Pursued by a force that will stop at nothing to bring her down, Natasha must deal with her history as a spy and the broken relationships left in her wake long before she became an Avenger.', 0x696d616765732f312e6a7067, 200, 'https://www.youtube.com/embed/ybji16u608U', 980, 'A', 'A', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
