SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `attack` int(11) NOT NULL,
  `defense` int(11) NOT NULL,
  `health` int(11) NOT NULL,
  `premiumDays` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;


INSERT INTO `users` (`id`, `user`, `pass`, `email`, `attack`, `defense`, `health`, `premiumDays`) VALUES
(1, 'adam', 'qwerty', 'adam@gmail.com', 213, 5675, 342, 0),
(2, 'marek', 'asdfg', 'marek@gmail.com', 324, 1123, 4325, 15),
(3, 'anna', 'zxcvb', 'anna@gmail.com', 4536, 17, 120, 25),
(4, 'andrzej', 'asdfg', 'andrzej@gmail.com', 5465, 132, 189, 0),
(5, 'justyna', 'yuiop', 'justyna@gmail.com', 245, 890, 554, 0),
(6, 'kasia', 'hjkkl', 'kasia@gmail.com', 267, 980, 109, 12),
(7, 'beata', 'fgthj', 'beata@gmail.com', 565, 356, 447, 77),
(8, 'jakub', 'ertyu', 'jakub@gmail.com', 2467, 557, 876, 0),
(9, 'janusz', 'cvbnm', 'janusz@gmail.com', 65, 456, 2467, 0),
(10, 'roman', 'dfghj', 'roman@gmail.com', 97, 226, 245, 23);


ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);


ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;


