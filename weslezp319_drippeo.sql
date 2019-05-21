CREATE TABLE `actions` (
  `id` int(11) NOT NULL,
  `action_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `action_list` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `action_list`
--

INSERT INTO `action_list` (`id`, `name`, `icon`) VALUES
(1, 'shower', ''),
(2, 'bath', ''),
(3, 'toilet', ''),
(4, 'sink', ''),
(5, 'washing machine', ''),
(6, 'dishwasher', ''),
(7, 'outdoor tap', '');
