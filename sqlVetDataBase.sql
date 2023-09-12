

create database veterinariobanco;
use veterinariobanco;

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL primary key,
  `nome` varchar(100) NOT NULL,
  `dono` varchar(100) NOT NULL,
  `animal` varchar(20) NOT NULL,
  `situacao` varchar(50) NOT NULL
);
INSERT INTO `agenda` (`id`, `nome`, `dono`, `animal`, `situacao`) VALUES
(1, 'Bolinha', 'André José', 'Cachorro', 'Espera'),
(2, 'Bituca', 'José André', 'Gato', 'Consultório'),
(3, 'Mosquito', 'Jandré Aosé', 'Gato', 'Espera'),
(4, 'Fedido', 'Dréan Séjo', 'Cachorro', 'Consultório'),
(5, 'Balofo', 'Nadré Sojé', 'Gato', 'Espera'),
(6, 'Pimpolho', 'Jéso Dréan', 'Gato', 'Espera');

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL DEFAULT 0 primary key,
  `nome` varchar(50) NOT NULL,
  `loginusuario` varchar(20) NOT NULL,
  `senha` varchar(150) NOT NULL
);

INSERT INTO `usuarios` (`id`, `nome`, `loginusuario`, `senha`) VALUES
(1, 'Luiza', 'luiza', '$2y$10$0kNs4lXmcq5H9XtdRu/ixuWuUoWlnjYvJXWeOfeUL3YTuqxDQLUgS'),
(2, 'Margarida', 'maga', '$2y$10$FFQaRbqsqbPrkmV3fBf3ZOCI44gvOqu0Ix0mUur51qkexRQUXs02W'),
(3, 'Izaltino', 'tino', '$2y$10$YtS5vIFJIx6lAzJhS6Nzpe2zvdlCSyjiOr0DIFNZoArZAXQnjX0aq');

select * from agenda;
select * from usuarios