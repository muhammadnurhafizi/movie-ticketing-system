-- create movie table
CREATE TABLE `movie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `genre` json NOT NULL,
  `duration` int NOT NULL,
  `rating` decimal(10,0) NOT NULL,
  `release_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- insert movie data
INSERT INTO `movie-ticketing-system`.`movie` (`title`, `genre`, `duration`, `rating`, `release_date`) VALUES ('chainsaw main movie: reze-hen', '[{\"name\":\"action\"},{\"name\":\"fantasy\"}]', '99', '9.11', '2025-09-19');
INSERT INTO `movie-ticketing-system`.`movie` (`title`, `genre`, `duration`, `rating`, `release_date`) VALUES ('kimetsu no yaiba movie 1: mugenjou-hen - akaza sairai', '[{\"name\":\"action\"},{\"name\":\"supernatural\"}]', '155', '8.68', '2025-07-18');
INSERT INTO `movie-ticketing-system`.`movie` (`title`, `genre`, `duration`, `rating`, `release_date`) VALUES ('crayon shin-chan movie 33: chou karei! shakunetsu no kasukabe dancers', '[{\"name\":\"adventure\"},{\"name\":\"comedy\"}]', '105', '6.64', '2025-08-08');

-- alter movie.rating to nullable
ALTER TABLE `movie-ticketing-system`.`movie` MODIFY `rating` decimal(10,2) NULL;