CREATE TABLE `usuarios` (
  `usu_id` int(11) NOT NULL,
  `usu_usuario` varchar(150) NOT NULL,
  `usu_clave` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `reproductor` (
  `rep_id` int(11) NOT NULL,
  `rep_fecha` date NOT NULL,
  `rep_hora` varchar(50) NOT NULL,
  `rep_idUsuario` int(11) NOT NULL,
  `rep_titulo` varchar(150) NOT NULL,
  `rep_url` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`qualitysys`@`localhost` PROCEDURE `spListarReproductor` ()  NO SQL
select * from reproductor inner join usuarios on rep_idUsuario=usu_id$$

DELIMITER ;



