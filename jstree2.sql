CREATE TABLE IF NOT EXISTS `treeview_items1` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `text` varchar(200) NOT NULL,
  `parent_id` varchar(11) NOT NULL,
  `link` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `treeview_items1`
--

INSERT INTO `treeview_items1` (`id`, `name`, `text`, `parent_id`, `link`) VALUES
(1, 'root', 'root', '0', 'http://www.google.com'),
(2, 'task2', 'task2', '1', 'http://www.uol.com'),
(3, 'task3', 'task3', '1', 'http://www.yahoo.com'),
(4, 'task4', 'task4', '3', 'http://www.gmail.com'),
(5, 'task5', 'task5', '3', 'http://www.hotmail.com'),
(6, 'task5', 'task5', '5', 'http://www.bmw.com'),
(7, 'task42', 'task42', '2', 'http://www.vw.com'),
(8, 'task45', 'task45', '2', 'http://www.microsoft.com'),
(9, 'task56', 'task56', '1', 'http://www.famacris.com'),
(10, 'task87', 'task87', '5', 'http://www.outlook.com'),
(11, 'task66', 'task66', '3', 'http://www.bacula.com'),
(48, 'task59', 'task59', '1', 'http://www.pintei.com'),
(49, 'task76', 'task76', '1', 'http://www.php.com'),
(50, 'ess', 'ess', '1', 'http://www.vidaloca.com');
